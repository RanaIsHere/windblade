<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\UserManagementController;
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

Route::get('/', [AuthController::class, 'view_login'])->name('page_login');
Route::get('/register', [AuthController::class, 'view_register'])->name('view_register');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register-owner', [UserManagementController::class, 'register_owner'])->name('register');

Route::middleware(['auth.basic', 'role:ADMIN'])->group(function () {
    Route::get('/users', [DashboardController::class, 'view_users'])->name('view_users');
    Route::get('/outlets', [DashboardController::class, 'view_outlets'])->name('page_outlets');
    Route::get('/customers', [DashboardController::class, 'view_customers'])->name('page_customers');
    Route::get('/packages', [DashboardController::class, 'view_packages'])->name('page_packages');
    Route::get('/transactions', [DashboardController::class, 'view_transactions'])->name('page_transactions');

    Route::post('/package', [InputController::class, 'create_package'])->name('create_package');
    Route::post('/outlet', [InputController::class, 'create_outlet'])->name('create_outlet');
    Route::post('/customer', [InputController::class, 'create_customer'])->name('create_customer');

    Route::post('/get-user', [UserManagementController::class, 'get_user'])->name('get_user');
    Route::post('/get-package', [InputController::class, 'get_package'])->name('get_package');
    Route::post('/get-outlet', [InputController::class, 'get_outlet'])->name('get_outlet');
    Route::post('/get-customer', [InputController::class, 'get_customer'])->name('get_customer');

    // Transaction Functions START
    Route::post('/catch-member', [TransactionController::class, 'get_member'])->name('get_member');
    Route::post('/catch-package', [TransactionController::class, 'get_package'])->name('get_package');

    Route::post('/transaction', [TransactionController::class, 'start_transaction'])->name('start_transaction');

    // Transaction END

    Route::post('/delete-item', [InputController::class, 'delete_item'])->name('delete_item');
    Route::post('/edit-user', [UserManagementController::class, 'edit_user'])->name('edit_user');
    Route::post('/edit-package', [InputController::class, 'edit_package'])->name('edit_package');
    Route::post('/edit-outlet', [InputController::class, 'edit_outlet'])->name('edit_outlet');
    Route::post('/edit-customer', [InputController::class, 'edit_customer'])->name('edit_customer');

    Route::post('/register-user', [UserManagementController::class, 'register_user'])->name('register_user');
});

Route::middleware(['auth.basic'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view_dashboard'])->name('page_dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
