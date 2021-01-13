<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// |--------------------------------------------------------------------------
// | AnhNH Template
// |--------------------------------------------------------------------------
Route::get('anhnh', function(){
	return "AnhNH is Here";
});

// Truyen tham so
Route::get('user1/{id}/{name}/{comment}', function($id, $name, $comment) {
      echo "ID của user là : " . $id;
      echo "<br>Tên của user là : " . $name;
      echo "<br> Comment của user: " . $comment;
});

// fix cung gia tri cho tham so
Route::get('user2/{name?}', function($name = 'default') {
      echo "Tên của user là : " . $name;
});

// them dieu kien cho uri, regex
Route::get('user3/{name}', function($name) {
      echo "Tên của user là : " . $name;
}) ->where(['name' => '[a-zA-Z]+']);

// Dinh danh Route de goi toi Route khac
//C1:
Route::get('Route1',['as' => 'MyRoute',function(){
	return "AnhNH1 is Here";
}] );
//C2:
Route::get('Route2', function(){
	return "AnhNH2 is Here";
})->name('MyRoute2');
// redirect
Route::get('test_iden', function(){
	return redirect()->route('MyRoute2');
});

//Group prefix, middleware
Route::group(['prefix'=> 'MyGroup'], function(){
  //domain/MyGroup/member1
  Route::get('member1', function(){
    echo "Member1";
  });
  //domain/MyGroup/member2
  Route::get('member2', function(){
    echo "Member2";
  });
  //domain/MyGroup/member3
  Route::get('member3', function(){
    echo "Member3";
  });
});

// Call controller and func Hello
use App\Http\Controllers\AnhNHController;
  // Co tham so
  Route::get('callcontroller/{var1}', [AnhNHController::class, 'Hello']);
  //Khong tham so
  Route::get('callcontroller', [AnhNHController::class, 'Hi']);
  Route::get('rr', [AnhNHController::class, 'redirectRouter']);

// |--------------------------------------------------------------------------
// | AnhNH Template
// |--------------------------------------------------------------------------