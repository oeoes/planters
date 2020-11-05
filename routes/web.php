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

use App\Http\Controllers\Web\AuthUserController;
use App\Http\Controllers\Web\RkhMaintainController;

    Route::get('/', [AuthUserController::class, 'index'])->middleware('guest');
    // Route::get('/login', 'LoginController@login');
    Route::post('/login', [AuthUserController::class, 'process']);
    Route::get('/logout', [AuthUserController::class, 'logout']);

    Route::group(['prefix' => 'assistant', 'middleware' => ['auth:assistant']], function () {
      Route::group(['prefix' => 'rkh'], function() {
        Route::get('/rawat', [RkhMaintainController::class, 'rawat'])->name('rkh.rawat');
        Route::post('/rawat', [RkhMaintainController::class, 'store'])->name('rkh.rawat.store');
        Route::get('/test', [RkhMaintainController::class, 'test']);
      });
      Route::get('/', function () {
        return view('assistant.welcome');
      });
    });

    Route::get('/clear', function() {
      Session::flush();
    });