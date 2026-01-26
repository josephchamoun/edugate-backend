<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'academic_year_id', 'sender_id', 'sender_type',
        'receiver_id', 'receiver_type',
        'status', 'published_at',
        'message_text', 'attachment', 'subject'
    ];
}