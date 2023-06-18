<?php

namespace App\Http\Controllers\Login;

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
            if (  ( $mediaCount === 1 ) && ( Auth::attempt(['user_name' => $request['user_name'] , 'password' => $request['password']]) ) ) {
                $userId = Auth::id();
                $getUserData = User::join('advertisers', 'advertisers.id', '=', 'users.advertiser_id')->where('users.id', '=' , $userId)->first();
                $currentDate = date('Y-m-d H:i:s');
                if( $getUserData ){
                    Session::put('advertiser_id', $getUserData->id);
                    Session::put('advertiser_name', $getUserData->name);
                    Session::put('advertiser_email_address', $getUserData->email_address);
                    Session::put('advertiser_logintime', $currentDate);
                }
                
                $log = [];
                $log['message'] = 'Insert Data';
                $log['url'] = $request->fullUrl();
                $log['method'] = $request->method();
                $log['ip_address'] = $request->ip();
                $log['agent'] = $request->header('user-agent');
                $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
                UserActivitiesLog::create($log);
    
                $userLog = [];
                $userLog['user_id'] = auth()->check() ? auth()->user()->id : 1;
                $userLog['user_logged_in_timestamp'] = $currentDate;
                $userLog['ip_address'] = $request->ip();
                $userLog['created_by'] = auth()->check() ? auth()->user()->id : 1;
                UserHistories::create($userLog);
    
                //Auth::user()->role = 'director';
                $data = array( 'status' => 1 , 'message' => 'Sucessfully Login.');
                return response()->json($data);  
            } else {
                if(  $mediaCount !== 1 ){
                    $message = 'Please check Media Line is incorrect.';
                    $class = 'media';
                }else{
                    $message = 'Please check User Password is incorrect.';
                    $class = 'password';
                }
                $data = array( 'status' => 0 , 'class' => $class, 'message' => $message );
                return response()->json($data);
            }   
        }else{
            $data = array( 'status' => 0 , 'class' => 'user_name', 'message' => 'Please check Detail.');
            return response()->json($data);
        }    
    }
}
