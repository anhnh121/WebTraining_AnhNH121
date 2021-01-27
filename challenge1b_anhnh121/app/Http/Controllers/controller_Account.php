<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Auth;
use Illuminate\Http\Request;

class controller_Account extends Controller
{
    public function getLogin(){
        return view('view_Login');
    }
    
    public function postLogin(Request $request){
//        echo $request->username;
//        echo $request->password;
        $arr = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
//        if(Auth::attempt(['acc_username'=>$logon_username, 'acc_password'=>$logon_password])){
        if (Auth::guard('account')->attempt($arr)){
//            view()->share('logon_user', Auth::guard('account')->user());
            return view('accounts.view_Profile');
        }else{
            return redirect('getLogin');
        }
    }
    public function logout(){
        
        Auth::guard('account')->logout();
//        echo Auth::guard('account')->user()->username;
        return view('view_Login');
    }
    
    public function updateProfile() {
        
        
        
        return view('accounts.view_Profile'); 
    }
    
    public function changePassword(){
        
        
        return view('accounts.view_ChangePass');
    }
    
    public function listUser(){
        
        
        return view('accounts.view_ListUser');
    }
    
    
    public function updateUser(){
        
        
        return view('accounts.view_UpdateUser');
    }
    
    
    public function addUser(){
        
        
        return view('accounts.view_AddUser');
    }
}
