<?php

namespace App\Http\Controllers\Forgotpassword;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ForgotpasswordController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $data = array('data' => array('user_id' => $userId) );
        return view('pages.forgotpassword.index',  $data);
    }

    public function currentPassword( Request $request ){
        $credentials = $request->only('password');
        
        if (!Auth::attempt(['password' => $request['current_password'], 'id' => $request['user_id'] ])) {
            $data = array('status' => 0,'class' => 'current_password', 'message' => 'Please enter correct Password.');
            return response()->json($data);   
        }else{
            return true;
        }
    }

    public function postChangepassword( Request $request ){
        $updateDetails = User::where('id', $request['user_id'])->where('status', 1)->update([
            'password' => Hash::make($request['new_password']),
            'login_access_status' => 1
        ]);
        if( $updateDetails ){
            $data = array('status' => 1, 'message' => 'Sucessfully Password Updated.');
            return response()->json( $data);  
        }else{
            $data = array('status' => 0,'class' => 'new_password', 'message' => 'Password was not Updated.');
            return response()->json($data);  
        }
    }
    public function postCheckChangepassword(){
        $userId = Session::get('user_id');
        $changePasswordPopup = User::where('id','=', $userId )->get(['login_access_status'])->first()->toArray();
        if( $changePasswordPopup['login_access_status'] === 1 ){
            return true;
        }else{
            return false;
        }
    }
}
