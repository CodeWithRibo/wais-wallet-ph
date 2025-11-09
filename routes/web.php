<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\WalletManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'is_user', 'verified'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('wallet', WalletManagementController::class)->name('wallet');
    Route::get('expenses', ExpensesController::class)->name('expenses');
    Route::get('categories', CategoriesController::class)->name('categories');
});

Route::middleware(['auth', 'is_admin'])->group(function (){
   Route::get('admin/dashboard', function (){
       return 'admin mode';
   })->name('admin.dashboard');
});

Route::delete('logout',LogoutController::class)->name('logout-account');
Route::get('/logout', function () {
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect()->route('welcome');
});

require __DIR__.'/auth.php';
