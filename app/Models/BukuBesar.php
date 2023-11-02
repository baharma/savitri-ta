<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    use HasFactory,HasUuids;

    protected $table ="buku_besars";

    protected $fillable = [
        'id_user',
        'date',
        'description',
        'saldo',
        'akun_id'
    ];

    public function jurnal(){
        return $this->belongsToMany(JurnalUmum::class,'nyusuns','id_buku_besar','id_jurnal_umum');
    }

    public function akun(){
        return $this->belongsTo(Akun::class,'akun_id','id');
    }
}
