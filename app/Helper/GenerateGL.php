<?php

namespace App\Helper;

use App\Models\Journal;
use App\Models\JournalItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GenerateGL
{
    public static function journal()
    {
        $jurnal = Journal::count();
        return 'GL' . now()->format('Ymd') . str_pad($jurnal + 1, 4, '0', STR_PAD_LEFT);
    }

    public static function createGL($data)
    {
        $dataJournal2 = [
            "description" => $data['description'],
            "akun_id" => $data['akun'],
            "date" => $data['date'],
            "debit" => [$data['nominal'], "0"],
            "kredit" => ["0", $data['nominal']],
            "nominal" => $data['nominal'],
        ];

        $glpiutang = new Journal;


        $glpiutang->date = Carbon::now();
        $glpiutang->description = $dataJournal2['description'];
        $glpiutang->kode_jurnal = GenerateGL::journal();
        $glpiutang->nominal = $data['nominal'];
        $glpiutang->uniq_id = $data['uniq_id'];

        $glpiutang->save();

        $items = $dataJournal2['akun_id'];

        foreach ($items as $key => $value) {
            JournalItem::insert([
                'journal_id' => $glpiutang->id,
                'user_id' => Auth::user()->id,
                'debit' => floatval($dataJournal2['debit'][$key]),
                'kredit' => floatval($dataJournal2['kredit'][$key]),
                'akun_id' => $dataJournal2['akun_id'][$key],
                "date" => $data['date'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'uniq_id' => $data['uniq_id'],
            ]);
        }
    }
}
