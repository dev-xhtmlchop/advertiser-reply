<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignPayload extends Model
{
    use HasFactory;

    protected $fillable = [  'name', 'demo', 'ae', 'demo_population', 'impressions', 'grp', 'cpm', 'flight_start_date', 'flight_end_date', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday_split', 'monday_split', 'tuesday_split', 'wednesday_split', 'thursday_split', 'friday_split', 'saturday_split', 'inventory_type', 'inventory_length', 'rate', 'rc_rate', 'rc_rate_percentage', 'total_avil', 'total_unit', 'unit', 'created_throught', 'tape_id', 'change_by', 'change_throught', 'delete', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function getTableTypes( $databaseTableFieldname = '') {
        if( !empty( $databaseTableFieldname ) ){
            return $this->getConnection()->getDoctrineColumn($this->getTable(), $databaseTableFieldname)->getType()->getName();
        }
    }
}
