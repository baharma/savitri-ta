<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
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

    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }


    /**
     * Get the receivables that owns the Penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receivables(): BelongsTo
    {
        return $this->belongsTo(Piutang::class, 'penjualan_id');
    }
}
