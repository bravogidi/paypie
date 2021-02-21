<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
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

// Auth

Route::get('login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [LoginController::class, 'login'])
    ->name('login.attempt')
    ->middleware('guest');

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('remember', 'auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])->where('path', '.*');

// Customers
Route::get('customers', [CustomerController::class, 'index'])
    ->name('customers')
    ->middleware( 'auth');

Route::get('customers/create', [CustomerController::class, 'create'])
    ->name('customers.create')
    ->middleware('auth');

Route::post('customers', [CustomerController::class, 'store'])
    ->name('customers.store')
    ->middleware('auth');

Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])
    ->name('customers.edit')
    ->middleware('auth');

Route::put('customers/{customer}', [CustomerController::class, 'update'])
    ->name('customers.update')
    ->middleware('auth');

Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])
    ->name('customers.destroy')
    ->middleware('auth');

Route::put('customers/{customer}/restore', [CustomerController::class, 'restore'])
    ->name('customers.restore')
    ->middleware('auth');

// Transactions
Route::get('transactions', [TransactionController::class, 'index'])
    ->name('transactions')
    ->middleware( 'auth');

Route::get('transactions/create', [TransactionController::class, 'create'])
    ->name('transactions.create')
    ->middleware('auth');

Route::post('transactions', [TransactionController::class, 'store'])
    ->name('transactions.store')
    ->middleware('auth');

Route::get('transactions/{transaction}/edit', [TransactionController::class, 'edit'])
    ->name('transactions.edit')
    ->middleware('auth');

Route::put('transactions/{transaction}', [TransactionController::class, 'update'])
    ->name('transactions.update')
    ->middleware('auth');

Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy'])
    ->name('transactions.destroy')
    ->middleware('auth');

Route::put('transactions/{transaction}/restore', [TransactionController::class, 'restore'])
    ->name('transactions.restore')
    ->middleware('auth');

// 500 error

Route::get('500', function () {
    // Force debug mode for this endpoint in the demo environment
    if (App::environment('demo')) {
        Config::set('app.debug', true);
    }

    echo $fail;
});
