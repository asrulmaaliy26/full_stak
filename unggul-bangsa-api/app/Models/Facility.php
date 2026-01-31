<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $guarded = ['id'];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // When retrieving from database, convert path to full URL
        static::retrieved(function ($facility) {
            if ($facility->imageUrl && !str_starts_with($facility->imageUrl, 'http')) {
                $facility->imageUrl = url('storage/' . $facility->imageUrl);
            }
        });
    }
}
