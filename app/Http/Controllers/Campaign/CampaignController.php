<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\DealPayload;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use App\Models\Campaigns;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index(){
        
        $advertiserId = Session::get('advertiser_id');
        $campaignTableTitle = Helper::campaignViewTableName();
        $campaignList = Campaigns::join('campaign_payloads', 'campaigns.id', '=', 'campaign_payloads.campaign_id')
                            ->where('campaigns.advertiser_id', '=', $advertiserId)
                            ->join('day_parts', 'campaigns.daypart_id', '=', 'day_parts.id')->where('day_parts.status','=', 1)
                            ->join('brands', 'campaigns.brand_id', '=', 'brands.id')->where('brands.status','=', 1)
                            ->join('medias', 'campaigns.media_id', '=', 'medias.id')->where('medias.status','=', 1)
                            ->join('deal_payloads', 'campaigns.id', '=', 'deal_payloads.campaign_id')
                            ->orderBy('campaigns.id', 'desc');
        $campaignTableData =  $campaignList->get([
                        'deal_payloads.id as deal_auto_id',
                        'deal_payloads.deal_id as deal_id', 
                        'campaign_payloads.campaign_id as campaign_id',
                        'campaign_payloads.name as campaign_payloads_name', 
                        'deal_payloads.name as deal_payloads_name',
                        'day_parts.name as day_time', 
                        'brands.product_name as brand_name',
                        'campaign_payloads.flight_start_date as campaign_payloads_flight_start_date', 
                        'campaign_payloads.flight_end_date as campaign_payloads_flight_end_date', 
                        'medias.name as media_name', 
                        'deal_payloads.inventory_type as inventory_type', 
                        'deal_payloads.inventory_length as inventory_length', 
                        'deal_payloads.rate as rate', 
                        'deal_payloads.rc_rate as rc_rate', 
                        'deal_payloads.rc_rate_percentage as rc_rate_percentage', 
                        'deal_payloads.total_avil as total_avil', 
                        'deal_payloads.total_unit as total_unit', 
            ])->toArray();
        $campaignPagination = $campaignList->paginate(2);
        
        $data = array( 
                'title' => 'Campaign',
                'tableTitle' => $campaignTableTitle,
                'tableData' => $campaignTableData, 
                'pagination' => $campaignPagination,
            );
        return view( 'pages.campaign.index', $data );
    }
}
