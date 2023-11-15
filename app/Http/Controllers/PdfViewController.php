<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PdfViewController extends Controller
{
    public $penjualan,$pengeluaran, $bukuBesar;

    public function __construct(Penjualan $penjualan,Pengeluaran $pengeluaran,BukuBesar $bukuBesar){
        $this->penjualan = $penjualan;
        $this->pengeluaran = $pengeluaran;
        $this->bukuBesar = $bukuBesar;
    }

    public function index(){
        return view('pages.pdf.index');
    }
    public function viewListPenjualan(Request $request){
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $dataPenjualan = $this->penjualan->whereBetween('tanggal_penjualan',[$star,$end])->get();
        return view('pages.pdf.penjualan-view-pdf',compact('end','star','dataPenjualan'));
    }
    public function pdf(Request $request){
     $end = $request->penjualan_end;
    $star = $request->penjualan_start;
    $dataPenjualan = $this->penjualan->whereBetween('tanggal_penjualan', [$star, $end])->get();


    $orientation = "landscape";

    $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView('pages.pdf.penjualan-pdf-print', compact('dataPenjualan','end','star'));

    return $pdf->stream('document.pdf');
    }

    public function pdfpengeluaran(Request $request){
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $datapengeluaran = $this->pengeluaran->whereBetween('tanggal_pengeluran',[$star,$end])->get();
        return view('pages.pdf.pengeluaran-view',compact('end','star','datapengeluaran'));
    }
    public function pdfStreamPengeluaran(Request $request){
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $datapengeluaran = $this->pengeluaran->whereBetween('tanggal_pengeluran', [$star, $end])->get();
        $orientation = "landscape";
        $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView('pages.pdf.pengeluaran-pdf-print', compact('datapengeluaran','end','star'));
        return $pdf->stream('document.pdf');
    }

    public function naracaView(Request $request){
        $end = $request->penjualan_end;
        $star = $request->penjualan_start;
        $databukuBesar = $this->bukuBesar->whereBetween('date',[$star,$end])->get();
        return view('pages.pdf.naraca.naraca-view',compact('end','star','databukuBesar'));
    }
    public function naracaPdf(Request $request){
        $activa = $request->activa;
        $passiva = $request->passiva;
        $end = $request->penjualan_end;
        $star = $request->penjualan_end;
        $datapassiva = collect($passiva)->map(function($item){
          return  $this->bukuBesar->find($item);
        });

        $dataactiva = collect($activa)->map(function($item){
            return  $this->bukuBesar->find($item);
        });

        $totalSaldoactiva  = $dataactiva->sum('saldo');
        $totalSaldopassiva = $datapassiva->sum('saldo');
        $orientation = "landscape";
        $pdf = app('dompdf.wrapper')->setPaper('A4', $orientation)->loadView('pages.pdf.naraca.naraca-file-print',
        compact('datapassiva','dataactiva','totalSaldoactiva','totalSaldopassiva','end','star'));
        return $pdf->stream('document.pdf');
    }
    public function labaRugi(Request $request){

    }
    public function labaRugiPdf(Request $request){

    }
}
