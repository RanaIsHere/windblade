<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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



Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'view_login'])->name('page_login');
    Route::get('/register', [AuthController::class, 'view_register'])->name('view_register');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register-owner', [UserManagementController::class, 'register_owner'])->name('register');
});

Route::middleware(['auth.basic'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view_dashboard'])->name('page_dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth.basic', 'role:ADMIN,CASHIER'])->group(function () {
    Route::get('/transactions', [DashboardController::class, 'view_transactions'])->name('page_transactions');
    Route::get('/customers', [DashboardController::class, 'view_customers'])->name('page_customers');

    Route::get('/invoices', [DashboardController::class, 'view_invoices'])->name('page_invoices');
    Route::get('/invoices/{invoice_code}', [InvoiceController::class, 'full_invoice'])->name('full_invoice');
    Route::post('/fetch-invoice', [InvoiceController::class, 'fetch_invoice'])->name('fetch_invoice');

    Route::post('/customer', [InputController::class, 'create_customer'])->name('create_customer');
    Route::post('/get-customer', [InputController::class, 'get_customer'])->name('get_customer');

    Route::post('/edit-customer', [InputController::class, 'edit_customer'])->name('edit_customer');
    Route::post('/delete-item', [InputController::class, 'delete_item'])->name('delete_item');

    // Transaction Functions START
    Route::post('/catch-member', [TransactionController::class, 'get_member'])->name('get_member');
    Route::post('/catch-package', [TransactionController::class, 'get_package'])->name('get_package');
    Route::post('/add-package', [TransactionController::class, 'add_package'])->name('add_package');

    Route::post('/calculate-price', [CalculationController::class, 'calculate_price'])->name('calculate_price');

    Route::post('/transaction', [TransactionController::class, 'start_transaction'])->name('start_transaction');

    // Transaction END
});

Route::middleware(['auth.basic', 'role:ADMIN,OWNER'])->group(function () {
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::post('/sendRequestMessage', [ReportsController::class, 'sendRequestMessage']);
});

Route::middleware(['auth.basic', 'role:ADMIN'])->group(function () {
    Route::get('/users', [DashboardController::class, 'view_users'])->name('view_users');
    Route::get('/outlets', [DashboardController::class, 'view_outlets'])->name('page_outlets');
    Route::get('/packages', [DashboardController::class, 'view_packages'])->name('page_packages');

    Route::post('/package', [InputController::class, 'create_package'])->name('create_package');
    Route::post('/outlet', [InputController::class, 'create_outlet'])->name('create_outlet');

    Route::post('/get-user', [UserManagementController::class, 'get_user'])->name('get_user');
    Route::post('/get-package', [InputController::class, 'get_package'])->name('get_package');
    Route::post('/get-outlet', [InputController::class, 'get_outlet'])->name('get_outlet');

    Route::post('/edit-user', [UserManagementController::class, 'edit_user'])->name('edit_user');
    Route::post('/edit-package', [InputController::class, 'edit_package'])->name('edit_package');
    Route::post('/edit-outlet', [InputController::class, 'edit_outlet'])->name('edit_outlet');

    Route::post('/register-user', [UserManagementController::class, 'register_user'])->name('register_user');

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::post('/inventory', [InventoryController::class, 'create'])->name('add_inventory');
    Route::post('/fetch-inventory', [InventoryController::class, 'fetch'])->name('fetch_inventory');
    Route::post('/update-inventory', [InventoryController::class, 'update'])->name('update_inventory');
    Route::post('/delete-inventory', [InventoryController::class, 'delete'])->name('delete_inventory');
});
