<?php

namespace App\Http\Controllers;

use App\Models\Results;
use App\Models\Homework;
use App\Models\Account;
use Auth;
use Illuminate\Http\Request;
use App\Util\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class controller_Result extends Controller
{
    public function submitHistory(){
        $login_id = Auth::guard('account')->user()->acc_id;
        
        $full_list = DB::table('RESULTS')->where('kq_studentid', '=', $login_id)->get();
        $data = json_decode(json_encode($full_list), true);
        $newdata = array();
        foreach ($data as $item){
            $id_temp = $item["kq_id"];
            $temp = Results::find($id_temp);
            $item["title"] = $temp->kq_hw->hw_title;
            array_push($newdata, $item);
        }
          
        return view('homework.view_SubmitHistory')->with('data', $newdata);
    }
    
    public function deleteHistory(Request $request){
        $idrow =  $request->idrow;
        $kq = Results::find($idrow);
        $pathdel = $kq->kq_path;
        Storage::delete($pathdel);
        Results::destroy($idrow);
           
        return redirect()->route('route_SubmitHistory');
    }
    
    public function listResult(){
        $full_list = DB::table('RESULTS')->get();
        $data = json_decode(json_encode($full_list), true);
        
        $newdata = array();
        foreach ($data as $item){
            $kqid = $item["kq_id"];
            
            $kq = Results::find($kqid);
            
            $item["teacher"] = $kq->kq_hw->hw_acc->username;
            $item["title"] = $kq->kq_hw->hw_title;
            $item["student"] = $kq->kq_acc->username;
            
            array_push($newdata, $item);
        }
//        var_dump($newdata);
        
        return view('homework.view_ListResult')->with('data', $newdata);
    }
    
    public function downloadResult($kqid){
        $kq = Results::find($kqid);
        $path = $kq->kq_path;
        if(Storage::exists($path)){
            return Storage::download($path);
        }else{
            $error = "File is not exist";
            $util = new Util();
            $util->phpAlert($error);
            return redirect()->back();
        }
    }
    
    public function postResult(Request $request){
        $hwid = $request->idrow;
        
        $temp = Homework::find($hwid);
        $title = $temp->hw_title;
        
        $file = $request->file('myFile');
        
        $login_id = Auth::guard('account')->user()->acc_id;
        $namestd = Auth::guard('account')->user()->username;
        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time = date("h:i:sa d-m-Y");
        
        $extension = $file->getClientOriginalExtension();
        $destinationName = strtolower($title) . "_" . strtolower($namestd) . "." . $extension;   
        $pathcheck = "result\\" . $destinationName;
        $size = $file->getSize();
        $valid = $file->isValid();
        if($valid == false){
            $error = "Upload Failed";
        }else{
            if($size > 1000000){
                $error = "File too large !!!";
            }elseif(!in_array($extension, ['zip', 'pdf', 'doc', 'docx', 'txt'])){
                $error = "Your file extension must be .zip, .pdf, .doc, .docx, .txt";
            }else{
                if(Storage::exists($pathcheck)){
                    $error = "Duplicate !!! You need delete old Result in History";
                }else{
                    // Upload
                    $path = Storage::putFileAs('result', $file, $destinationName);
                    // Insert DB
                    $newkq = new Results();
                    $newkq->kq_path = $path;
                    $newkq->kq_uptime = $time;
                    $newkq->kq_studentid = $login_id;
                    $newkq->kq_homeworkid = $hwid;
                    $newkq->save();
                    $error="Upload OK";
                }
            }   
        }
                
        $util = new Util();
        $util->phpAlert($error);        
        return redirect()->route('route_GetHomework');
    }
}
