<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'date',
        'is_best' => 'boolean',
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // When retrieving from database, convert path to full URL
        static::retrieved(function ($journal) {
            if ($journal->documentUrl && !str_starts_with($journal->documentUrl, 'http')) {
                $journal->documentUrl = url('storage/' . $journal->documentUrl);
            }
        });
    }
}
