<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengeluaran extends Model
{
    use HasFactory, HasUuids;
    protected $table = "pengeluarans";

    protected $guarded = [];

    /**
     * Get the debt that owns the Pengeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function debt(): HasOne
    {
        return $this->hasOne(Hutang::class, 'pengeluaran_id');
    }

    public function User()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function Hutangs()
    {
        return $this->hasMany(Hutang::class, 'id', 'pengeluaran_id');
    }
}
