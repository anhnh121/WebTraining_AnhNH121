<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Game;
use App\Util\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage; 

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
//                $destinationPath = 'upload_game'; //path public/upload_game
                $destinationName = strtolower($namenoext) . ".id" . $nowid;

//                $file->move($destinationPath,$destinationName);
                $path = Storage::putFileAs('game', $file, $destinationName);
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
        $full_list = DB::table('GAME')->get();
        $data = json_decode(json_encode($full_list), true);
        
        return view('game.view_Challenge')->with('data', $data);
    }
    public function postChallenge(Request $request){
        $result = strtolower($request->result);
        $id = $request->idrow;
        $temp = $result . ".id" . $id;
        $pathcheck = "game\\" . $temp;
        
//        $path = Storage::path($pathcheck);
        if (Storage::exists($pathcheck)){         
            $content = Storage::get($pathcheck);
//            echo nl2br($content);
            return view('game.view_Final')->with('content', $content)->with('title', strtoupper($result));
        }else{
            $error = "Wrong!!! Try Again";
            $util = new Util();
            $util->phpAlert($error);
            
            return redirect()->back();
        }
        
    }
}
