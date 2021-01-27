<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controller_Homework extends Controller
{
    function listResult(){
        
        
        
        return view('homework.view_ListResult');
    }
    
    function uploadHomework(){
        
        
        return view('homework.view_UploadHomework');
    }
    
    function submitHistory(){
        
        
        return view('homework.view_SubmitHistory');
    }
    
    function getHomework(){
        
        return view('homework.view_AvailableHomework');
    }
}
