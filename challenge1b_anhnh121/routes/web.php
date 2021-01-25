<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
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
use App\Models\Account;
use App\Models\Game;
use App\Models\Homework;
use App\Models\Msg;
use App\Models\Results;

Route::get('testmodel', function () {
    foreach (Game::all() as $game) {
        echo $game->game_hint;
        echo "<br>";
    }
    echo "<br>";
    // has Many
    $acc1 = Account::find(3);
    foreach ($acc1->acc_kq_student as $tmp1) {
        echo $tmp1->kq_id;
        echo "<br>";
        echo $tmp1->kq_path;
        echo "<br>";
    }
    
    // belong
    $msg2 = Msg::find(1);
    echo $msg2->msg_sender_acc->acc_username;
    echo "<br>";
    echo $msg2->msg_recver_acc->acc_username;
    echo "<br>";
    $temp = Results::find(1);
    echo $temp->kq_hw->hw_title;
    echo "<br>";
    echo $temp->kq_acc->acc_username;
    echo "<br>";
    
    $temp = Homework::find(1);
    foreach ($temp->hw_kq as $tmp1) {
        echo $tmp1->kq_id;
        echo "<br>";
        echo $tmp1->kq_path;
        echo "<br>";
    }
    echo $temp->hw_acc->acc_username;
    
});

Route::get('login', function () {
    return view('accounts.view_Login');
});
Route::get('listuser', function () {
    return view('accounts.view_ListUser');
});
Route::get('updateuser', function () {
    return view('accounts.view_UpdateUser');
});

 Route::get('login', [MyController::class, 'getLogin'])->middleware('anhnh_middleware');
 Route::post('postLogin', [MyController::class, 'postLogin'])->name('loginRoute');
 
 //Group prefix, middleware
Route::group(['prefix'=> 'Teacher'], function(){
  //domain/Teacher/member1
  Route::get('member1', function(){
    echo "Member1";
  });
  //domain/Teacher/member2
  Route::get('member2', function(){
    echo "Member2";
  });
  //domain/Teacher/member3
  Route::get('member3', function(){
    echo "Member3";
  });
});

Route::group(['prefix'=> 'Student', 'middleware'=>'anhnh_middleware'], function(){
  //domain/Student/member1
  Route::get('member1', function(){
    echo "Member1";
  });
  //domain/Student/member2
  Route::get('member2', function(){
    echo "Member2";
  });
  //domain/Student/member3
  Route::get('member3', function(){
    echo "Member3";
  });
});