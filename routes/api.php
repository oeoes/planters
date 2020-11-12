<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\Foreman1Controller;
use App\Http\Controllers\Api\v1\Foreman2Controller;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'foreman1', 'middleware' => 'foreman1'], function () {
        Route::post('update/name', [Foreman1Controller::class, 'update_name_foreman']);
        Route::post('update/email', [Foreman1Controller::class, 'update_email_foreman']);
        Route::post('update/password', [Foreman1Controller::class, 'update_password_foreman']);
    });

    Route::group(['prefix' => 'foreman2'], function () {
        Route::post('update/name', [Foreman2Controller::class, 'update_name_foreman']);
        Route::post('update/email', [Foreman2Controller::class, 'update_email_foreman']);
        Route::post('update/password', [Foreman2Controller::class, 'update_password_foreman']);
    });

});


