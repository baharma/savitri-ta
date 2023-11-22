<?php

namespace App\Helper;

use App\Models\Journal;

class GenerateGL
{
    public static function journal()
    {
        $jurnal = Journal::count();
        return 'GL' . now()->format('Ymd') . str_pad($jurnal + 1, 4, '0', STR_PAD_LEFT);
    }
}
