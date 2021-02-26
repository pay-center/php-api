<?php

use App\Http\Controllers\Index\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('auth/login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // 管理用户模块
    Route::prefix('user')->group(function () {
        Route::get('info', [UserController::class, 'info']);
        Route::get('logout', [UserController::class, 'logout']);
    });

    // 权限模块
    Route::prefix('admin')->group(function () {
        Route::apiResource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::apiResource('role', \App\Http\Controllers\Admin\RoleController::class);
        Route::apiResource('power', \App\Http\Controllers\Admin\PowerController::class);
    });

    // 订单模块
    Route::prefix('pay')->group(function () {
        Route::apiResource('order', \App\Http\Controllers\Pay\OrderController::class);
    });
});

