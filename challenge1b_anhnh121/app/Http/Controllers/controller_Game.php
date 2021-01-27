<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controller_Game extends Controller
{
    function uploadGame(){
        
        
        
        return view('game.view_UploadGame');
    }
    
    function getChallenge(){
        
        
        
        return view('game.view_Challenge');
    }
}
