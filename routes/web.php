<?php

use Illuminate\Support\Facades\Route;

// ASSISTANT
use App\Http\Controllers\DashboardController as AS_DashboardController;



use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;

// SUPERADMIN
use App\Http\Controllers\superadmin\DashboardController  as SU_DashboardController;
use App\Http\Controllers\superadmin\AreaController  as SU_AreaController;
use App\Http\Controllers\superadmin\MaintainController as SU_MaintainController;
use App\Http\Controllers\superadmin\HarvestingController as SU_HarvestingController;
use App\Http\Controllers\superadmin\ForemanController as SU_ForemanController;
use App\Http\Controllers\superadmin\SubforemanController as SU_SubforemanController;

// FARMMANAGER


Route::get('/test', function() {return view('root.app'); });

Route::get('/', function() {
    return redirect('/login');
});
Route::get('/login',  [AuthController::class, 'loginform'])->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])
     ->middleware('auth:assistant,farmmanager,superadmin')->name('logout');

/** Super Admin
 * Start
 */
Route::group(['prefix' => 'superadmin', 'middleware' => ['auth:superadmin']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [SU_DashboardController::class, 'index'])->name('superadmin.dashboard');    
    });

    Route::group(['prefix' => 'area'], function () {
        Route::group(['prefix' => 'job_type'], function () {
            Route::get('/', [SU_AreaController::class, 'job_type'])->name('superadmin.job_type');
            Route::post('/', [SU_AreaController::class, 'job_type_store'])->name('superadmin.job_type.store');
            Route::put('/{job_type}', [SU_AreaController::class, 'job_type_update'])->name('superadmin.job_type.update');
            Route::delete('/{job_type}', [SU_AreaController::class, 'job_type_delete'])->name('superadmin.job_type.delete');
        });

        Route::group(['prefix' => 'farm'], function () {
            Route::get('/', [SU_AreaController::class, 'farm'])->name('superadmin.farm');
            Route::post('/', [SU_AreaController::class, 'farm_store'])->name('superadmin.farm.store');
            Route::put('/{farm}', [SU_AreaController::class, 'farm_update'])->name('superadmin.farm.update');
            Route::delete('/{farm}', [SU_AreaController::class, 'farm_delete'])->name('superadmin.farm.delete');
        });

        Route::group(['prefix' => 'afdelling'], function () {
            Route::get('/', [SU_AreaController::class, 'afdelling'])->name('superadmin.afdelling');
            Route::post('/', [SU_AreaController::class, 'afdelling_store'])->name('superadmin.afdelling.store');
            Route::post('/getafdelling', [SU_AreaController::class, 'getAfdelling']);
            Route::put('/{afdelling}', [SU_AreaController::class, 'afdelling_update'])->name('superadmin.afdelling.update');
            Route::delete('/{afdelling}', [SU_AreaController::class, 'afdelling_delete'])->name('superadmin.afdelling.delete');
        });

        Route::group(['prefix' => 'block'], function () {
            Route::get('/', [SU_AreaController::class, 'block'])->name('superadmin.block');
            Route::post('/', [SU_AreaController::class, 'block_store'])->name('superadmin.block.store');
            Route::post('/getblock', [SU_AreaController::class, 'getBlock']);
            Route::put('/{block}', [SU_AreaController::class, 'block_update'])->name('superadmin.block.update');
            Route::delete('/{block}', [SU_AreaController::class, 'block_delete'])->name('superadmin.block.delete');
        });

        Route::group(['prefix' => 'block_reference'], function () {
            Route::get('/', [SU_AreaController::class, 'block_reference'])->name('superadmin.block_reference');
            Route::post('/', [SU_AreaController::class, 'block_reference_store'])->name('superadmin.block_reference.store');
            Route::put('/{block_reference}', [SU_AreaController::class, 'block_reference_update'])->name('superadmin.block_reference.update');
            Route::delete('/{block_reference}', [SU_AreaController::class, 'block_reference_delete'])->name('superadmin.block_reference.delete');
        });
    });

    Route::group(['prefix' => 'subforeman'], function () {
        Route::get('/', [SU_SubforemanController::class, 'index'])->name('superadmin.subforeman.index');
        Route::post('/store', [SU_SubforemanController::class, 'store'])->name('superadmin.subforeman.store');
        Route::put('/update/{subforeman}', [SU_SubforemanController::class, 'update'])->name('superadmin.subforeman.update'); 
        Route::delete('/delete/{subforeman}', [SU_SubforemanController::class, 'delete'])->name('superadmin.subforeman.delete'); 
    });

    Route::group(['prefix' => 'foreman'], function () {
        route::get('/', [SU_ForemanController::class, 'index'])->name('superadmin.foreman.index');
        Route::post('/store', [SU_ForemanController::class, 'store'])->name('superadmin.foreman.store'); 
        Route::put('/update/{foreman}', [SU_ForemanController::class, 'update'])->name('superadmin.foreman.update'); 
        Route::delete('/delete/{foreman}', [SU_ForemanController::class, 'delete'])->name('superadmin.foreman.delete'); 
    });

    Route::group(['prefix' => 'manager'], function () {
        Route::get('/', [ManagerController::class, 'super']);
    });

    Route::group(['prefix' => 'assistant'], function () {
        
    });

    Route::group(['prefix' => 'maintain'], function () {
        Route::get('/spraying', [SU_MaintainController::class, 'spraying'])->name('superadmin.maintain.spraying');
        Route::get('/fertilizer', [SU_MaintainController::class, 'fertilizer'])->name('superadmin.maintain.fertilizer');
        Route::get('/circle', [SU_MaintainController::class, 'circle'])->name('superadmin.maintain.circle');
        Route::get('/pruning', [SU_MaintainController::class, 'pruning'])->name('superadmin.maintain.pruning');
        Route::get('/gawangan', [SU_MaintainController::class, 'gawangan'])->name('superadmin.maintain.gawangan');
        Route::get('/pestcontrol', [SU_MaintainController::class, 'pestcontrol'])->name('superadmin.maintain.pestcontrol'); 
    });

    Route::group(['prefix' => 'harvesting'], function () {
        Route::get('/', [SU_HarvestingController::class, 'index'])->name('superadmin.harvesting.index');
    });

});

