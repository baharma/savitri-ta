<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JournalItem;
use Illuminate\Http\Request;

class BigBookController extends Controller
{
    public function index()
    {
        return view('pages.bigbook.index', [
            'page_title' => 'Buku Besar'
        ]);
    }

    public function getdata(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $coa = Akun::all();
        return JournalItem::all();
        // $data = JournalItem::orderBy('date', 'ASC')->with(['journal', 'coa'])->whereBetween('date', [$start, $end])->get();

        return view('pages.bigbook.result', [
            'page_title' => 'Hasil Buku Besar',
            'data' => $data,
            'coa' => $coa
        ]);
    }
}
