<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'gallery' => 'array',
        'date' => 'date',
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // When retrieving from database, convert paths to full URLs
        static::retrieved(function ($news) {
            if ($news->main_image && !str_starts_with($news->main_image, 'http')) {
                $news->main_image = url('storage/' . $news->main_image);
            }

            if ($news->gallery && is_array($news->gallery)) {
                $news->gallery = array_map(function ($path) {
                    return str_starts_with($path, 'http') ? $path : url('storage/' . $path);
                }, $news->gallery);
            }
        });
    }
}
