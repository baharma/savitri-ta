<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BukuBesar;
use App\Models\LabaRugi;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PdfViewController extends Controller
{
    public $penjualan, $pengeluaran, $bukuBesar;

    public function __construct(Penjualan $penjualan, Pengeluaran $pengeluaran, BukuBesar $bukuBesar)
    {
        $this->penjualan = $penjualan;
        $this->pengeluaran = $pengeluaran;
        $this->bukuBesar = $bukuBesar;
    }

    public function index()
    {
        return view('pages.pdf.index');
    }
    public function viewListPenjualan(Request $request)
    {
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $dataPenjualan = $this->penjualan->whereBetween('tanggal_penjualan', [$star, $end])->get();
        return view('pages.pdf.penjualan-view-pdf', compact('end', 'star', 'dataPenjualan'));
    }
    public function pdf(Request $request)
    {
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $dataPenjualan = $this->penjualan->whereBetween('tanggal_penjualan', [$star, $end])->get();
        $orientation = "landscape";
        $totalPenjualan = $dataPenjualan->sum('total_penjualan');

        $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView(
            'pages.pdf.penjualan-pdf-print',
            compact('dataPenjualan', 'end', 'star', 'totalPenjualan')
        );

        return $pdf->stream('document.pdf');
    }

    public function pdfpengeluaran(Request $request)
    {
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $datapengeluaran = $this->pengeluaran->whereBetween('tanggal_pengeluran', [$star, $end])->get();
        return view('pages.pdf.pengeluaran-view', compact('end', 'star', 'datapengeluaran'));
    }
    public function pdfStreamPengeluaran(Request $request)
    {
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $datapengeluaran = $this->pengeluaran->whereBetween('tanggal_pengeluran', [$star, $end])->get();
        $orientation = "landscape";
        $totalPengeluaran = $datapengeluaran->sum('total_pengeluaran');
        $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView('pages.pdf.pengeluaran-pdf-print', compact('datapengeluaran', 'end', 'star', 'totalPengeluaran'));
        return $pdf->stream('document.pdf');
    }

    public function naracaView(Request $request)
    {
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $databukuBesar = $this->bukuBesar->whereBetween('date', [$star, $end])->get();
        return view('pages.pdf.naraca.naraca-view', compact('end', 'star', 'databukuBesar'));

    }
    
    public function naracaPdf(Request $request)
    {
        // $activa = $request->activa;
        // $passiva = $request->passiva;
        // $end = $request->penjualan_end;
        // $star = $request->penjualan_end;
        // $datapassiva = collect($passiva)->map(function($item){
        //   return  $this->bukuBesar->find($item);
        // });

        // $dataactiva = collect($activa)->map(function($item){
        //     return  $this->bukuBesar->find($item);
        // });

        // $totalSaldoactiva  = $dataactiva->sum('saldo');
        // $totalSaldopassiva = $datapassiva->sum('saldo');
        // $orientation = "landscape";
        // $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView('pages.pdf.naraca.naraca-file-print',
        // compact('datapassiva','dataactiva','totalSaldoactiva','totalSaldopassiva','end','star'));
        // return $pdf->stream('document.pdf');

        $coa = Akun::all();

        return view('pages.printdata.neraca.print', [
            'coa' => $coa
        ]);
    }
    public function labaRugi(Request $request)
    {
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $databukuBesar = $this->bukuBesar->whereBetween('date', [$star, $end])->get();
        return view('pages.pdf.laba-rugi.raba-rugi-view', compact('end', 'star', 'databukuBesar'));
    }
    public function labaRugiPdf(Request $request)
    {
        $pendapatan = $request->pendapatan;
        $biaya = $request->biaya;
        $end = $request->penjualan_end;
        $star = $request->penjualan_end;
        $databiaya = collect($biaya)->map(function ($item) {
            return  $this->bukuBesar->find($item);
        });

        $datapendapatan = collect($pendapatan)->map(function ($item) {
            return  $this->bukuBesar->find($item);
        });

        $totaldatabiaya = $databiaya->sum('saldo');
        $totaldatapendapatan = $datapendapatan->sum('saldo');

        $lababersih = $totaldatapendapatan - $totaldatabiaya;

        $dataGabungan = $databiaya->merge($datapendapatan);

        $dataGabunganTanpaDuplikat = $dataGabungan->unique('id');

        $datalaba = [
            'date' => now(),
            'saldo' => $lababersih
        ];
        $laba = LabaRugi::create($datalaba);

        // Assuming $dataGabunganTanpaDuplikat is a collection of BukuBesar instances
        $dataGabunganTanpaDuplikat->each(function ($item) use ($laba) {
            $laba->hasBuku()->attach($item->id);
        });
        $orientation = "landscape";
        $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView(
            'pages.pdf.laba-rugi.laba-rugi-pdf',
            compact('lababersih', 'databiaya', 'datapendapatan', 'end', 'star')
        );
        return $pdf->stream('document.pdf');
    }
}
