<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'documents' => 'array',
        'date' => 'date',
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // When retrieving from database, convert paths to full URLs
        static::retrieved(function ($project) {
            if ($project->imageUrl && !str_starts_with($project->imageUrl, 'http')) {
                $project->imageUrl = url('storage/' . $project->imageUrl);
            }

            if ($project->documents && is_array($project->documents)) {
                $project->documents = array_map(function ($doc) {
                    if (isset($doc['url']) && !str_starts_with($doc['url'], 'http')) {
                        $doc['url'] = url('storage/' . $doc['url']);
                    }
                    return $doc;
                }, $project->documents);
            }
        });
    }
}