/** Super Admin
 * End
 */


/** Farm Manager
 * Start
 */

Route::group(['prefix' => 'manager', 'middleware' => ['auth:farmmanager']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [FM_DashboardController::class, 'index'])->name('manager.dashboard');    
    });
});

/** Farm Manager
 * End
 */

 /** Assistant Start
 * End
 */

Route::group(['prefix' => 'assistant', 'middleware' => ['auth:assistant']], function () {

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [AS_DashboardController::class, 'index'])->name('assistant.dashboard');    
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

    Route::group(['prefix' => 'maintain'], function () {
        Route::get('/spraying', [MaintainController::class, 'spraying'])->name('assistant.maintain.spraying');
        Route::get('/fertilizer', [MaintainController::class, 'fertilizer'])->name('assistant.maintain.fertilizer');
        Route::get('/circle', [MaintainController::class, 'circle'])->name('assistant.maintain.circle');
        Route::get('/pruning', [MaintainController::class, 'pruning'])->name('assistant.maintain.pruning');
        Route::get('/gawangan', [MaintainController::class, 'gawangan'])->name('assistant.maintain.gawangan');
        Route::get('/pestcontrol', [MaintainController::class, 'pestcontrol'])->name('assistant.maintain.pestcontrol');
    });

});

/** Assistant
 * End
 */

Route::get('/clear', function() { return session()->flush();});
// Route::get('/test', [TestController::class, 'each']);
// Route::get('/img', [TestController::class, 'img']);

