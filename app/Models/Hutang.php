<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\CssSelector\Node\HashNode;

class Hutang extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the pengeluaran that owns the Hutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengeluaran(): BelongsTo
    {
        return $this->belongsTo(Pengeluaran::class, 'pengeluaran_id');
    }
}
