<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Support\Facades\Auth;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
function __construct() {
//    $this->isLoginOK();
//    echo Auth::guard('account')->user();
}


function isLoginOK(){
        if(Auth::guard('account')->check()){
            echo Auth::guard('account')->user();
//            view()->share('logon_user', Auth::guard('account')->user());
        }
    }
}
