<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the journalDetails for the Journal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journalDetails(): HasMany
    {
        return $this->hasMany(JournalItem::class, 'journal_id', 'id');
    }
}
