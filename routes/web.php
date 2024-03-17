<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\InfrastructureController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
    });
    
    Route::middleware(['auth'])->group(function() {
        Route::post('logout', LogoutController::class)->name('logout');
    });
    
});

Route::get("/", DashboardController::class)->name('dashboard');
Route::resource("/villages", VillageController::class);
Route::resource("/infrastructures", InfrastructureController::class);
Route::resource("/facilities", FacilityController::class);

Route::fallback(function() {
    return view('errors.404');
});