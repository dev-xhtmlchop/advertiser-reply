<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivitiesLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'url',
        'method',
        'ip_address',
        'agent',
    ];

}
