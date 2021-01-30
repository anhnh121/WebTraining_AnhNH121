<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Game;
use App\Util\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 

class controller_Game extends Controller
{
    public function uploadGame(){ 
        return view('game.view_UploadGame');
    }
    public function submitUploadGame(Request $request){
        $hint = $request->hint;
        if($request->hasFile('myFile')){
            $file = $request->file('myFile');
            $originalfull = $file->getClientOriginalName();
            $namenoext = basename($originalfull, ".txt");
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            // Check upload OK
            $valid = $file->isValid();
            if($valid == false){
                $error = "Upload Failed";
            }else{
                if($size > 1000000){
                    $error = "File too large !!!";
                }elseif($extension !== "txt"){
                    $error = "Your file extension must be .txt";
                }else{
                // Insert DB
                $newgame = new Game();
                $newgame->game_hint = $hint;
                $newgame->save();
                $nowid = $newgame->game_id;
                //Move Uploaded File
                $destinationPath = 'upload_game'; //path public/upload_game
                $destinationName = $namenoext . ".id" . $nowid;

                $file->move($destinationPath,$destinationName);
                $error = "Upload OK";
                }
   
            }
            
        }else{
            $error = "Upload File plz !!!";
        }
        $util = new Util();
        $util->phpAlert($error);
        return redirect()->route('route_UploadGame');
    }
    
    public function getChallenge(){
        
//        echo Auth::guard('account')->user();
        
        return view('game.view_Challenge');
    }
}
