<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\Foreman1Controller;
use App\Http\Controllers\Api\v1\Foreman2Controller;
use App\Http\Controllers\Api\v1\RkhmaintainController;
use App\Http\Controllers\Api\v1\AreaController;
use App\Models\Maintain\RkhMaintain;
use App\Models\Maintain\RkhManualMaintain;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'foreman1', 'middleware' => 'foreman1'], function () {
        Route::post('update/name', [Foreman1Controller::class, 'update_name_foreman']);
        Route::post('update/email', [Foreman1Controller::class, 'update_email_foreman']);
        Route::post('update/password', [Foreman1Controller::class, 'update_password_foreman']);

        Route::group(['prefix' => 'maintain', 'middleware' => 'foreman1'], function () {
            Route::post('store', [RkhmaintainController::class, 'store']);
            Route::post('close', [RkhmaintainController::class, 'close']);
            Route::get('/foreman2/available', [RkhmaintainController::class, 'foreman2_available']);
        });

    });

    Route::group(['prefix' => 'foreman2', 'middleware' => 'foreman2'], function () {
        Route::post('update/name', [Foreman2Controller::class, 'update_name_foreman']);
        Route::post('update/email', [Foreman2Controller::class, 'update_email_foreman']);
        Route::post('update/password', [Foreman2Controller::class, 'update_password_foreman']);

        Route::group(['prefix' => 'maintain', 'middleware' => 'foreman2'], function () {
            Route::post('/store/harvest-spraying', [RkhmaintainController::class, 'store_harvest_spraying']);
            Route::post('/store/manual', [RkhmaintainController::class, 'store_manual_maintain']);
        });
    });
    
    Route::group(['prefix' => 'area', 'middleware' => 'foreman1'], function () {
        Route::get('farms', [AreaController::class, 'farm']);
        Route::get('farm/{farm_id}/afdellings', [AreaController::class, 'select_afdelling']);
        Route::get('farm/{farm_id}/afdelling/{afdelling_id}/blocks', [AreaController::class, 'select_block']);
    });

});


