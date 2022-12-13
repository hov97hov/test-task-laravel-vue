<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'archived',
        'messages',
        'user_id',
        'contact_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y - H:i',
    ];
}
