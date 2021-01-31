<?php

namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\Msg;
use App\Models\Results;
use App\Models\Homework;
use Auth;
use Illuminate\Http\Request;
use App\Util\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
            $msg = 'Login Failed !!!';
            $util = new Util();
            $util->phpAlert($msg);
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
    public function submitUpdateProfile(Request $request){
        $new_email = $request->email;
        $new_phone = $request->phone;
//        echo $new_email;
//        echo $new_phone;
        $check_email = Auth::guard('account')->user()->acc_email;
        $check_phone = Auth::guard('account')->user()->acc_phone;
        $login_id = Auth::guard('account')->user()->acc_id;
        
        if(($check_phone === $new_phone) and ($new_email === $check_email)){
            $msg = 'Nothing Changes';
            $util = new Util();
            $util->phpAlert($msg);
        } else {
            $current_user = Account::find($login_id);
            $current_user->acc_email = $new_email;
            $current_user->acc_phone = $new_phone;
            $current_user->save();
//            $msg = 'Update OK';
        }
        return redirect()->route('route_UpdateProfile');
    }
    
    public function changePassword(){
        return view('accounts.view_ChangePass');
    }
    public function submitChangePassword(Request $request){
        $oldpass = $request->old_password;
        $newpass = $request->new_password;
        $repass = $request->re_password;
        
        $login_id = Auth::guard('account')->user()->acc_id;
        $current_user = Account::find($login_id);
        
//        if(password_verify($oldpass, $current_user->password) === true){
//            echo 'OK';
//        }
        if((password_verify($oldpass, $current_user->password) !== true) or ($oldpass === $newpass)){
            $msg = "Your Current or New Password is invalid";
        } elseif ($newpass !== $repass) {
            $msg = "You entered two different passwords";
        } else{
            $current_user->password = bcrypt($newpass);
            $current_user->save();
            $msg = "Update OK";
        }
        $util = new Util();
        $util->phpAlert($msg);
        return redirect()->route('route_ChangePassword');
    }
    
    
    public function listUser(){
        $login_id = Auth::guard('account')->user()->acc_id;
        $full_list = DB::table('ACCOUNTS')->where('acc_id', '!=', $login_id)->get();
        // StdClass to Array
        $data = json_decode(json_encode($full_list), true);
//            foreach ($row as $key=>$item){
//               echo $key.":".$item;
//               echo "<br>";
//                
//            }
//        foreach ($data as $row){
//            $i++;
//            echo $row['acc_phone'];
//        }
        return view('accounts.view_ListUser')->with('data', $data);
    }
    
    
    public function updateUser(){
        $full_list = DB::table('ACCOUNTS')->where('acc_role', '=', 1)->get();
        // StdClass to Array
        $data = json_decode(json_encode($full_list), true);
        
        return view('accounts.view_UpdateUser')->with('data', $data);
    }
    public function submitUpdateUser(Request $request){
        if($request->edit === "edit" and $request->delete === null){
            $editeid = $request->edited_id;
            
            $usernew = $request->username;
            $passnew = bcrypt($request->password);
            $namenew = $request->fullname;
            $emailnew = $request->email;
            $phonenew = $request->phone;
            
            $edited_user = Account::find($editeid);
  
            if(DB::table('ACCOUNTS')->where('acc_id','!=', $editeid)->where('username', $usernew)->exists()){
                $error = "Sorry... username already taken";
                $util = new Util();
                $util->phpAlert($error);
            }elseif(($usernew === $edited_user->username) and ($namenew === $edited_user->acc_fullname) and
                    ($emailnew === $edited_user->acc_email) and ($phonenew === $edited_user->acc_phone) and
                    ($request->password === $edited_user->password)){
                $error = "Nothing changes";
                $util = new Util();
                $util->phpAlert($error);
            }
            else{
                $edited_user->username = $usernew;
                $edited_user->password = $passnew;
                $edited_user->acc_fullname = $namenew;
                $edited_user->acc_email = $emailnew;
                $edited_user->acc_phone = $phonenew;
                
                $edited_user->save();
                $error = "Update OK";
            }
        }elseif ($request->delete === "delete" and $request->edit === null) {
            $userid = $request->edited_id;
            $acc = Account::find($userid);
            // Delete all Msg
            Msg::where('msg_idsender', $userid)->delete();
            Msg::where('msg_idrecver', $userid)->delete();
            // Delete all Result
            $del_rs = Results::where('kq_studentid', $userid)->get();
            $data = json_decode(json_encode($del_rs), true);
            foreach ($data as $item){
                $del_path = $item["kq_path"];
                Storage::delete($del_path);
            }
            Results::where('kq_studentid', $userid)->delete();
            // Delete Accounts
            Account::destroy($userid);
            
        }else{
            $error = 'Something when wrong';
                    
            $util = new Util();
            $util->phpAlert($error);
        }
     
        return redirect()->back();
    }
    
    public function addUser(){
        return view('accounts.view_AddUser');
    }
    public function submitAddUser(Request $request){
        $usernew = $request->username;
        $passnew = bcrypt($request->password);
        $namenew = $request->fullname;
        $emailnew = $request->email;
        $phonenew = $request->phone;
        $role = 1;
        if(DB::table('ACCOUNTS')->where('username', $usernew)->exists()){
            $error = "Sorry... username already taken";
        }else{
            DB::table('ACCOUNTS')->insert([
                'username'=>$usernew,
                'password'=>$passnew,
                'acc_fullname'=>$namenew,
                'acc_email'=>$emailnew,
                'acc_phone'=>$phonenew,
                'acc_role'=>$role
            ]);
            $error = "Add OK !!!";
        }  

        $util = new Util();
        $util->phpAlert($error);
        return redirect()->route('route_AddUser');
    }
    
}
