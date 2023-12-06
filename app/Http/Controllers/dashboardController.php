<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JournalItem;
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

        $month = $currentDate->format('m');

        // Dapatkan jumlah hari pada bulan sekarang
        $daysMonth = $currentDate->daysInMonth;

        $sales = Penjualan::query();
        $expense = Pengeluaran::query();
        $receivable = Piutang::query();

        $coa = Akun::all();
        $journal = JournalItem::all();

        $pendapatan = $coa->where('klasifikasi_akun', 'Pendapatan')->first();
        $beban = $coa->where('klasifikasi_akun', 'Beban')->values();

        $totalPendapatan = JournalItem::where('akun_id', $pendapatan->id)->sum('kredit');
        $totalBeban = 0;

        foreach ($beban as $key => $value) {
            $valus = JournalItem::where('akun_id', $value->id)->sum('debit');

            $totalBeban += $valus;
        }

        $days = [];


        for ($i = 1; $i <= $daysMonth; $i++) {

            $penjualan = Penjualan::whereMonth('tanggal_penjualan', $month)->whereDay('tanggal_penjualan', $i)->sum('total_penjualan');
            $piutang = Piutang::whereMonth('tgl_transaksi_piutang', $month)->whereDay('tgl_transaksi_piutang', $i)->sum('sisa_tagihan');
            $pengeluaran = Pengeluaran::whereMonth('tanggal_pengeluran', $month)->whereDay('tanggal_pengeluran', $i)->sum('total_pengeluaran');


            $days[] = [
                'day' => $i,
                'penjualan' => $penjualan,
                'piutang' => $piutang,
                'pengeluaran' => $pengeluaran
            ];
        }

        $profitloss = $totalPendapatan - $totalBeban;
        $datasales = Penjualan::orderBy('tanggal_penjualan', 'DESC')->limit(5)->get();

        return view('dashboard', [
            'sales' => $this->currencyIDR($sales->sum('total_penjualan')),
            'expense' => $this->currencyIDR($expense->sum('total_pengeluaran')),
            'receivable' => $this->currencyIDR($receivable->sum('sisa_tagihan')),
            'profitloss' => $this->currencyIDR($profitloss),
            'datasales' =>  $datasales,
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
