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

    Route::group(['prefix' => 'area'], function () {
        Route::group(['prefix' => 'farm'], function () {
            Route::get('/', [AreaController::class, 'farm'])->name('farm');
            Route::post('/', [AreaController::class, 'farm_store'])->name('farm.store');
            Route::put('/{farm}', [AreaController::class, 'farm_update'])->name('farm.update');
            Route::delete('/{farm}', [AreaController::class, 'farm_delete'])->name('farm.delete');
        });
        Route::group(['prefix' => 'afdelling'], function () {
            Route::get('/', [AreaController::class, 'afdelling'])->name('afdelling');
            Route::post('/', [AreaController::class, 'afdelling_store'])->name('afdelling.store');
            Route::post('/getafdelling', [AreaController::class, 'getAfdelling']);
            Route::put('/{afdelling}', [AreaController::class, 'afdelling_update'])->name('afdelling.update');
            Route::delete('/{afdelling}', [AreaController::class, 'afdelling_delete'])->name('afdelling.delete');
        });
        Route::group(['prefix' => 'block'], function () {
            Route::get('/', [AreaController::class, 'block'])->name('block');
            Route::post('/', [AreaController::class, 'block_store'])->name('block.store');
            Route::post('/getblock', [AreaController::class, 'getBlock']);
            Route::put('/{block}', [AreaController::class, 'block_update'])->name('block.update');
            Route::delete('/{block}', [AreaController::class, 'block_delete'])->name('block.delete');
        });
    });

    Route::group(['prefix' => 'foreman1'], function () {
        route::get('/', [Foreman1Controller::class, 'index'])->name('foreman1.index');
        Route::post('/store', [Foreman1Controller::class, 'store'])->name('foreman1.store'); 
        Route::put('/update/{foreman1}', [Foreman1Controller::class, 'update'])->name('foreman1.update'); 
        Route::delete('/delete/{foreman1}', [Foreman1Controller::class, 'delete'])->name('foreman1.delete'); 
    });

    Route::group(['prefix' => 'foreman2'], function () {
        Route::get('/', [Foreman2Controller::class, 'index'])->name('foreman2.index');
        Route::post('/store', [Foreman2Controller::class, 'store'])->name('foreman2.store');
        Route::put('/update/{foreman2}', [Foreman2Controller::class, 'update'])->name('foreman2.update'); 
        Route::delete('/delete/{foreman2}', [Foreman2Controller::class, 'delete'])->name('foreman2.delete'); 
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
    });

    Route::group(['prefix' => 'maintain'], function () {
        Route::get('/', [MaintainController::class, 'index'])->name('maintain.index');
        Route::post('/filter', [MaintainController::class, 'filter'])->name('maintain.filter');
    });


});

Route::get('/clear', function() { return session()->flush();});
// Route::get('/test', [TestController::class, 'each']);
// Route::get('/img', [TestController::class, 'img']);

