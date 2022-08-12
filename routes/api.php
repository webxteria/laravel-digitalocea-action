<?php

namespace App\Http\Controllers;

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

Route::post('/auth/signup', [AuthController::class, 'register'])->name('user.register');
Route::post('/auth/signin', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/auth/refresh-token', [AuthController::class, 'refresh'])->name('auth.refresh');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('companies', CompanyController::class);
    Route::get('archived-channels', [ChannelsController::class, 'archived']);
    Route::apiResource('channels', ChannelsController::class);
    Route::apiResource('groups', GroupsController::class);
    Route::apiResource('users', UserController::class);
});
