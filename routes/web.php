<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Reseller\DashboardController as ResellerDashboardController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RouterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/login', [HomeController::class, 'login'])->name('login');

// Language switch routes
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin profile route
    Route::get('/admin/profile', [ProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
});

// Role-based dashboard routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->middleware(['auth', 'permission:dashboard.view'])
        ->name('admin.dashboard');
    
    Route::get('settings', [SettingController::class, 'index'])
        ->middleware(['permission:settings.view'])
        ->name('admin.settings.index');
    
    Route::put('settings', [SettingController::class, 'update'])
        ->middleware(['permission:settings.edit'])
        ->name('admin.settings.update');
    
    Route::resource('customers', CustomerController::class)
        ->middleware(['permission:customers.view'])
        ->names([
            'index' => 'admin.customers.index',
            'create' => 'admin.customers.create',
            'store' => 'admin.customers.store',
            'show' => 'admin.customers.show',
            'edit' => 'admin.customers.edit',
            'update' => 'admin.customers.update',
            'destroy' => 'admin.customers.destroy',
        ]);
    
    Route::resource('packages', PackageController::class)
        ->middleware(['permission:packages.view'])
        ->names([
            'index' => 'admin.packages.index',
            'create' => 'admin.packages.create',
            'store' => 'admin.packages.store',
            'show' => 'admin.packages.show',
            'edit' => 'admin.packages.edit',
            'update' => 'admin.packages.update',
            'destroy' => 'admin.packages.destroy',
        ]);
    
    Route::resource('routers', RouterController::class)
        ->middleware(['permission:routers.view'])
        ->names([
            'index' => 'admin.routers.index',
            'create' => 'admin.routers.create',
            'store' => 'admin.routers.store',
            'show' => 'admin.routers.show',
            'edit' => 'admin.routers.edit',
            'update' => 'admin.routers.update',
            'destroy' => 'admin.routers.destroy',
        ]);

    Route::get('billing/invoices', [InvoiceController::class, 'index'])
        ->middleware(['permission:billing.view'])
        ->name('admin.invoices.index');

    Route::get('billing/invoices/create', [InvoiceController::class, 'create'])
        ->middleware(['permission:billing.create'])
        ->name('admin.invoices.create');

    Route::post('billing/invoices', [InvoiceController::class, 'store'])
        ->middleware(['permission:billing.create'])
        ->name('admin.invoices.store');

    Route::get('billing/payments', [PaymentController::class, 'index'])
        ->middleware(['permission:billing.view'])
        ->name('admin.payments.index');

    Route::post('billing/payments', [PaymentController::class, 'store'])
        ->middleware(['permission:billing.create'])
        ->name('admin.payments.store');
});

// Employee routes
Route::prefix('employee')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [EmployeeDashboardController::class, 'index'])
        ->name('employee.dashboard');
});

// Reseller routes
Route::prefix('reseller')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ResellerDashboardController::class, 'index'])
        ->name('reseller.dashboard');
});

// Client routes
Route::prefix('client')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ClientDashboardController::class, 'index'])
        ->name('client.dashboard');
});

require __DIR__.'/auth.php';
