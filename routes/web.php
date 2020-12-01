<?php

use App\Http\Controllers\ForemanController;
use App\Http\Controllers\SubforemanController;
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
        Route::group(['prefix' => 'job_type'], function () {
            Route::get('/', [AreaController::class, 'job_type'])->name('job_type');
            Route::post('/', [AreaController::class, 'job_type_store'])->name('job_type.store');
            Route::put('/{job_type}', [AreaController::class, 'job_type_update'])->name('job_type.update');
            Route::delete('/{job_type}', [AreaController::class, 'job_type_delete'])->name('job_type.delete');
        });

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

        Route::group(['prefix' => 'block_reference'], function () {
            Route::get('/', [AreaController::class, 'block_reference'])->name('block_reference');
            Route::post('/', [AreaController::class, 'block_reference_store'])->name('block_reference.store');
            Route::put('/{block_reference}', [AreaController::class, 'block_reference_update'])->name('block_reference.update');
            Route::delete('/{block_reference}', [AreaController::class, 'block_reference_delete'])->name('block_reference.delete');
        });
    });

    Route::group(['prefix' => 'subforeman'], function () {
        Route::get('/', [SubforemanController::class, 'index'])->name('subforeman.index');
        Route::post('/store', [SubforemanController::class, 'store'])->name('subforeman.store');
        Route::put('/update/{subforeman}', [SubforemanController::class, 'update'])->name('subforeman.update'); 
        Route::delete('/delete/{subforeman}', [SubforemanController::class, 'delete'])->name('subforeman.delete'); 
    });

    Route::group(['prefix' => 'foreman'], function () {
        route::get('/', [ForemanController::class, 'index'])->name('foreman.index');
        Route::post('/store', [ForemanController::class, 'store'])->name('foreman.store'); 
        Route::put('/update/{foreman}', [ForemanController::class, 'update'])->name('foreman.update'); 
        Route::delete('/delete/{foreman}', [ForemanController::class, 'delete'])->name('foreman.delete'); 
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

