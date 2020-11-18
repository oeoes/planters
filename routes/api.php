<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\Foreman1Controller;
use App\Http\Controllers\Api\v1\Foreman2Controller;
use App\Http\Controllers\Api\v1\RkhmaintainController;
use App\Http\Controllers\Api\v1\AreaController;
use App\Http\Controllers\Api\v1\RkhharvestingController;
use App\Models\Harvesting\RkhHarvesting;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'foreman1', 'middleware' => 'foreman1'], function () {
        Route::post('update/name', [Foreman1Controller::class, 'update_name_foreman']);
        Route::post('update/email', [Foreman1Controller::class, 'update_email_foreman']);
        Route::post('update/password', [Foreman1Controller::class, 'update_password_foreman']);

        Route::group(['prefix' => 'maintain'], function () {
            Route::post('store', [RkhmaintainController::class, 'store']);
            Route::post('close', [RkhmaintainController::class, 'close']);
            Route::get('{foreman1_id}/active', [RkhmaintainController::class, 'foreman1_active_rkh']);
            Route::get('{foreman1_id}/inactive', [RkhmaintainController::class, 'foreman1_inactive_rkh']);
            Route::get('foreman2/available', [RkhmaintainController::class, 'foreman2_available']);
        });

        Route::group(['prefix' => 'harvesting'], function () {
            Route::post('store', [RkhharvestingController::class, 'store']);
            Route::post('close', [RkhharvestingController::class, 'close']);
            Route::get('{foreman1_id}/active', [RkhharvestingController::class, 'foreman1_active_rkh']);
            Route::get('{foreman1_id}/inactive', [RkhharvestingController::class, 'foreman1_inactive_rkh']);
            Route::get('foreman2/available', [RkhharvestingController::class, 'foreman2_available']);
        });
    });

    Route::group(['prefix' => 'foreman2', 'middleware' => 'foreman2'], function () {
        Route::post('update/name', [Foreman2Controller::class, 'update_name_foreman']);
        Route::post('update/email', [Foreman2Controller::class, 'update_email_foreman']);
        Route::post('update/password', [Foreman2Controller::class, 'update_password_foreman']);

        Route::group(['prefix' => 'maintain', 'middleware' => 'foreman2'], function () {
            Route::post('store/harvest-spraying', [RkhmaintainController::class, 'store_harvest_spraying']);
            Route::post('store/manual', [RkhmaintainController::class, 'store_manual_maintain']);
            Route::get('{foreman2_id}/active', [RkhmaintainController::class, 'foreman2_active_rkh']);
            Route::get('{foreman2_id}/active/{rkh_maintain_id}/list', [RkhmaintainController::class, 'foreman2_active_rkh_list']);

            // List 
            Route::get('employees', [RkhmaintainController::class, 'employees']);
        });

        Route::group(['prefix' => 'harvesting'], function () {
            Route::post('store/fruit-type', [RkhharvestingController::class, 'store_fruit_type']);
            Route::get('fruits', [RkhharvestingController::class, 'fruit_lists']);
            Route::get('{foreman2_id}/active', [RkhharvestingController::class, 'foreman2_active_rkh']);
        });
    });
    
    Route::group(['prefix' => 'area', 'middleware' => 'foreman1'], function () {
        Route::get('farms', [AreaController::class, 'farm']);
        Route::get('farm/{farm_id}/afdellings', [AreaController::class, 'select_afdelling']);
        Route::get('farm/{farm_id}/afdelling/{afdelling_id}/blocks', [AreaController::class, 'select_block']);
    });

});

Route::get('fm1', [TestController::class, 'fm1']);
Route::get('fm2', [TestController::class, 'fm2']);
Route::get('sql', [TestController::class, 'sql']);

