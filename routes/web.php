<?php

use App\Http\Controllers\Admin\AdminAuditLogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWalletController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ExpensesController;
use App\Http\Controllers\User\WalletManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::view('/', 'welcome')->name('welcome');

/*User*/
Route::middleware(['auth', 'is_user', 'verified'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('wallets', WalletManagementController::class)->name('wallets');
    Route::get('expenses', ExpensesController::class)->name('expenses');
    Route::get('categories', CategoriesController::class)->name('categories');
});
/*Admin*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function (){
   Route::get('dashboard', AdminDashboardController::class)->name('admin.dashboard');
   Route::get('users', AdminUserController::class)->name('admin.users');
   Route::get('wallets', AdminWalletController::class)->name('admin.wallets');
   Route::get('categories', AdminCategoryController::class)->name('admin.categories');
   Route::get('audit-logs', AdminAuditLogController::class)->name('admin.audit-logs');
});

/*Logout*/
Route::delete('logout',LogoutController::class)->name('logout-account');
Route::get('/logout', function () {
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect()->route('welcome');
});

require __DIR__.'/auth.php';
