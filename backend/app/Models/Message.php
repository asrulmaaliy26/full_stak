<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_info',
        'message',
        'category',
        'type',
        'jenjang',
        'reply_subject',
        'reply_content',
        'replied_at',
    ];
}
