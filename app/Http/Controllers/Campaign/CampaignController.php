<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\DealPayload;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use App\Models\Campaigns;
use App\Models\DayParts;
use App\Models\Demographic;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
            ->orderBy('campaigns.id', 'asc');
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
        
        
        $campaignDayTableData =  $campaignList->get([
            'campaign_payloads.sunday as sunday', 
            'campaign_payloads.monday as monday', 
            'campaign_payloads.tuesday as tuesday', 
            'campaign_payloads.wednesday as wednesday', 
            'campaign_payloads.thursday as thursday', 
            'campaign_payloads.friday as friday',
            'campaign_payloads.saturday as saturday'
            ])->toArray();
        $dayOfArray = array( 'sunday' => 'S', 'monday' => 'M','tuesday' => 'T','wednesday' => 'W', 'thursday' => 'T', 'friday' => 'F', 'saturday' => 'S' );
        if( count ( $campaignDayTableData ) > 0 ){
            foreach( $campaignDayTableData as $campaignDayTableKey => $campaignDayTableVal ){
                foreach( $campaignDayTableVal as $campaignSingleDayKey => $campaignSingleDayVal ){
                    if( ( $campaignSingleDayVal == 1 ) && ( array_key_exists( $campaignSingleDayKey, $dayOfArray ) ) ){
                        $campaignDayTableVal[$campaignSingleDayKey] =  $dayOfArray[$campaignSingleDayKey];
                    }
                }
                $campaignDayTableData[$campaignDayTableKey] = implode(" ", $campaignDayTableVal);
            }
        }
        
        $campaignPagination = $campaignList->paginate(2);
        $data = array( 
                'title' => 'Campaign',
                'tableTitle' => $campaignTableTitle,
                'dayTableData' => $campaignDayTableData,
                'tableData' => $campaignTableData, 
                'pagination' => $campaignPagination,
            );
        return view( 'pages.campaign.index', $data );
    }

    public function getEditCampaignDetail(Request $request){
        if( $request['campaignId'] != '' ){
            $campaignID = $request['campaignId'];
            $advertiserId = Session::get('advertiser_id');
            $campaignList = Campaigns::join('campaign_payloads', 'campaigns.id', '=', 'campaign_payloads.campaign_id')
                ->join('brands', 'campaigns.brand_id', '=', 'brands.id')->where('brands.status','=', 1)
                ->join('medias', 'campaigns.media_id', '=', 'medias.id')->where('medias.status','=', 1)
                ->join('agencys', 'campaigns.agency_id', '=', 'agencys.id')->where('agencys.status','=', 1)
                ->join('outlets', 'campaigns.outlet_id', '=', 'outlets.id')->where('outlets.status','=', 1)
                ->join('demographics', 'campaigns.demographic_id', '=', 'demographics.id')->where('demographics.status','=', 1)
                ->join('day_parts', 'campaigns.daypart_id', '=', 'day_parts.id')->where('day_parts.status','=', 1)
                ->where('campaigns.advertiser_id', '=', $advertiserId)->where('campaigns.id','=',$campaignID)
                ->first([
                    'campaigns.id as campaign_payloads_id',
                    'campaigns.*',
                    'brands.product_name as brand_name',
                    'demographics.name as demographics_name',
                    'outlets.outlet_type as outlets_name',
                    'day_parts.name as day_parts_name',
                    'medias.name as media_name', 
                    'agencys.name as agency_name',
                    'agencys.agency_commission as agency_commission',
                    'campaign_payloads.*'
                ])->toArray();
        
            $response = array(
                'status' => 1,
                'message' => 'Data',
                'data' => array(
                    'campaign_data' => $campaignList, 
                )
            );
            return response()->json($response);  
        }else{
            $response = array(
                'status' => 0,
                'message' => 'Please check Campaign Id is Incorrect.',
                'data' => ''
            );
            return response()->json($response);  
        }
    }

    public function getEditCampaignInfo(Request $request, $campaignID){
        $advertiserId = Session::get('advertiser_id');
        $campaignList = Campaigns::join('campaign_payloads', 'campaigns.id', '=', 'campaign_payloads.campaign_id')
            ->where('campaigns.advertiser_id', '=', $advertiserId)->where('campaigns.id','=',$campaignID)
            ->first([
                'campaigns.id as campaign_payloads_id',
                'campaign_payloads.name as campaign_payloads_name',
                'campaigns.valid_from as campaigns_valid_from', 
                'campaigns.deal_year as campaigns_year',
            ]);
            $demographicList = Demographic::where('status','=',1)->get(['id','name'])->toArray();
            $daypartsList = DayParts::where('status','=',1)->get(['id','name'])->toArray();
            if( !empty( $campaignList ) ){
            $data = array(
                'title' => 'Edit Campaign',
                'campaign' => $campaignList->toArray(),
                'demographicList' => $demographicList,
                'dayPartList' => $daypartsList,
            );
            return view( 'pages.campaign.edit', $data );
        }else{
            $data = array(
                'title' => 'Edit Campaign',
                'campaign' => '',
                'demographicList' => $demographicList,
                'dayPartList' => $daypartsList,
            );
            return view( 'pages.campaign.edit', $data );
        }
        /*$data = [
            "name" => 'test1',
            "title" => '123789'
        ];
        Storage::put('/public/campaign/test-new.json', json_encode($data));
        $path = Storage::path('public\campaign\test-new.json');
        return response()->download( $path);*/
    }
}
