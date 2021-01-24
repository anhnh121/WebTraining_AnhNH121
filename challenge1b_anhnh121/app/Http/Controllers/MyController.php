<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function getLogin(){
        return view('loginForm');
    }
    
    public function postLogin(Request $request){
        $logon_username = $request->username;
        $logon_password = $request->password; 

//        $this->validate($request,[
//            'username'=>'required',
//            'password'=>'required'
//        ],[
//            'username.required'=> 'Press Username',
//            'password.required'=> 'Press Password',
//        ]);
        if(Auth::attempt(['acc_username'=>$logon_username, 'acc_password'=>$logon_password])){
            echo 'OK';
        }else{
            return redirect('loginForm')->with('Warning!!!', 'Wrong User or Password');
        }
    }
}
