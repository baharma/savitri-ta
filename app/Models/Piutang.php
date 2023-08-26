<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory, HasUuids;
    protected $fillable= [
        'user_id',
        'no_transaksi',
        'nama_Pelanggan',
        'alamat',
        'tgl_transaksi_piutang',
        'tgl_jatuh_tempo_piutang',
        'total_tagihan',
        'total_pembayaran',
        'status_pembayaran',
        'description',
        'sisa_tagihan'
    ];
    public function users(){
        return $this->hasMany(User::class,'user_id','id');
    }
    public function penjualans(){
        return $this->hasOne(Penjualan::class,'id','piutang_id');
    }
}
