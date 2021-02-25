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
    // admin user
    Route::prefix('user')->group(function () {
        Route::get('info', [UserController::class, 'info']);
        Route::get('logout', [UserController::class, 'logout']);
    });
});

