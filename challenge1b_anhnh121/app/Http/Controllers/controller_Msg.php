<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controller_Msg extends Controller
{
    function getInbox(){
        
        
        return view('msg.view_Inbox');
    }
    
    function getOutbox(){
        
        
        return view('msg.view_Sent');
    }
    
    function sendMsg(){
        
        
        return view('msg.view_SendMsg');
    }
}
