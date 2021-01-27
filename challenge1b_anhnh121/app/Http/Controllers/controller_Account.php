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
        echo $request->username;
        echo $request->password;
        $arr = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
//        if(Auth::attempt(['acc_username'=>$logon_username, 'acc_password'=>$logon_password])){
        if (Auth::guard('account')->attempt($arr)){
             dd('OK');
        }else{
            return redirect('getLogin');
        }
    }
    
    function updateProfile() {
        
        
        
        return view('accounts.view_Profile'); 
    }
    
    function changePassword(){
        
        
        return view('accounts.view_ChangePass');
    }
    
    function listUser(){
        
        
        return view('accounts.view_ListUser');
    }
    
    
    function updateUser(){
        
        
        return view('accounts.view_UpdateUser');
    }
    
    
    function addUser(){
        
        
        return view('accounts.view_AddUser');
    }
}
