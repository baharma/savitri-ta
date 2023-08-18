<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'user_id',
        'piutang_id',
        'tanggal_penjualan',
        'nama_barang',
        'jenis_barang',
        'jumlah_barang',
        'jenis_pembayarang',
        'total_penjualan',
        'description',
        'faktur_penjualan',
        'harga_barang',
    ];

    public function users(){
        return $this->hasMany(User::class,'user_id','id');
    }
    public function piutangs(){
        return $this->hasMany(Piutang::class,'piutang_id','id');
    }
}
