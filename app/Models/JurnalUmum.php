<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    use HasFactory,HasUuids;

    protected $table ="jurnal_umums";

    protected $fillable = [
        'date',
        'debit',
        'description',
        'user_id',
        'kredit',
        'akun_id',
        'kode_jurnal'
    ];
}
