<?php

namespace App\Http\Controllers;

use App\Models\LabaRugi;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {

        $sales = Penjualan::sum('total_penjualan');
        $expense = Pengeluaran::sum('total_pengeluaran');
        $receivable = Piutang::sum('sisa_tagihan');
        $profitloss = 0;
        $datasales = Penjualan::orderBy('created_at', 'DESC')->limit(5)->get();

        return view('dashboard', [
            'sales' => $sales,
            'expense' => $expense,
            'receivable' => $receivable,
            'profitloss' => $profitloss,
            'datasales' => $datasales,
        ]);
    }


    public function getChartData()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7)->toDateString();

        $sevenDaysData = Penjualan::whereDate('tanggal_penjualan', '>=', $sevenDaysAgo)
            ->groupBy('tanggal_penjualan')
            ->selectRaw('tanggal_penjualan, COUNT(*) as total_penjualan')
            ->get();
        $sortedData = $sevenDaysData->sortBy('tanggal_penjualan');
        foreach ($sortedData as $data) {
            $tanggal = Carbon::parse($data->tanggal_penjualan)->format('l'); // 'l' menampilkan nama hari
            $totalPenjualan = $data->total_penjualan;

            $resultArray[] = ['tanggal' => $tanggal, 'total_penjualan' => $totalPenjualan];
        }
        return response()->json($resultArray);
    }
}
