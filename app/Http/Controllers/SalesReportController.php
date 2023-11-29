<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        return view('pages.penjualan.report.index', [
            'page_title' => 'Laporan Penjualan'
        ]);
    }

    public function getdata(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $data = Penjualan::orderBy('created_at', 'ASC')->whereBetween('created_at', [$start, $end])->get();
        return view('pages.penjualan.report.print', [
            'page_title' => 'Report Penjualan Periode' . $start . 's/d' . $end,
            'data' => $data,
        ]);
    }
}
