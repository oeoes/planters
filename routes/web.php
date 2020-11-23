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
        });
        Route::group(['prefix' => 'afdelling'], function () {
            Route::get('/', [AreaController::class, 'afdelling'])->name('afdelling');
            Route::post('/', [AreaController::class, 'afdelling_store'])->name('afdelling.store');
            Route::post('/getafdelling', [AreaController::class, 'getAfdelling']);
        });
        Route::group(['prefix' => 'block'], function () {
            Route::get('/', [AreaController::class, 'block'])->name('block');
            Route::post('/', [AreaController::class, 'block_store'])->name('block.store');
            Route::post('/getblock', [AreaController::class, 'getBlock']);
        });
    });

    Route::group(['prefix' => 'foreman1'], function () {
        route::get('/', [Foreman1Controller::class, 'index'])->name('foreman1.index');
        Route::post('/store', [Foreman1Controller::class, 'store'])->name('foreman1.store'); 
    });

    Route::group(['prefix' => 'foreman2'], function () {
        Route::get('/', [Foreman2Controller::class, 'index'])->name('foreman2.index');
        Route::post('/store', [Foreman2Controller::class, 'store'])->name('foreman2.store');
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
    });

    Route::group(['prefix' => 'maintain'], function () {
        Route::get('/', [MaintainController::class, 'index'])->name('maintain.index');
        Route::post('/filter', [MaintainController::class, 'filter'])->name('maintain.filter');
    });

    Route::group(['prefix' => 'harvesting'], function () {
        Route::get('/', [HarvestingController::class, 'index'])->name('harvesting.index');
        Route::get('/filter', [HarvestingController::class, 'filter_form'])->name('harvesting.filter');
        Route::post('/filter', [HarvestingController::class, 'filter_process'])->name('harvesting.filter.process');
    });

});

Route::get('/clear', function() { return session()->flush();});
// Route::get('/test', [TestController::class, 'each']);
// Route::get('/img', [TestController::class, 'img']);

