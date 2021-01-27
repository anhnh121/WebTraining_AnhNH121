<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class controller_Game extends Controller
{
    function uploadGame(){
        
        
        
        return view('game.view_UploadGame');
    }
    
    function getChallenge(){
        
//        echo Auth::guard('account')->user();
        
        return view('game.view_Challenge');
    }
}
