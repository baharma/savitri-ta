<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JournalItem;
use Illuminate\Http\Request;

class ProfitLossReportController extends Controller
{
    public function index()
    {
        return view('pages.labarugi.index', [
            'page_title' => 'Laba Rugi'
        ]);
    }

    public function getdata(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $coa = Akun::all();
        $data = JournalItem::with(['journal', 'coa'])->whereBetween('date', [$start, $end])->get();


        return view('pages.labarugi.print', [
            'page_title' => 'Hasil Laba Rugi',
            'data' => $data,
            'coa' => $coa
        ]);
    }
}
