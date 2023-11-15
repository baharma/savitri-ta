<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        $penjualan =  Penjualan::latest('created_at')->first();

        $pengeluaran = Pengeluaran::latest('created_at')->first();


        return view('dashboard',compact('penjualan','pengeluaran'));
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
