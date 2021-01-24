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

Route::get('anhnh', function () {
    return view('loginForm');
});

 Route::get('login', [MyController::class, 'getLogin']);
 Route::post('postLogin', [MyController::class, 'postLogin'])->name('loginRoute');