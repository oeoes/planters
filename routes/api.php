<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\AuthUserController;


    Route::post('login', [AuthUserController::class, 'login']);

    Route::group(['middleware' => 'jwt.auth'], function() {

        Route::post('logout', [AuthUserController::class, 'logout']);
        Route::post('refresh', [AuthUserController::class, 'refresh']);
        Route::post('me', [AuthUserController::class, 'me']);
        Route::post('test', [AuthUserController::class, 'test']);

    });
