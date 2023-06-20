<?php
namespace App\Http\Controllers\Login;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Medias;
use App\Models\UserActivitiesLog;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserHistories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index(){
        $mediaList = Medias::where('status','=','1')->get(['id','name'])->toArray();
        $mediaData = array( 
        'data' => array( 'mediaList' => $mediaList ),
        'title' => 'Login' );
        return view('pages.login.index', $mediaData );
    }

    public function postLoginUser( Request $request ){
        $userCount = User::where('user_name', '=' , $request['user_name'])->count();
        if ( $userCount !== 1 ) {
            return response()->json('Please enter User name is incorrect.');  
        }else{
            return true;
        }
    }

    public function postLogin( Request $request ){
        if( ( $request->has('user_name') ) && ( $request->has('password')  ) && ( $request->has('media')  ) ){
            $mediaCount = User::join('advertisers', 'advertisers.id', '=', 'users.advertiser_id')->where('users.user_name', '=' , $request['user_name'])->where('advertisers.media_id', '=' , $request['media'])->count();
            if( $mediaCount !== 1 ){
                $data = array( 'status' => 0 , 'class' => 'media', 'message' => 'Please check Media Line is incorrect.' );
                return response()->json($data);
            } else if ( Auth::attempt(['user_name' => $request['user_name'] , 'password' => $request['password'], 'delete' => 1]) ){
                $data = array( 'status' => 0 , 'class' => 'media', 'message' => 'Please check User was Deleted.' );
                return response()->json($data);
            }else if ( Auth::attempt(['user_name' => $request['user_name'] , 'password' => $request['password'], 'status' => 0]) ){
                $data = array( 'status' => 0 , 'class' => 'media', 'message' => 'Please check User was Deactive.' );
                return response()->json($data);
            }else if (  ( $mediaCount === 1 ) && ( Auth::attempt(['user_name' => $request['user_name'] , 'password' => $request['password'], 'delete' => 0, 'status' => 1]) ) ) {
                $userId = Auth::id();
                $getUserData = User::join('advertisers', 'advertisers.id', '=', 'users.advertiser_id')->where('users.id', '=' , $userId)->first();
                $currentDate = date('Y-m-d H:i:s');
                if( $getUserData ){
                    Session::put('user_id', $userId);
                    Session::put('advertiser_id', $getUserData->id);
                    Session::put('advertiser_name', $getUserData->name);
                    Session::put('advertiser_email_address', $getUserData->email_address);
                    Session::put('advertiser_logintime', $currentDate);
                }
                
                Helper::activityLog('Create Login');
                Helper::userHistory();

                $data = array( 'status' => 1 , 'message' => 'Sucessfully Login.');
                return response()->json($data);  
            } else {
                $message = 'Please check Detail is incorrect.';
                $data = array( 'status' => 0 , 'class' => '', 'message' => $message );
                return response()->json($data);
            }   
        }else{
            $data = array( 'status' => 0 , 'class' => 'user_name', 'message' => 'Please check Detail.');
            return response()->json($data);
        }    
    }
}
