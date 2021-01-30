<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\controller_Account;
use App\Http\Controllers\controller_Game;
use App\Http\Controllers\controller_Homework;
use App\Http\Controllers\controller_Msg;
use App\Http\Controllers\controller_Result;
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
    echo $msg2->msg_sender_acc->username;
    echo "<br>";
    echo $msg2->msg_recver_acc->username;
    echo "<br>";
    $temp = Results::find(1);
    echo $temp->kq_hw->hw_title;
    echo "<br>";
    echo $temp->kq_acc->username;
    echo "<br>";
    
    $temp = Homework::find(1);
    foreach ($temp->hw_kq as $tmp1) {
        echo $tmp1->kq_id;
        echo "<br>";
        echo $tmp1->kq_path;
        echo "<br>";
    }
    echo $temp->hw_acc->username;
    
});

// Blade
//////////////////////////////// Login ////////////////////////////////

Route::get('getLogin', [controller_Account::class, 'getLogin']);
Route::post('postLogin', [controller_Account::class, 'postLogin'])->name('loginRoute');
Route::get('logout', [controller_Account::class, 'logout'])->name('logout');

Route::group(['prefix'=> 'User', 'middleware'=>'user'], function(){
    Route::get('updateprofile', [controller_Account::class, 'updateProfile'])->name('route_UpdateProfile');
    Route::post('postprofile', [controller_Account::class, 'submitUpdateProfile'])->name('UpdateProfile');
    
    Route::get('changepass', [controller_Account::class, 'changePassword'])->name('route_ChangePassword');
    Route::post('postpass', [controller_Account::class, 'submitChangePassword'])->name('ChangePassword');

    Route::get('listuser', [controller_Account::class, 'listUser'])->name('route_ListUser');
    
    Route::get('sendmsg/{id}', [controller_Msg::class, 'sendMsg'])->name('route_SendMsg');
    Route::post('postmsg', [controller_Msg::class, 'postMsg'])->name('SendMsg');
    
    Route::get('inbox', [controller_Msg::class, 'getInbox'])->name('route_GetInbox');
    
    Route::get('sent', [controller_Msg::class, 'getOutbox'])->name('route_GetOutbox');
    Route::post('postsent', [controller_Msg::class, 'submitUpdateMsg'])->name('UpdateMsg');
    
    Route::get('game', [controller_Game::class, 'getChallenge'])->name('route_Challenge');
});

Route::group(['prefix'=> 'Student', 'middleware'=>['user', 'student']], function(){
    Route::get('submithistory', [controller_Homework::class, 'submitHistory'])->name('route_SubmitHistory');
    Route::get('homework', [controller_Homework::class, 'getHomework'])->name('route_GetHomework');
    
});

Route::group(['prefix'=> 'Teacher', 'middleware'=>['user', 'teacher']], function(){
  //domain/Student/member1
    Route::get('updateuser', [controller_Account::class, 'updateUser'])->name('route_UpdateUser');
    Route::post('postupdateuser', [controller_Account::class, 'submitUpdateUser'])->name('UpdateUser');
    
    Route::get('adduser', [controller_Account::class, 'addUser'])->name('route_AddUser');
    Route::post('postadduser', [controller_Account::class, 'submitAddUser'])->name('AddUser');
    
    Route::get('listresult', [controller_Homework::class, 'listResult'])->name('route_ListResult');
    Route::get('uploadhw', [controller_Homework::class, 'uploadHomework'])->name('route_UploadHomework');
    
    Route::get('uploadgame', [controller_Game::class, 'uploadGame'])->name('route_UploadGame');
    Route::post('postupgame', [controller_Game::class, 'submitUploadGame'])->name('UploadGame');
    
});
////////////////////////////////// Profile //////////////////////////////////
//
//Route::get('updateprofile', [controller_Account::class, 'updateProfile'])->name('route_UpdateProfile');
//Route::get('changepass', [controller_Account::class, 'changePassword'])->name('route_ChangePassword');
//
////////////////////////////////// List User ////////////////////////////////
//
//Route::get('listuser', [controller_Account::class, 'listUser'])->name('route_ListUser');
//
////////////////////////////////// Student Management ///////////////////////
//
//Route::get('updateuser', [controller_Account::class, 'updateUser'])->name('route_UpdateUser');
//
//Route::get('adduser', [controller_Account::class, 'addUser'])->name('route_AddUser');
//
////////////////////////////////// Teacher Homework /////////////////////////
//
//Route::get('listresult', [controller_Homework::class, 'listResult'])->name('route_ListResult');
//
//Route::get('uploadhw', [controller_Homework::class, 'uploadHomework'])->name('route_UploadHomework');
//
////////////////////////////////// Student Homework /////////////////////////
//
//Route::get('submithistory', [controller_Homework::class, 'submitHistory'])->name('route_SubmitHistory');
//
//Route::get('homework', [controller_Homework::class, 'getHomework'])->name('route_GetHomework');
//
////////////////////////////////// Mail Box /////////////////////////////////
//
//Route::get('inbox', [controller_Msg::class, 'getInbox'])->name('route_GetInbox');
//
//Route::get('sent', [controller_Msg::class, 'getOutbox'])->name('route_GetOutbox');
//
//Route::get('sendmsg', [controller_Msg::class, 'sendMsg'])->name('route_SendMsg');
//
////////////////////////////////// Challenge ////////////////////////////////
//
//Route::get('uploadgame', [controller_Game::class, 'uploadGame'])->name('route_UploadGame');
//
//Route::get('game', [controller_Game::class, 'getChallenge'])->name('route_Challenge');

///////////////////////////////////////////////////////////////////////////


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
