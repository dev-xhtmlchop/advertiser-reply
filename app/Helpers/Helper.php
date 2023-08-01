<?php 

namespace App\Helpers;
use App\Models\UserActivitiesLog;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\UserHistories;
use App\Models\Statu;
use App\Models\Deals;
use App\Models\DealPayload;
use App\Models\Campaigns;
use App\Models\CampaignPayload;
use Illuminate\Support\Facades\Schema;

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

    public static function removeUnderscore($value){
        $replaceValue = str_replace("_"," ",$value);
        return ucwords($replaceValue);
    }

    public static function addUnderscore($value){
        $replaceValue = str_replace(" ","_",$value);
        return $replaceValue;
    }

    public static function getInput($tableName,$fieldId,$fieldsVal){
        $input = '';
        switch ($tableName) {
            case "bigint":
                $input = '<input type="text" id="db_field_name_'.$fieldId.'" attr-key="bigint" class="au-input au-input--full form-control" name="db_field_name[]" value="'.$fieldsVal.'" autofocus="">';
                break;
            case "string":
                $input = '<input type="text" id="db_field_name_'.$fieldId.'" attr-key="string" class="au-input au-input--full form-control" name="db_field_name[]" value="'.$fieldsVal.'" autofocus="">';
                break;
            case "integer":
                $input = '<input type="number" id="db_field_name_'.$fieldId.'" attr-key="integer" class="au-input au-input--full form-control" name="db_field_name[]" value="'.$fieldsVal.'" autofocus="">';
                break;
            case "datetime":
                $input = '<input type="text" id="db_field_name_'.$fieldId.'" attr-key="datetime" class="au-input au-input--full form-control json-datetime" name="db_field_name[]" value="'.$fieldsVal.'" autofocus="">';
                break;
            case "date":
                $input = '<input type="text" id="db_field_name_'.$fieldId.'" attr-key="date" class="au-input au-input--full form-control json-year" name="db_field_name[]" value="'.$fieldsVal.'" autofocus="">';
                break;
            case "boolean":
                $selectFirst = ( $fieldsVal == 0 )?'selected="selected"':""; 
                $selectSecond = ( $fieldsVal == 1 )?'selected="selected"':""; 
                $input = '<select name="db_field_name[]" id="db_field_name_'.$fieldId.'" attr-key="boolean" class="au-input au-input--full valid" aria-invalid="false">
                <option value="0"'.$selectFirst.'>0</option><option value="1" '.$selectSecond.'>1</option></select>';
                break;
        }
        return  $input;
    }

    public static function removeId( $mainArrayData ){
        if( count( $mainArrayData ) > 0 ){
            $newData = [];
            foreach( $mainArrayData as $mainArrayDataKey => $mainArrayDataVal ){
                $columnName = $mainArrayDataVal[0];
                $columnType = $mainArrayDataVal[1];
                    switch ($columnName) {
                        case str_contains($columnName, '_id'):
                            $removeId = str_replace('_id','_name',$columnName);
                            $newData[$removeId] = $columnType;
                            break;
                        case str_contains($columnName, 'id'):
                            break;
                        case "created_by":
                            break;
                        case "updated_by":
                            break;
                        case "created_at":
                            break;
                        case "updated_at":
                            break;
                        case "delete":
                            break;
                        case "status":
                            break;
                        default:
                        $newData[$columnName] = $columnType;
                    }
              //  }
            }
        }
        return $newData;
    }

    public static function getTableName($tablename){
        $tableData = '';
        switch ($tablename) {
            case "deal":
                $tableData = new Deals;
            break;
            case "dealpayload":
                $tableData = new DealPayload;
            break;
            case "campaign":
                $tableData = new Campaigns;
            break;
            case "campaignpayload":
                $tableData = new CampaignPayload;
            break;
        }
        return $tableData;
    }

    public static function getTableColumnType( $dealPayloads, $arrayData ){
        $tableName = Helper::getTableName($dealPayloads);
        $tableNameTypeArr = [];
        foreach( $arrayData as $arrayDataKey => $arrayDataVal ){
            $tableNameTypeArr[] = array(  $arrayDataVal,  $tableName->getTableTypes($arrayDataVal) );
        }
       return $tableNameTypeArr;
    }

    public static function jsonDataTableList(){
        $dealColumnsList = Helper::getTableName('deal')->getTableColumns();
        $dealColumnsTypeList = Helper::getTableColumnType('deal',$dealColumnsList);
        $dealremoveArray = Helper::removeId($dealColumnsTypeList);

        $dealpaylpadsColumnsList = Helper::getTableName('dealpayload')->getTableColumns();
        $dealpaylpadsColumnsTypeList = Helper::getTableColumnType('dealpayload',$dealpaylpadsColumnsList);
        $dealpaylpadsremoveArray = Helper::removeId($dealpaylpadsColumnsTypeList);

        $dealTableFields = array_merge($dealremoveArray,$dealpaylpadsremoveArray);
        
        $campaignColumnsList = Helper::getTableName('campaign')->getTableColumns();
        $campaignColumnsTypeList = Helper::getTableColumnType('campaign',$campaignColumnsList);
        $campaignremoveArray = Helper::removeId($campaignColumnsTypeList);

        $campaignpaylpadsColumnsList = Helper::getTableName('campaignpayload')->getTableColumns();
        $campaignpaylpadsColumnsTypeList = Helper::getTableColumnType('campaignpayload',$campaignpaylpadsColumnsList);
        $campaignpaylpadsremoveArray = Helper::removeId($campaignpaylpadsColumnsTypeList);

        $campaignTableFields = array_merge($campaignremoveArray,$campaignpaylpadsremoveArray);
        
        $tableFieldsData = array(  
             'deal' => $dealTableFields,
             'campaign' => $campaignTableFields,
            );
        return $tableFieldsData;
    }
}
?>