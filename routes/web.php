<?php

use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\UtentiController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\AuthController;

Route::singularResourceParameters(false); //ATTENZIONE - importante non toccare


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

// Route::get('/', function () {
//     return view('welcome');
// });

 

Route::any('login', [AuthController::class, 'login'])->name('login');
Route::any('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('login_1', [AuthController::class, 'store'])->name('login_1');

Route::any('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::any('backdoor', [AuthController::class, 'backdoor'])->name('backdoor');




Route::any('list', [UtentiController::class,'list'])->name('list'); 
Route::any('dashboard', [UtentiController::class,'list'])->name('dashboard'); 
Route::any('index', [MainController::class,'index'])->name('index'); 
Route::resource('user', UtentiController::class);



    



// Route::any('login_0', [LoginController::class,'index',"login_0" => 0])->name('login_0'); 
// Route::any('login_1', [LoginController::class,'index',"login_1" => 1])->name('login_1');
 
// Route::any('/welcome', 'welcome', ['name' => 'Taylor']);

// Route::get('login99', ["uses" => "Auth\LoginController@index", "accesso99" => 1])->name('login99');
// Route::post('login/{accesso99}', "Auth\LoginController@login")->name("set_login");
// Route::post("login2", "Auth\LoginController@login2")->name("login2");
// Route::any('logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('reset_password_from_token', 'UtentiController@reset_password_from_token')->name('reset_password_from_token');
// Route::any('reset_password', 'UtentiController@reset_password')->name('reset_password');
// Route::post('change_password_from_token', 'UtentiController@change_password_from_token')->name('change_password_from_token');

// if (config("auth.use_google_auth")) {
//     Route::prefix("auth")->group(function () {
//         Route::prefix("google")->group(function () {
//             Route::any('', 'Auth\GoogleController@redirectToGoogle')->name("auth.google");
//             Route::get('callback', 'Auth\GoogleController@handleGoogleCallback')->name("auth.google_callback");
//         });
//     });
// }
 
 


 

