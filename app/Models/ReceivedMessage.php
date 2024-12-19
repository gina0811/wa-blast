<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_type',
        'from_name',
        'from_number',
        'number',
        'is_group',
        'message',
        'created_at',
    ];
}
