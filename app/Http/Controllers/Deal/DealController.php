<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Models\Deals;
use App\Models\DealPayload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class DealController extends Controller
{
    public function index(){
        
        $advertiserId = Session::get('advertiser_id');
        $dealTableTitle = Helper::dealViewTableName();
        $dealList = Deals::join('deal_payloads', 'deals.id', '=', 'deal_payloads.deal_id')
                            ->where('deals.advertiser_id', '=', $advertiserId)
                            ->join('day_parts', 'deals.daypart_id', '=', 'day_parts.id')->where('day_parts.status','=', 1)
                            ->join('brands', 'deals.brand_id', '=', 'brands.id')->where('brands.status','=', 1)
                            ->orderBy('deals.id', 'desc');
        $dealTableData =  $dealList->get([
                        'deal_payloads.deal_id as deal_id',
                        'deals.campaign_id as campaign_number', 
                        'deal_payloads.name as deal_name', 
                        'day_parts.name as day_time', 
                        'brands.product_name as brand_name',
                        'deal_payloads.inventory_type as inventory_type', 
                        'deal_payloads.inventory_length as inventory_length', 
                        'deal_payloads.rate as rate', 
                        'deal_payloads.rc_rate as rc_rate', 
                        'deal_payloads.rc_rate_percentage as rc_rate_percentage', 
                        'deal_payloads.total_avil as total_avil', 
                        'deal_payloads.total_unit as total_unit', 
                        'deal_payloads.hh_rating as hh_rating', 
                        'deal_payloads.hh_ss as hh_ss', 
                        'deal_payloads.hh_cpm as hh_cpm', 
                        'deal_payloads.hh_univ as hh_univ', 
                        'deal_payloads.a25_49_rating as a25_49_rating', 
                        'deal_payloads.a25_49_ss as a25_49_ss', 
                        'deal_payloads.a25_49_cpm as a25_49_cpm', 
                        'deal_payloads.a25_49_univ as a25_49_univ'
                        ])->toArray();
        $dealPagination = $dealList->paginate(1);
        $dealStatusArray = Helper::dealStatusArray();
        $dealViewArray = Helper::dealViewArray();
        
        $data = array( 
                'title' => 'Deal',
                'tableTitle' => $dealTableTitle,
                'tableData' => $dealTableData, 
                'pagination' => $dealPagination, 
                'dealStatus' => $dealStatusArray,
                'dealView' => $dealViewArray 
            );
        return view( 'pages.deal.index', $data );
    }

    public function postStatus( Request $request ){
        if( $request['data'] !== null ){
            $advertiser = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')
            ->where('deals.status','=', $request['data'])->first( array(
                DB::raw('SUM(deal_payloads.rate) as rate'),
                DB::raw('SUM(deal_payloads.cpm) as cpm'),
                DB::raw('SUM(deal_payloads.impressions) as impressions'),
                DB::raw('SUM(deal_payloads.grp) as grp'),
                DB::raw('SUM(deal_payloads.deal_unit) as deal_unit'),
            ));
            return response()->json($advertiser);  
        }else{
            $advertiser = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->first( array(
                DB::raw('SUM(deal_payloads.rate) as rate'),
                DB::raw('SUM(deal_payloads.cpm) as cpm'),
                DB::raw('SUM(deal_payloads.impressions) as impressions'),
                DB::raw('SUM(deal_payloads.grp) as grp'),
                DB::raw('SUM(deal_payloads.deal_unit) as deal_unit'),
            ));
            return response()->json($advertiser);  
        }
    }
}
