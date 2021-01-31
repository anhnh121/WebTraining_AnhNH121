<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Util\Util;
use App\Models\Homework;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class controller_Homework extends Controller
{

    public function uploadHomework(){
        return view('homework.view_UploadHomework');
    }
    public function submitUploadHomework(Request $request){
        $title = $request->title;
        $file = $request->file('myFile');
        $login_id = Auth::guard('account')->user()->acc_id;
        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time = date("h:i:sa d-m-Y");
        
        $extension = $file->getClientOriginalExtension();
        $destinationName = strtolower($title) . "." . $extension;
        $pathcheck = "homework\\" . $destinationName;
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
                    $error = "Duplicate !!! Change Title or Extension";
                }else{   
                    // Upload
                    $path = Storage::putFileAs('homework', $file, $destinationName);
                    // Insert DB
                    $newhw = new Homework();
                    $newhw->hw_title = $title;
                    $newhw->hw_path = $path;
                    $newhw->hw_uptime = $time;
                    $newhw->hw_teacherid = $login_id;
                    $newhw->save();
                    $error="Upload OK";
                }
            }
        }
        
        $util = new Util();
        $util->phpAlert($error);
        
        return redirect()->route('route_UploadHomework');
    }
    
    public function getHomework(){
        $full_list = DB::table('HOMEWORKS')->get();
        $data = json_decode(json_encode($full_list), true);
        
        $newdata = array();
        foreach ($data as $item){
            $id_temp = $item["hw_id"];
            $temp = Homework::find($id_temp);
            $item["teacher"] = $temp->hw_acc->username;
            array_push($newdata, $item);
        }
        return view('homework.view_AvailableHomework')->with('data', $newdata);
    }
    public function downloadHomework($hwid){
        $hw = Homework::find($hwid);
        $path = $hw->hw_path;
        if(Storage::exists($path)){
            return Storage::download($path);
        }else{
            $error = "File is not exist";
            $util = new Util();
            $util->phpAlert($error);
            return redirect()->back();
        }

    }
    
}
