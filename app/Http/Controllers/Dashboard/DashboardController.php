<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaigns;
use App\Models\DealPayload;
use App\Models\Deals;
use App\Models\Demographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use App\Models\User;

class DashboardController extends Controller
{

    public function removeDubplicateRow( $duplicateArrayOfData ){
        if( $duplicateArrayOfData ){
            $dataOfCollection = collect($duplicateArrayOfData);
            $dataFilter = $dataOfCollection->unique('id');
            return $dataFilter->all();
        }else{
            return false;
        }
    }
    public function index( Request $request ){
        $advertiserId = Session::get('advertiser_id');
        $advertiser = Deals::join('deal_payloads', 'deal_payloads.deal_id', '=', 'deals.id')->where('advertiser_id', '=' , $advertiserId)->get(['deal_payloads.*'])->toArray();
        $campaignList = Campaigns::where( 'advertiser_id', '=',  $advertiserId )->get()->toArray();
        $demographicsList = Deals::join('demographics', 'demographics.id', '=', 'deals.demographic_id')->where('deals.advertiser_id', '=' , $advertiserId)->get(['demographics.*'])->toArray();
        $outletList = Deals::join('outlets', 'outlets.id', '=', 'deals.outlet_id')->where('deals.advertiser_id', '=' , $advertiserId)->get(['outlets.*'])->toArray();
        $agencyList = Deals::join('agencys', 'agencys.id', '=', 'deals.agency_id')->where('deals.advertiser_id', '=' , $advertiserId)->get(['agencys.*'])->toArray();
        $locationList = Deals::join('locations', 'locations.id', '=', 'deals.location_id')->where('deals.advertiser_id', '=' , $advertiserId)->get(['locations.*'])->toArray();
        $brandList = Deals::join('brands', 'brands.id', '=', 'deals.brand_id')->where('deals.advertiser_id', '=' , $advertiserId)->get(['brands.*'])->toArray();
        $dealStatusArray = Helper::dealStatusArray();
        $dealViewArray = Helper::dealViewArray();
        $dashboardData = array( 
            'title' => 'Dashboard',
            'dashboard' => array( 
                    'advertiserList' =>  DashboardController::removeDubplicateRow( $advertiser ),
                    'campaignList' => DashboardController::removeDubplicateRow( $campaignList ),
                    'demographicsList' => DashboardController::removeDubplicateRow( $demographicsList ),
                    'outletList' => DashboardController::removeDubplicateRow( $outletList ),
                    'agencyList' => DashboardController::removeDubplicateRow( $agencyList ),
                    'locationList' => DashboardController::removeDubplicateRow( $locationList ),
                    'brandList' => DashboardController::removeDubplicateRow( $brandList ),
                ),
            'dealStatus' => $dealStatusArray,
            'dealView' => $dealViewArray
        );                        
        return view('pages.dashboard.index', $dashboardData);
    }

    public function dashboardDealFilter( Request $request){
        $advertiserId = Session::get('advertiser_id');
        if( $request->data !== null ){
            $data = $request->data;
            $results = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')
                ->where('deals.advertiser_id','=', $advertiserId)
                ->when($data['deal_no'], function ($query) use ($data) {
                    return $query->where('deal_payloads.deal_id','=', $data['deal_no']);
                })
                ->when($data['campaign'], function ($query) use ($data) {
                    return $query->where('deals.campaign_id','=', $data['campaign']);
                })
                ->when($data['demographics'], function ($query) use ($data) {
                    return $query->where('deals.demographic_id','=', $data['demographics']);
                })
                ->when($data['outlet'], function ($query) use ($data) {
                    return $query->where('deals.outlet_id','=', $data['outlet']);
                })
                ->when($data['agency'], function ($query) use ($data) {
                    return $query->where('deals.agency_id','=', $data['agency']);
                })
                ->when($data['location'], function ($query) use ($data) {
                    return $query->where('deals.location_id','=', $data['location']);
                })
                ->when($data['brand'], function ($query) use ($data) {
                    return $query->where('deals.brand_id','=', $data['brand']);
                })
                ->when($data['daterange'], function ($query) use ($data) {
                    return $query->whereDate('deal_payloads.flight_start_date', '>=', $data['start_daterange'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_daterange']);
                })->first( array(
                    DB::raw('SUM(deal_payloads.rate) as rate'),
                    DB::raw('SUM(deal_payloads.cpm) as cpm'),
                    DB::raw('SUM(deal_payloads.impressions) as impressions'),
                    DB::raw('SUM(deal_payloads.grp) as grp'),
                    DB::raw('SUM(deal_payloads.deal_unit) as deal_unit'),
                  ));
            return response()->json($results);    
        }else{
            $results = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')
                ->where('deals.advertiser_id','=', $advertiserId)->first( array(
                    DB::raw('SUM(deal_payloads.rate) as rate'),
                    DB::raw('SUM(deal_payloads.cpm) as cpm'),
                    DB::raw('SUM(deal_payloads.impressions) as impressions'),
                    DB::raw('SUM(deal_payloads.grp) as grp'),
                    DB::raw('SUM(deal_payloads.deal_unit) as deal_unit'),
                  ));
            return response()->json($results);  
        }
    }

    public function dashboardAdvertiserFilter( Request $request){
        if( $request->data !== null ){
            $data = $request->data;
            $inflight = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','inflight')->count();
            $approved = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','approved')->count();
            $proposal = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','proposal')->count();
            $ordered = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','ordered')->count();
            $planning = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','planning')->count();
            $ended = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','ended')->count();
            $expired = DealPayload::join('deals', 'deals.id', '=', 'deal_payloads.deal_id')->whereDate('deal_payloads.flight_start_date', '>=', $data['start_date'])->whereDate('deal_payloads.flight_end_date', '<=', $data['end_date'])->where('status','expired')->count();
        }else{
            $inflight = Deals::where('status','inflight')->count();
            $approved = Deals::where('status','approved')->count();
            $proposal = Deals::where('status','proposal')->count();
            $planning = Deals::where('status','planning')->count();
            $ordered = Deals::where('status','ordered')->count();
            $ended = Deals::where('status','ended')->count();
            $expired = Deals::where('status','expired')->count();
        }
        $statusArray = array( 
                'inflight' => $inflight, 
                'approved' => $approved, 
                'proposal' => $proposal, 
                'planning' => $planning, 
                'ordered' => $ordered,
                'ended' => $ended,
                'expired' => $expired 
        );
        return response()->json($statusArray);  
    }
}
