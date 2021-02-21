<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransactionController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('transactions', [TransactionController::class,'index'])->name('api.transactions');
    Route::get('customers', [CustomerController::class,'index'])->name('api.customers');
    Route::get('user', [AuthController::class,'user'])->name('api.user');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
