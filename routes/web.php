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

use App\Http\Controllers\ManualAuthenticateUserController;
use App\Http\Controllers\RkhrawatController;
use App\Http\Controllers\Md1Controller;
use App\Http\Controllers\Md2Controller;

Route::get('/', [ManualAuthenticateUserController::class, 'index'])->middleware('guest');
// Route::get('/login', 'LoginController@login');
Route::post('/login', [ManualAuthenticateUserController::class, 'process']);
Route::get('/logout', [ManualAuthenticateUserController::class, 'logout']);

Route::group(['prefix' => 'assistant', 'middleware' => ['auth:assistant']], function () {
  Route::group(['prefix' => 'rkh'], function() {
    Route::get('/rawat', [RkhrawatController::class, 'index']);
    Route::get('/test', [RkhrawatController::class, 'test']);
  });
  Route::get('/', function () {
    return view('assistant.welcome');
  });
});

Route::group(['prefix' => 'md1', 'middleware' => ['auth:md1']], function () {
  Route::get('/', [Md1Controller::class, 'index']);
  Route::get('/create', [Md1Controller::class, 'create'])->name('rkh.create');
  Route::get('/rawat', [Md1Controller::class, 'rawat'])->name('rkh.create.rawat');
  Route::get('/panen', [Md1Controller::class, 'panen'])->name('rkh.create.panen');
  Route::get('/test', [Md1Controller::class, 'test']);
});

Route::group(['prefix' => 'md2', 'middleware' => ['auth:md2']], function () {
  Route::get('/', [Md2Controller::class, 'index']);
});



Route::get('/clear', function() {
  Session::flush();
});
