<?php 

namespace App\Helpers;
use App\Models\UserActivitiesLog;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\UserHistories;
use App\Models\Statu;

class Helper{
    public static function activityLog( $message = null ){
        $logActivity = array(
            'message' => $message,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'agent' => request()->header('user-agent'),
            'user_id' => auth()->check() ? auth()->user()->id : 1
        );
        $userActivitiesCreate = UserActivitiesLog::create($logActivity);
        if( $userActivitiesCreate ){
            return true;
        }else{
            $message = 'Data was not Inserted.';
            $data = array( 'status' => 0 , 'class' => '', 'message' => $message );
            return response()->json($data);
        }
    }
    public static function userHistory(){
        $currentDate = date('Y-m-d H:i:s');
        $userLog = array(
            'user_id' =>  auth()->check() ? auth()->user()->id : 1,              
            'user_logged_in_timestamp' => $currentDate,
            'ip_address' => request()->ip(),
            'created_by' => auth()->check() ? auth()->user()->id : 1,
        );
        $userHistory = UserHistories::create($userLog);
        if( $userHistory ){
            return true;
        }else{
            $message = 'Data was not Inserted.';
            $data = array( 'status' => 0 , 'class' => '', 'message' => $message );
            return response()->json($data);
        }
    }

    public static function dealStatusArray(){
        $dealStatus = Statu::orderBy('id', 'asc')->get()->toArray();
        /*$dealStatus = array(
            array(
                'id' => 1,
                'name' => 'Inflight',
                'slug' => 'inflight',
                'icon' => 'fa fa-plane',
                'background' => 'overview-item--c1'
            ),
            array(
                'id' => 2,
                'name' => 'Proposal',
                'slug' => 'proposal',
                'icon' => 'fa fa-file',
                'background' => 'overview-item--c2'
            ),
            array(
                'id' => 3,
                'name' => 'Ended',
                'slug' => 'ended',
                'icon' => 'fa fa-clock-o',
                 'background' => 'overview-item--c3'
            ),
            array(
                'id' => 4,
                'name' => 'Approved',
                'slug' => 'approved',
                'icon' => 'fa fa-thumbs-up',
                 'background' => 'overview-item--c4'
            ),
            array(
                'id' => 5,
                'name' => 'Ordered',
                'slug' => 'order',
                'icon' => 'fa fa-shopping-cart',
                 'background' => 'overview-item--c1'
            ),
            array(
                'id' => 6,
                'name' => 'Planning',
                'slug' => 'planning',
                'icon' => 'fa fa-list-alt',
                 'background' => 'overview-item--c2'
            ),
            array(
                'id' => 7,
                'name' => 'Expired',
                'slug' => 'expired',
                'icon' => 'fa fa-clock-o',
                 'background' => 'overview-item--c3'
            ),
        );*/
        return $dealStatus;
    }

    public static function dealViewArray(){
        $dealView = array(
            array(
                'id' => 1,
                'name' => 'Dollars',
                'slug' => 'dollars',
                'value' => '$0',
                'background' => 'bg-blue',
                'image' => 'doller-icon.png'
            ),
            array(
                'id' => 2,
                'name' => 'CPM',
                'slug' => 'cpm',
                'value' => '$0',
                'background' => 'bg-green',
                'image' => 'cpm-icon.png'
            ),
            array(
                'id' => 3,
                'name' => 'Impressions',
                'slug' => 'impressions',
                'value' => '$0',
                'background' => 'bg-yellow',
                'image' => 'impressions-icon.png'
            ),
            array(
                'id' => 4,
                'name' => 'GRP',
                'slug' => 'grp',
                'value' => '$0',
                'background' => 'bg-red',
                'image' => 'grp-icon.png'
            ),
            array(
                'id' => 5,
                'name' => 'Deal Unit',
                'slug' => 'deal_unit',
                'value' => '$0',
                'background' => 'bg-orange',
                'image' => 'deal-icon.png'
            ),
        );
        return $dealView;
    }
    public static function dealViewTableName(){
        $dealTableArray = array(
                        "Deal ID", 
                        "Campaign Number", 
                        "Title", 
                        "Day/ Time", 
                        "Brand", 
                        "Inv Type", 
                        "Inv Length", 
                        "$ Rate", 
                        "$ Rate", 
                        "% Rate", 
                        "Total Avails", 
                        "Total Unit", 
                        "HH Rating", 
                        "HH (000)", 
                        "HH CPM", 
                        "HH Univ", 
                        "A25-49 Rating", 
                        "A25-49 (000)", 
                        "A25-49 CPM", 
                        "A25-49 Univ",
                        "Status"
                    );
        return  $dealTableArray;
    }
    public static function campaignViewTableName(){
        $campaignTableArray = array(
                        "Deal ID", 
                        "Campaign Number", 
                        "Campaign Name",
                        "Title", 
                        "Day/ Time", 
                        "Brand",
                        "Start Flight",
                        "End Flight", 
                        "Media Line",
                        "Inv Type", 
                        "Inv Length", 
                        "$ Rate", 
                        "$ Rate", 
                        "% Rate", 
                        "Total Avails", 
                        "Total Unit", 
                        "Status",
                        "Action",
                    );
        return  $campaignTableArray;
    }

