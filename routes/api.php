<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\v1\ForemanController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

Route::group(['prefix' => 'v1', 'middleware' => ['jwt.auth']], function () {
    Route::group(['prefix' => 'foreman1'], function () {
        Route::post('update/name', [ForemanController::class, 'update_name_foreman1']);
        Route::post('update/email', [ForemanController::class, 'update_email_foreman1']);
        Route::post('update/passwor', [ForemanController::class, 'update_password_foreman1']);
    });
});


