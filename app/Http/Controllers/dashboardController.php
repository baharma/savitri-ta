<?php

namespace App\Http\Controllers;

use App\Models\LabaRugi;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();

        // Dapatkan jumlah hari pada bulan sekarang
        $daysMonth = $currentDate->daysInMonth;

        $sales = Penjualan::query();
        $expense = Pengeluaran::query();
        $receivable = Piutang::query();

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $days = [];
        $salesChart = [];
        $receivableChart = [];
        $debtChart = [];


        for ($i = 1; $i <= $daysMonth; $i++) {

            $penjualan = Penjualan::whereDay('tanggal_penjualan', $i)->sum('total_penjualan');
            $piutang = Piutang::whereDay('tgl_transaksi_piutang', $i)->sum('sisa_tagihan');
            $hutang = Pengeluaran::whereDay('tgl_transaksi_hutang', $i)->sum('total_pengeluaran');


            $days[] = [
                'day' => $i,
                'penjualan' => $penjualan,
                'piutang' => $piutang,
                'hutang' => $hutang
            ];
        }


        $profitloss = 0;
        $datasales = Penjualan::orderBy('created_at', 'DESC')->limit(5)->get();

        return view('dashboard', [
            'sales' => $sales->sum('total_penjualan'),
            'expense' => $expense->sum('total_pengeluaran'),
            'receivable' => $receivable->sum('sisa_tagihan'),
            'profitloss' => $profitloss,
            'datasales' => $datasales,
            'days' => $days
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
