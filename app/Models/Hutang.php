<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory,HasUuids;
    protected $table = "hutangs";
    protected $fillable = [
        'user_id',
        'no_transaksi_hutang',
        'tgl_transaksi_hutang',
        'tgl_jatuh_tempo',
        'total_transaksi_hutang',
        'description',
        'pengeluaran_id'
    ];
    public function User(){
        return $this->hasMany(User::class,'user_id','id');
    }
    public function Hutangs(){
        return $this->hasMany(Pengeluaran::class,'pengeluaran_id','id');
    }
}
