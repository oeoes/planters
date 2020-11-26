<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\AfdellingController;


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'foreman', 'middleware' => ['foreman']], function () {
        Route::post('create-afdelling-ref', [AfdellingController::class, 'create_afdelling_ref']);
    });

});

Route::get('fm1', [TestController::class, 'fm1']);
Route::get('fm2', [TestController::class, 'fm2']);
Route::get('sql', [TestController::class, 'sql']);
Route::get('arr', [TestController::class, 'arr']);

