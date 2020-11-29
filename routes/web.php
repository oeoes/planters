<?php

use App\Http\Controllers\Foreman1Controller;
use App\Http\Controllers\Foreman2Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\HarvestingController;
use App\Http\Controllers\EmployeeController;

Route::get('/test', function() {return view('root.app'); });

Route::get('/', function() {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'loginform'])->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:assistant')->name('logout');

Route::group(['middleware' => ['auth:assistant']], function () {

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');    
    });

    Route::group(['prefix' => 'maintain'], function () {
        Route::get('/', [MaintainController::class, 'index'])->name('maintain.index');
        Route::post('/filter', [MaintainController::class, 'filter'])->name('maintain.filter');
    });


});

Route::get('/clear', function() { return session()->flush();});
// Route::get('/test', [TestController::class, 'each']);
// Route::get('/img', [TestController::class, 'img']);

