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
       
    }
}
