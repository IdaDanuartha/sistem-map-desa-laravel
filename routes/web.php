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

Route::middleware("auth")->group(function() {
    Route::resource("/villages", VillageController::class)->except("index", "show");
    Route::get("/village/import", [VillageController::class, 'importView'])->name('villages.importView');
    Route::post("/village/import", [VillageController::class, 'import'])->name('villages.import');

    Route::resource("/infrastructures", InfrastructureController::class)->except("index", "show");
    Route::get("/infrastructure/import", [InfrastructureController::class, 'importView'])->name('infrastructures.importView');
    Route::post("/infrastructure/import", [InfrastructureController::class, 'import'])->name('infrastructures.import');

    Route::resource("/facilities", FacilityController::class)->except("index", "show");
    Route::get("/facility/import", [FacilityController::class, 'importView'])->name('facilities.importView');
    Route::post("/facility/import", [FacilityController::class, 'import'])->name('facilities.import');
});

Route::get("/", DashboardController::class)->name('dashboard');
Route::resource("/villages", VillageController::class)->only("index", "show");
Route::resource("/infrastructures", InfrastructureController::class)->only("index", "show");
Route::resource("/facilities", FacilityController::class)->only("index", "show");

Route::fallback(function() {
    return view('errors.404');
});