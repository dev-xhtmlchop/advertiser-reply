<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{
    use HasFactory;

    protected $fillable = [ 'primory', 'name', 'print', 'rating', 'cpp', 'share', 'hutput', 'impression', 'cpm', 'vph', 'total_impression', 'total_grp', 'percentage_st', 'location_id', 'outlet_id', 'stewardship_method', 'dat_stream_set', 'universe_type', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
