<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// |--------------------------------------------------------------------------
// | AnhNH Template
// |php artisan make:controller AnhNHController
// |--------------------------------------------------------------------------
// use App\Http\Request;
class AnhNHController extends Controller
{
    public function Hello($name){
    	echo "Controller hello" . $name;
    }

    public function Hi(){
    	echo "Controller hi";
    }

    public function redirectRouter(){
    	return redirect()->route('MyRoute2');
    }
}

// |--------------------------------------------------------------------------
// | AnhNH Template
// |--------------------------------------------------------------------------