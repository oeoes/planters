<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\AfdellingController;
use App\Http\Controllers\Api\v1\BlockController;
use App\Http\Controllers\Api\v1\DwpmaintainController;
use App\Models\Block;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'foreman', 'middleware' => ['foreman']], function () {
        Route::post('store-afdelling-ref', [AfdellingController::class, 'store_afdelling_ref']);
        Route::get('sub-foreman/{jobtype}/afdelling/{afdelling_id}', [DwpmaintainController::class, 'active_subforeman']);
        
        Route::post('store-spraying',  [DwpmaintainController::class, 'store_spraying']);
        Route::post('store-fertilizer',[DwpmaintainController::class, 'store_fertilizer']);
        Route::post('store-pcontrol',  [DwpmaintainController::class, 'store_pcontrol']);
        Route::post('store-mcircle',   [DwpmaintainController::class, 'store_mcircle']);
        Route::post('store-mpruning',  [DwpmaintainController::class, 'store_mpruning']);
        Route::post('store-mgawangan', [DwpmaintainController::class, 'store_mgawangan']);
        Route::post('store-block-references', [BlockController::class, 'store_block_references']);
        // Route::get(())

        Route::get('blocks', [BlockController::class, 'blocks']);
    });

    Route::group(['prefix' => 'subforeman'], function () {
        Route::post('fill-spraying',   [DwpmaintainController::class, 'fill_spraying']);
        Route::post('fill-fertilizer', [DwpmaintainController::class, 'fill_fertilizer']);
        Route::post('fill-pcontrol',   [DwpmaintainController::class, 'fill_pcontrol']);
        Route::post('fill-circle',     [DwpmaintainController::class, 'fill_circle']);
        Route::post('fill-pruning',    [DwpmaintainController::class, 'fill_pruning']);
        Route::post('fill-gawangan',   [DwpmaintainController::class, 'fill_gawangan']);
    });

});

Route::get('fm', [TestController::class, 'fm']);
Route::get('sfm', [TestController::class, 'sfm']);
Route::get('sql', [TestController::class, 'sql']);
Route::get('arr', [TestController::class, 'arr']);

