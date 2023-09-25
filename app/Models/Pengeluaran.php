<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory,HasUuids;
    protected $table = "pengeluarans";

    protected $fillable = [
        'user_id',
        'tanggal_pengeluran',
        'jenis_pengeluaran',
        'total_pengeluaran',
        'jenis_bayar',
        'descriptions',
    ];
    public function User(){
        return $this->hasMany(User::class,'user_id','id');
    }

    public function Hutangs(){
        return $this->hasMany(Hutang::class,'id','pengeluaran_id');
    }

}
