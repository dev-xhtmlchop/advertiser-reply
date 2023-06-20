<?php 

namespace App\Helpers;
use App\Models\UserActivitiesLog;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\UserHistories;

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
}
?>