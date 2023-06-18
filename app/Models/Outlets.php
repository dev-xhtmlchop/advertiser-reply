<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlets extends Model
{
    use HasFactory;
    protected $fillable = [ 'outlet_type', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
