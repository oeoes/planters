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

// SUPERADMIN
use App\Http\Controllers\superadmin\DashboardController as SA_DashboardController;

// FARMMANAGER
use App\Http\Controllers\manager\DashboardController as FM_DashboardController;

Route::get('/test', function() {return view('root.app'); });

Route::get('/', function() {
    return redirect('/login');
});
Route::get('/login',  [AuthController::class, 'loginform'])->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:assistant,farmmanager,superadmin')->name('logout');

Route::group(['prefix' => 'superadmin'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [SA_DashboardController::class, 'index'])->name('superadmin.dashboard');    
    });
});

Route::group(['prefix' => 'manager'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [FM_DashboardController::class, 'index'])->name('manager.dashboard');    
    });
});

Route::group(['prefix' => 'assistant', 'middleware' => ['auth:assistant']], function () {

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('assistant.dashboard');    
    });

    Route::group(['prefix' => 'area'], function () {
        Route::group(['prefix' => 'job_type'], function () {
            Route::get('/', [AreaController::class, 'job_type'])->name('assistant.job_type');
            Route::post('/', [AreaController::class, 'job_type_store'])->name('assistant.job_type.store');
            Route::put('/{job_type}', [AreaController::class, 'job_type_update'])->name('assistant.job_type.update');
            Route::delete('/{job_type}', [AreaController::class, 'job_type_delete'])->name('assistant.job_type.delete');
        });

        Route::group(['prefix' => 'farm'], function () {
            Route::get('/', [AreaController::class, 'farm'])->name('assistant.farm');
            Route::post('/', [AreaController::class, 'farm_store'])->name('assistant.farm.store');
            Route::put('/{farm}', [AreaController::class, 'farm_update'])->name('assistant.farm.update');
            Route::delete('/{farm}', [AreaController::class, 'farm_delete'])->name('assistant.farm.delete');
        });
        Route::group(['prefix' => 'afdelling'], function () {
            Route::get('/', [AreaController::class, 'afdelling'])->name('assistant.afdelling');
            Route::post('/', [AreaController::class, 'afdelling_store'])->name('assistant.afdelling.store');
            Route::post('/getafdelling', [AreaController::class, 'getAfdelling']);
            Route::put('/{afdelling}', [AreaController::class, 'afdelling_update'])->name('assistant.afdelling.update');
            Route::delete('/{afdelling}', [AreaController::class, 'afdelling_delete'])->name('assistant.afdelling.delete');
        });
        Route::group(['prefix' => 'block'], function () {
            Route::get('/', [AreaController::class, 'block'])->name('assistant.block');
            Route::post('/', [AreaController::class, 'block_store'])->name('assistant.block.store');
            Route::post('/getblock', [AreaController::class, 'getBlock']);
            Route::put('/{block}', [AreaController::class, 'block_update'])->name('assistant.block.update');
            Route::delete('/{block}', [AreaController::class, 'block_delete'])->name('assistant.block.delete');
        });

        Route::group(['prefix' => 'block_reference'], function () {
            Route::get('/', [AreaController::class, 'block_reference'])->name('assistant.block_reference');
            Route::post('/', [AreaController::class, 'block_reference_store'])->name('assistant.block_reference.store');
            Route::put('/{block_reference}', [AreaController::class, 'block_reference_update'])->name('assistant.block_reference.update');
            Route::delete('/{block_reference}', [AreaController::class, 'block_reference_delete'])->name('assistant.block_reference.delete');
        });
    });

    Route::group(['prefix' => 'subforeman'], function () {
        Route::get('/', [SubforemanController::class, 'index'])->name('assistant.subforeman.index');
        Route::post('/store', [SubforemanController::class, 'store'])->name('assistant.subforeman.store');
        Route::put('/update/{subforeman}', [SubforemanController::class, 'update'])->name('assistant.subforeman.update'); 
        Route::delete('/delete/{subforeman}', [SubforemanController::class, 'delete'])->name('assistant.subforeman.delete'); 
    });

    Route::group(['prefix' => 'foreman'], function () {
        route::get('/', [ForemanController::class, 'index'])->name('assistant.foreman.index');
        Route::post('/store', [ForemanController::class, 'store'])->name('assistant.foreman.store'); 
        Route::put('/update/{foreman}', [ForemanController::class, 'update'])->name('assistant.foreman.update'); 
        Route::delete('/delete/{foreman}', [ForemanController::class, 'delete'])->name('assistant.foreman.delete'); 
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('assistant.employee.index');
    });

    Route::group(['prefix' => 'maintain'], function () {
        Route::get('/', [MaintainController::class, 'index'])->name('assistant.maintain.index');
        Route::post('/filter', [MaintainController::class, 'filter'])->name('assistant.maintain.filter');

        Route::get('/spraying', [MaintainController::class, 'spraying'])->name('assistant.maintain.spraying');
        Route::get('/fertilizer', [MaintainController::class, 'fertilizer'])->name('assistant.maintain.fertilizer');
        Route::get('/circle', [MaintainController::class, 'circle'])->name('assistant.maintain.circle');
        Route::get('/pruning', [MaintainController::class, 'pruning'])->name('assistant.maintain.pruning');
        Route::get('/gawangan', [MaintainController::class, 'gawangan'])->name('assistant.maintain.gawangan');
        Route::get('/pestcontrol', [MaintainController::class, 'pestcontrol'])->name('assistant.maintain.pestcontrol');

    });

});

Route::get('/clear', function() { return session()->flush();});
// Route::get('/test', [TestController::class, 'each']);
// Route::get('/img', [TestController::class, 'img']);

