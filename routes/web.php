<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletManagementController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'is_user', 'verified'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('wallet', [WalletManagementController::class, 'index'])->name('wallet');
});

Route::middleware(['auth', 'is_admin'])->group(function (){
   Route::get('admin/dashboard', function (){
       return 'admin mode';
   })->name('admin.dashboard');
});

require __DIR__.'/auth.php';
