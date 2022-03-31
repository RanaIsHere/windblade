<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUsageController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SimulatedTransactionController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WashController;
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

    Route::get('/profile', [ProfileController::class, 'index'])->name('view_profile');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('update_profile');

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

    // Simulation OF Transaction
    Route::get('/transaction-simulation', [SimulatedTransactionController::class, 'index'])->name('view_simulated_transaction');

    Route::get('/wash-transaction', [WashController::class, 'index'])->name('view_wash_transaction');

    Route::get('/data-usage', [DataUsageController::class, 'index'])->name('view_data_usage');
    Route::post('/data-usage/create', [DataUsageController::class, 'store'])->name('create_data_usage');

    Route::post('/data-usage/fetch-edit', [DataUsageController::class, 'edit'])->name('fetch_edit_data_usage');
    Route::post('/data-usage/update', [DataUsageController::class, 'update'])->name('update_data_usage');
    Route::post('/data-usage/status', [DataUsageController::class, 'status'])->name('update_data_usage_status');

    Route::post('/data-usage/fetch-delete', [DataUsageController::class, 'delete'])->name('fetch_delete_data_usage');
    Route::post('/data-usage/delete', [DataUsageController::class, 'destroy'])->name('delete_data_usage');

    Route::get('/data-usage/export', [DataUsageController::class, 'export'])->name('export_data_usage');
    Route::post('/data-usage/import', [DataUsageController::class, 'import'])->name('import_data_usage');
});

Route::middleware(['auth.basic', 'role:OWNER'])->group(function () {
    Route::get('/salary', [SalaryController::class, 'index'])->name('salary');

    Route::get('/reports/export', [ExportController::class, 'exportReports'])->name('export_reports');
    Route::post('/reportSchedule', [ReportsController::class, 'report_schedule'])->name('reportSchedule');
    Route::post('/reports/getSumFromMonths', [ReportsController::class, 'report_monthly'])->name('reportMonthly');
});

Route::middleware(['auth.basic', 'role:ADMIN,OWNER'])->group(function () {
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::post('/sendRequestMessage', [ReportsController::class, 'sendRequestMessage']);
});

Route::middleware(['auth.basic', 'role:ADMIN'])->group(function () {
    Route::get('/users', [DashboardController::class, 'view_users'])->name('view_users');
    Route::get('/outlets', [DashboardController::class, 'view_outlets'])->name('page_outlets');
    Route::get('/packages', [DashboardController::class, 'view_packages'])->name('page_packages');
    Route::get('/simulation', [SimulationController::class, 'index'])->name('view_simulation');

    Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery');
    Route::post('/delivery/create', [DeliveryController::class, 'store'])->name('store_delivery');
    Route::post('/delivery/fetch_edit', [DeliveryController::class, 'edit'])->name('edit_delivery');
    Route::post('/delivery/edit', [DeliveryController::class, 'update'])->name('update_delivery');
    Route::post('/delivery/status', [DeliveryController::class, 'updateStatus'])->name('update_status');
    Route::post('/delivery/delete', [DeliveryController::class, 'delete'])->name('delete_delivery');

    Route::get('/delivery/export', [DeliveryController::class, 'exportData'])->name('export_delivery');
    Route::post('/delivery/import', [DeliveryController::class, 'importData'])->name('import_delivery');

    Route::get('/items', [ItemController::class, 'index'])->name('items');
    Route::post('/items/create', [ItemController::class, 'store'])->name('create_item');
    Route::post('/items/edit', [ItemController::class, 'edit'])->name('edit_item');
    Route::post('/items/update', [ItemController::class, 'update'])->name('update_item');
    Route::post('/items/update-status', [ItemController::class, 'status'])->name('update_status_item');
    Route::post('/items/delete', [ItemController::class, 'delete'])->name('delete_item');
    Route::post('/items/destroy', [ItemController::class, 'destroy'])->name('destroy_item');

    Route::get('/items/export', [ItemController::class, 'export'])->name('export_item');
    Route::post('/items/import', [ItemController::class, 'import'])->name('import_item');

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

    Route::get('/packages/export', [ExportController::class, 'exportPackages'])->name('export_packages');

    Route::get('/customers/export', [ExportController::class, 'exportMembers'])->name('export_members');

    Route::post('/customers/import', [ImportController::class, 'importMembers'])->name('import_members');
    Route::post('/packages/import', [ImportController::class, 'importPackages'])->name('import_packages');
});
