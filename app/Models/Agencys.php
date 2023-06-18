<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencys extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'street_name', 'city', 'state', 'zip_code', 'agency_commission', 'function', 'ae', 'media_id', 'demographic_id', 'brand_id', 'outlet_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
