<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penjualan extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }


    /**
     * Get the receivables that owns the Penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receivables(): HasOne
    {
        return $this->hasOne(Piutang::class, 'penjualan_id');
    }
}