    public static function dashboardInterconnectDropdownHtml( $dashboardData, $field, $defaultName, $selecValue, $addName = 0 ){
        if( !empty( $field ) ){
            $fieldName = $field.'_name';
            $fieldId = $field.'_id';
            $dealDropdown = [];
            $dealDropdown[] = '<option value="">'. $defaultName .'</option>';
            if( !empty( $dashboardData ) && ( count( $dashboardData ) > 0 ) ){
                foreach( $dashboardData as $dashboardDataKey => $dashboardDataVal ){
                    if( $dashboardDataVal[$fieldId] ){
                        $customName = ( $addName == 1 )? $dashboardDataVal[$fieldName].' ('. $dashboardDataVal[$fieldId] .')': $dashboardDataVal[$fieldName] ;
                        $selected = ( $selecValue == $dashboardDataVal[$fieldId] )? "selected":"";
                        $dealDropdown[] = '<option value="'. $dashboardDataVal[$fieldId] .'" '.  $selected .'>'. $customName .'</option>';
                    }
                }
            }
            return $dealDropdown;
        }
    }
    
    public static function daySmallArray(){
        return array( 'sunday' => 'S', 'monday' => 'M','tuesday' => 'T','wednesday' => 'W', 'thursday' => 'T', 'friday' => 'F', 'saturday' => 'S' );
    }

    public static function tableAddDaysAndTime( $campainTableArray, $campainArray, $flag ){
        $dayOfArray = Helper::daySmallArray();
        $newCampaingTableData = [];
        if( count( $campainTableArray ) > 0 ){
            if( count ( $campainArray ) > 0 ){
                foreach( $campainArray as $campaignDayTableKey => $campaignDayTableVal ){
                    foreach( $campaignDayTableVal as $campaignSingleDayKey => $campaignSingleDayVal ){
                        if( ( $campaignSingleDayVal == 1 ) && ( array_key_exists( $campaignSingleDayKey, $dayOfArray ) ) ){
                            $campaignDayTableVal[$campaignSingleDayKey] =  $dayOfArray[$campaignSingleDayKey];
                        }
                    }
                    $campainArray[$campaignDayTableKey] = implode(" ", $campaignDayTableVal);
                }
            }
            if( $flag == 1 ){
                foreach( $campainTableArray as $campainSingleTableKey => $campainSingleTableValue ){
                    foreach( $campainSingleTableValue as $campainTableKey => $campainTableValue ){
                        if( $campainTableKey == 'day_time' ){
                            //echo $campainArray[$campainSingleTableKey].' '.$campainTableValue;
                            $campainSingleTableValue[$campainTableKey] = $campainArray[$campainSingleTableKey].' '.$campainTableValue;
                        }
                    }
                    $newCampaingTableData[] = $campainSingleTableValue;
                }
            }else{
                foreach( $campainTableArray as $campainTableKey => $campainTableValue ){
                    if( $campainTableKey == 'day_time' ){
                        $campainTableArray[$campainTableKey] = $campainArray[0].' '.$campainTableValue;
                    }
                }
                $newCampaingTableData = $campainTableArray;
            }
        }
        return $newCampaingTableData;
    }

    public static function campaignDayTime( $daytime, $tableName ){
        return  $daytime->get([
            $tableName.'.sunday as sunday', 
            $tableName.'.monday as monday', 
            $tableName.'.tuesday as tuesday', 
            $tableName.'.wednesday as wednesday', 
            $tableName.'.thursday as thursday', 
            $tableName.'.friday as friday',
            $tableName.'.saturday as saturday'
        ])->toArray();
    }

    public static function changeDateFormate( $dataArray, $fieldName = array() , $flag ){
        $newDataArray = [];
        if( $flag == 1 ){
            if( count( $dataArray ) > 0){
                foreach( $dataArray as $dataSingleArrayKey => $dataSingleArrayVal){
                    foreach( $dataSingleArrayVal as $dataArrayKey => $dataArrayValue){
                       
                        if( in_array( $dataArrayKey, $fieldName ) ){
                            $dataSingleArrayVal[$dataArrayKey] = date('m/d/Y', strtotime($dataArrayValue)); 
                        }
                    }
                    $newDataArray[] = $dataSingleArrayVal;
                }
                
            }
        }else{
            if( count( $dataArray ) > 0){
                foreach( $dataArray as $dataArrayKey => $dataArrayValue){
                    if( in_array( $dataArrayKey, $fieldName ) ){
                        $dataArray[$dataArrayKey] = date('m/d/Y', strtotime($dataArrayValue)); 
                    }
                }
                $newDataArray = $dataArray;
            }
        }
        return $newDataArray;
    }
}
?>