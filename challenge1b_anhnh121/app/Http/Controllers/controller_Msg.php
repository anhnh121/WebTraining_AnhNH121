<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Util\Util;
use App\Models\Msg;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class controller_Msg extends Controller
{
    public function getInbox(){
        $login_id = Auth::guard('account')->user()->acc_id;
        
        $full_list = DB::table('MSG')->where('msg_idrecver', '=', $login_id)->get();
        $data = json_decode(json_encode($full_list), true);
        $newdata = array();
        foreach ($data as $item){
            $id_temp = $item["msg_id"];
            $temp = Msg::find($id_temp);
            $item["sender"] = $temp->msg_sender_acc->username;
            array_push($newdata, $item);
        }
//        var_dump($newdata);
        return view('msg.view_Inbox')->with('data', $newdata);
    }
    
    public function getOutbox(){
        $login_id = Auth::guard('account')->user()->acc_id;
        $full_list = DB::table('MSG')->where('msg_idsender', '=', $login_id)->get();
        $data = json_decode(json_encode($full_list), true);
        $newdata = array();
        
        foreach ($data as $item){
            $id_temp = $item["msg_id"];
            $temp = Msg::find($id_temp);
            $item["recver"] = $temp->msg_recver_acc->username;
            array_push($newdata, $item);
        }
//        var_dump($newdata);        
        return view('msg.view_Sent')->with('data', $newdata);
    }
    public function submitUpdateMsg(Request $request){
        $editeid = $request->edited_id;
        $newmsg = $request->msg;
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $newtime = date("h:i:sa d-m-Y");
        
        $edited_msg = Msg::find($editeid);
        
        if($request->edit === "edit" and $request->delete === null){
            if($newmsg === $edited_msg->msg_msg){
                $error = "Nothing changes";
                $util = new Util();
                $util->phpAlert($error);
            }else{               
                $edited_msg->msg_msg = $newmsg;
                $edited_msg->msg_time = $newtime;
                
                $edited_msg->save();
            }
        }elseif ($request->delete === "delete" and $request->edit === null) {
            $edited_msg = Msg::destroy($editeid);
//            echo "Delete";
        }else{
            $error = 'Something when wrong';
                    
            $util = new Util();
            $util->phpAlert($error);
        }
     
        return redirect()->back();        
    }
    
    public function sendMsg($id){
//        echo $id;
        $current_user = Account::find($id);
        if($current_user->acc_role === 0){
            $role = "Teacher";
        }else{
            $role = "Student";
        }
        return view('msg.view_SendMsg')->with('user', $current_user)->with('role', $role);
    }
    public function postMsg(Request $request){
        $recver =  $request->recv_id;
        $newmsg = $request->msg;
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time = date("h:i:sa d-m-Y");
        $sender = Auth::guard('account')->user()->acc_id;
        if($newmsg == null){
            $error = "Write Something !!!";
            $util = new Util();
            $util->phpAlert($error);
            return redirect()->back();
        }else{
            DB::table('MSG')->insert([
                'msg_msg'=>$newmsg,
                'msg_idsender'=>$sender,
                'msg_idrecver'=>$recver,
                'msg_time'=>$time 
            ]);
            $error = "Send OK";
            $util = new Util();
            $util->phpAlert($error);
            return redirect()->route('route_ListUser');
        }
    }
}
