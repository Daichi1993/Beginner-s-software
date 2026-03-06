<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UtentiController;
use App\Http\Controllers\StipendiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\BatchController;
use App\helper;

 
use Illuminate\Support\Facades\Route;

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

Route::resource('user', UtentiController::class);
 

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard'], function () {

    Route::any('lista', [DashboardController::class, 'list'])->name('dashboard.list');
    Route::any('utenti', [DashboardController::class, 'lista_utenti'])->name('dashboard.utenti');
    Route::any('index', [DashboardController::class, 'index'])->name('dashboard.index');

});

Route::group(['prefix' => 'calendario'], function () {

    Route::any('index', [CalendarioController::class, 'index'])->name('calendario.index');
    // Route::any('utenti', [CalendarioController::class, 'index'])->name('dashboard.utenti');
    // Route::any('index', [CalendarioController::class, 'index'])->name('dashboard.index');
// 
});

// ROTTE DASHBOARD

// ROTTE DI AUTENTICAZIONE
Route::group(['prefix' => 'autenticazione'], function () {

    Route::any('login', [AuthController::class, 'login'])->name('login');
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('login_1', [AuthController::class, 'store'])->name('login_1');
    Route::any('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::any('backdoor', [AuthController::class, 'backdoor'])->name('backdoor');

});

// ROTTE UTENTI
Route::group(['prefix' => 'utenti'], function () {

    Route::any('index', [UtentiController::class, 'index'])->name('utenti.index');
    Route::any('list', [UtentiController::class, 'list'])->name('utenti.list');
    Route::any('utenti', [UtentiController::class, 'lista_utenti'])->name('utenti.utenti');
 

});

Route::group(['prefix' => 'stipendi'], function () {

        Route::any('index', [StipendiController::class, 'index'])->name('stipendi.index');



    // Route::any('lista_stipendi', [StipendiController::class, 'lista_stipendi'])->name('login');
    // Route::any('list', [StipendiController::class, 'list'])->name('logout');
    // Route::post('update', [StipendiController::class, 'update'])->name('login_1');
    // Route::any('destroy', [StipendiController::class, 'destroy'])->name('authenticate');
    // Route::any('store', [StipendiController::class, 'store'])->name('backdoor');

});

Route::any('costruisciUrl', [BatchController::class, 'costruisciUrl'])->name('costruisciUrl');
    
    
