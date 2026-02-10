<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'session_key',
        'user_id',
        'state',
        'service_id',
        'appointment_date',
        'appointment_time',
    ];
}

