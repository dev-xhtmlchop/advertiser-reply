<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Medias;
use App\Models\Brands;

class Campaigns extends Model
{
    use HasFactory;

    protected $fillable = [ 'advertiser_id', 'deal_id', 'campaign_payload_id', 'client_id', 'title', 'valid_from', 'valid_to', 'deal_year', 'media_id', 'demographic_id', 'brand_id', 'outlet_id', 'agency_id', 'daypart_id', 'market_place', 'realistic', 'revenue', 'rate', 'status', 'delete', 'created_by', 'updated_by', 'created_at', 'updated_at' ];

    /*public function medias()
    {
        return $this->belongsTo(Medias::class,'media_id','id');
    }

    public function brands()
    {
        return $this->belongsTo(Brands::class,'brand_id','id');
    }*/
}