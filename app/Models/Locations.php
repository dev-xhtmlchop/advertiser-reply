<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'state', 'local', 'county', 'city', 'zip_code', 'country', 'created_at', 'updated_at'];
}
