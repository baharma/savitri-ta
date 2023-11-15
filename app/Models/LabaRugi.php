<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabaRugi extends Model
{
    use HasFactory,HasUuids;
    protected $table ="laba_rugis";
    protected $fillable = [
        'date',
        'saldo'
    ];

    public function hasBuku(){
        return $this->belongsToMany(BukuBesar::class,'laba_rugi_relasi','laba_id','buku_id');
    }

}
