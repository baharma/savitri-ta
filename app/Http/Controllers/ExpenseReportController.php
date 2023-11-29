<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class ExpenseReportController extends Controller
{
    public function index()
    {
        return view('pages.purchase.report.index', [
            'page_title' => 'Laporan Penjualan'
        ]);
    }

    public function getdata(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $data = Pengeluaran::orderBy('created_at', 'ASC')->whereBetween('created_at', [$start, $end])->get();
        return view('pages.purchase.report.print', [
            'page_title' => 'Report Penjualan Periode' . $start . 's/d' . $end,
            'data' => $data,
        ]);
    }
}
