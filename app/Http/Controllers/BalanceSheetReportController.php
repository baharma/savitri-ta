<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JournalItem;
use Illuminate\Http\Request;

class BalanceSheetReportController extends Controller
{
    public function index()
    {
        return view('pages.balancesheet.index', [
            'page_title' => 'Neraca Saldo'
        ]);
    }

    public function getdata(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $coa = Akun::all();
        $data = JournalItem::with(['journal', 'coa'])->whereBetween('created_at', [$start, $end])->get();

        $aktiva_lancar = [];
        $passiva = [];
        $aktiva_tetap_val = [];
        $modal_ekuitas_val = [];

        $pendapatan = $coa->where('klasifikasi_akun', 'Pendapatan')->first();
        $beban = $coa->where('klasifikasi_akun', 'Beban')->values();


        $totalPendapatan = JournalItem::where('akun_id', $pendapatan->id)->sum('kredit');
        $totalBeban = 0;

        foreach ($beban as $key => $value) {
            $valus = JournalItem::where('akun_id', $value->id)->sum('kredit');

            $totalBeban += $valus;
        }

        $profitloss = $totalPendapatan - $totalBeban;


        // Create AKTIVA LANCAR
        foreach ($coa->where('jenis_akun', 'AKTIVA_LANCAR') as $key => $value) {
            $debit = $data->where('akun_id', $value->id)->sum('debit');
            $kredit = $data->where('akun_id', $value->id)->sum('kredit');

            $aktiva_lancar[] = [
                'nama_akun' => $value->name_akun,
                'total' => $debit - $kredit
            ];
        }

        // CREATE PASSIVA
        foreach ($coa->where('jenis_akun', 'PASSIVA') as $key => $value) {
            $debit = $data->where('akun_id', $value->id)->sum('debit');
            $kredit = $data->where('akun_id', $value->id)->sum('kredit');

            $passiva[] = [
                'nama_akun' => $value->name_akun,
                'total' => $debit - $kredit
            ];
        }

        // CREATE AKTIVA TETAP
        $aktiva_tetap = $coa->where('jenis_akun', 'AKTIVA_TETAP')->values();

        if ($aktiva_tetap != null) {
            foreach ($aktiva_tetap as $key => $value) {
                $debit = $data->where('akun_id', $value->id)->sum('debit');
                $kredit = $data->where('akun_id', $value->id)->sum('kredit');

                $aktiva_tetap_val[] = [
                    'nama_akun' => $value->name_akun,
                    'total' => $debit - $kredit
                ];
            }
        }

        // CREATE MODAL EKUITAS
        $modal_ekuitas = $coa->where('jenis_akun', 'MODAL_EKUITAS')->values();

        if ($modal_ekuitas != null) {
            foreach ($modal_ekuitas as $key => $value) {
                $debit = $data->where('akun_id', $value->id)->sum('debit');
                $kredit = $data->where('akun_id', $value->id)->sum('kredit');

                $modal_ekuitas_val[] = [
                    'nama_akun' => $value->name_akun,
                    'total' => $debit - $kredit
                ];
            }
        }



        return view('pages.balancesheet.print', [
            'page_title' => 'Hasil Neraca Saldo',
            'aktiva_lancar' => $aktiva_lancar,
            'passiva' => $passiva,
            'profitloss' => $profitloss,
            'aktiva_tetap_val' => $aktiva_tetap_val,
            'modal_ekuitas_val' => $modal_ekuitas_val,
        ]);
    }
}
