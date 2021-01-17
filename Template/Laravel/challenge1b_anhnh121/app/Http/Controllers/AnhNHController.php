<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function TestRequest(Request $request){
    	// return $request->url();
    	echo $request->url();
    	echo "<br>";
    	echo $request->is('My*'); 
    	echo "<br>";
    	echo $request->path();
    	echo "<br>";
    	echo $request->isMethod("get"); 
    }

    public function postRequest(Request $request){
    	echo $request->HoTen;
    	echo $request->input('HoTen');
    	// Kiem tra tham so password co ton tai ko
    	$request->has('password');
    	// Nhận dữ liệu từ thẻ <input name='id' >
    	$request->input('id');
    	// Nhan all luu thanh array
    	$request->all();
    	$request->only('age');
    	$request->except('age');
    }

    public function getCookie(Request $request){
    	$value = $request->cookie('nameCookie');
    	echo $value;
    }

    public function setCookie(){
    	// $response = new Response;
    	$response = new Response('Hello Cookie');
    	$minute = 1;
    	$response->withCookie(cookie('nameCookie','valueCookie',$minute));
    	return $response;
    }

    public function postFileRequest(Request $request){
        //check tham so myFile
        if($request->hasFile('myFile')){
            //save file
            $file = $request->file('myFile');

            $valid = $file->isValid();
            echo $valid. "<br>";
            //Display File Name
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';

            //Display File Extension
            echo 'File Extension: '.$file->getClientOriginalExtension();
            echo '<br>';

            //Display File Real Path Tmp Path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';

            //Display File Size
            echo 'File Size: '.$file->getSize();
            echo '<br>';

            //Display File Mime Type
            echo 'File Mime Type: '.$file->getMimeType();
            
            //Move Uploaded File
            $destinationPath = 'anhnh_testupload'; //path public/anhnh_testupload
            $destinationName = 'Saved.png'; //$file->getClientOriginalName()
            $file->move($destinationPath,$destinationName);
            
        } else {
            echo "Chua co File";
        }    
    }
    
    public function setJSON(){
        $data = [
            'name'=>'Altair',
            'type'=>'Akatsuki',
            'skill'=>'Amaterasu'
        ];
        return response()->json($data);
    }
    
    public function Time($time){
        return view('anhnhView.myView', ['test'=> $time]);
    }
    
    public function ShareView(){
        return view('anhnhView.shareView');
    }
    public function BladeTemp($str){
        if($str == "sub1"){
            return view('anhnhView.sub.sub1');
        }elseif ($str == "sub2") {
            return view('anhnhView.sub.sub2');
        }
    }
    
}

// |--------------------------------------------------------------------------
// | AnhNH Template
// |--------------------------------------------------------------------------