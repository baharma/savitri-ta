<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Piutang extends Model
{
    use HasFactory, HasUuids;
    protected $fillable= [
        'user_id',
        'no_transaksi',
        'nama_Pelanggan',
        'alamat',
        'penjualan_id',
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

    /**
     * Get the customer that owns the Piutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
