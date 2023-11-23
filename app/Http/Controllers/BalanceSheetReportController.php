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


        return view('pages.balancesheet.print', [
            'page_title' => 'Hasil Neraca Saldo',
            'data' => $data,
            'coa' => $coa
        ]);
    }
}
