<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistories extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_logged_in_timestamp',
        'user_logged_out_timestamp',
        'ip_address',
        'created_by'
    ];
}
