<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\AfdellingController;
use App\Http\Controllers\Api\v1\BlockController;
use App\Http\Controllers\Api\v1\DwpmaintainController;
use App\Http\Controllers\Api\v1\DwpharvestingController;
use App\Http\Controllers\Api\v1\GradingHarvestingController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'foreman', 'middleware' => 'foreman' ], function () {
        Route::post('store-afdelling-ref', [AfdellingController::class, 'store_afdelling_ref']);
        Route::get('sub-foreman/{jobtype}/afdelling/{afdelling_id}', [DwpmaintainController::class, 'active_subforeman']);
        
        Route::post('store-spraying',  [DwpmaintainController::class, 'store_spraying']);
        Route::post('store-fertilizer',[DwpmaintainController::class, 'store_fertilizer']);
        Route::post('store-pcontrol',  [DwpmaintainController::class, 'store_pcontrol']);
        Route::post('store-mcircle',   [DwpmaintainController::class, 'store_mcircle']);
        Route::post('store-mpruning',  [DwpmaintainController::class, 'store_mpruning']);
        Route::post('store-mgawangan', [DwpmaintainController::class, 'store_mgawangan']);

        Route::post('store-harvest', [DwpharvestingController::class, 'store_harvest']);

        Route::get('blocks/{afdelling_id}', [BlockController::class, 'blocks']);
        Route::post('store-block-references', [BlockController::class, 'store_block_references']);
        Route::get('completed-block-references', [BlockController::class, 'completed_block_references']);
        Route::get('active-block-references', [BlockController::class, 'active_block_references']);

        Route::get('det-active-block-references/{block_ref_id}', [BlockController::class, 'det_active_block_references']);

        Route::get('years', [DwpmaintainController::class, 'years']);
        Route::get('year/{year}/blocks', [DwpmaintainController::class, 'block']);
        Route::get('year/{year}/blocks/{block_id}', [DwpmaintainController::class, 'dates']);
        Route::get('detail-rkh-completed/{block_ref_id}/{date}', [DwpmaintainController::class, 'detail_rkh_completed']);

        Route::get('set-complete-rkh/{block_ref_id}', [DwpmaintainController::class, 'set_complete_rkh']);

        // Grading harvesting
        Route::group(['prefix' => 'grading-harvesting'], function () {
            Route::get('samples/{afdelling_id}', [GradingHarvestingController::class, 'list_samples']);
            Route::get('sample/detail/{block_reference_id}', [GradingHarvestingController::class, 'detail_sample']);
            Route::post('store', [GradingHarvestingController::class, 'store_grading_harvesting']);
            Route::get('list', [GradingHarvestingController::class, 'list_grading_harvesting']);
        });
    
    });

    Route::group(['prefix' => 'subforeman', 'middleware' => 'subforeman' ], function () {
        Route::post('fill-spraying',   [DwpmaintainController::class, 'fill_spraying']);
        Route::post('fill-fertilizer', [DwpmaintainController::class, 'fill_fertilizer']);
        Route::post('fill-pcontrol',   [DwpmaintainController::class, 'fill_pcontrol']);
        Route::post('fill-circle',     [DwpmaintainController::class, 'fill_circle']);
        Route::post('fill-pruning',    [DwpmaintainController::class, 'fill_pruning']);
        Route::post('fill-gawangan',   [DwpmaintainController::class, 'fill_gawangan']);

        Route::post('fill-harvesting', [DwpharvestingController::class, 'fill_harvesting']);

        Route::get('today-job/{subforeman_id}', [DwpmaintainController::class, 'check_job_today']);
    });

});


route::get('allsfm', [TestController::class, 'allsfm']);
route::get('allfm', [TestController::class, 'allfm']);

