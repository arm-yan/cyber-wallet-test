<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AccountController::class, 'index']);
    Route::get('/{id}', [AccountController::class, 'show']);
    Route::get('/{id}/payments', [AccountController::class, 'showPayments']);
    Route::post('/', [AccountController::class, 'store']);
    Route::post('/{id}', [AccountController::class, 'update']);
    Route::post('/{id}/coinbase', [AccountController::class, 'createCoinbasePayment']);
    Route::delete('/{id}', [AccountController::class, 'delete']);
});
