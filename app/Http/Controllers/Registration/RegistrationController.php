<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index(){
        return view('pages.registration.index');
    }

    public function userLoginToken() {
        do {
            $number = random_int(1000000000, 9999999999);
        } while (User::where("login_access_token", "=", $number)->first());
    
        return $number;
    }


    public function postRegistration( Request $request ){
        $request->validate([
            'name' => 'required||unique:users,user_name',
            'email_address' => 'required|email|unique:users',
            'password' => 'required|min:10'
        ]);

        $currentDate = date('Y-m-d H:i:s');

        $userAccessToken = $this->userLoginToken();

        $data = $request->all();
        $createUser =   User::create([
                        'user_name' => $data['name'],
                        'advertiser_id' => 7,
                        'login_access_token' => $userAccessToken,
                        'email_address' => $data['email_address'],
                        'role' => 'advertiser',
                        'vadit_from' => $currentDate,
                        'vadit_till' => $currentDate ,
                        'remember_token' => '1234567890',
                        'image' => '',
                        'status' => 'active',
                        'login_access_status' => 0,
                        'delete' => 0,
                        'created_by' => 1,
                        'updated_by' => 1,
                        'password' => Hash::make($data['password'])
                    ]);
        if( $createUser ){
            return redirect("registration")->withSuccess('123 Great! You have Successfully loggedin');
        }else{
            return redirect("registration")->withSuccess('Great! You have Successfully loggedin');
        }
    }
}
