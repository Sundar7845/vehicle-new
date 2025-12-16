<?php

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
// Backend Routes
Route::prefix('backend')->group(function () {
    // Login Routes
    Route::get('/login', [App\Http\Controllers\Backend\Login\LoginController::class, 'login'])->name('backend.login');
    Route::post('/loginstore', [App\Http\Controllers\Backend\Login\LoginController::class, 'loginstore'])->name('backend.loginstore');
    Route::get('/logout', [App\Http\Controllers\Backend\Login\LoginController::class, 'logout'])->name('backend.logout');

    // OTP Routes
    Route::get('/dashboard', [App\Http\Controllers\Backend\Dashboard\DashboardController::class, 'dashboard'])->name('backend.dashboard');
    Route::get('/sites/{id?}', [App\Http\Controllers\Backend\Site\SiteController::class, 'site'])->name('backend.site');
    Route::get('/otp/{id}', [App\Http\Controllers\Backend\Site\SiteController::class, 'otp'])->name('backend.otp');
    Route::get('/admin/get-otps/{id}', [App\Http\Controllers\Backend\Site\SiteController::class, 'getOtps'])->name('backend.getotps');
    Route::get('/admin/refresh-otp/{id}', [App\Http\Controllers\Backend\Site\SiteController::class, 'refreshOtp'])->name('backend.refreshotp');




    //Owner Routes
    Route::get('/kill', [App\Http\Controllers\Backend\Owner\OwnerController::class, 'kill'])->name('backend.kill');
    Route::post('/owner/kill-switch', [App\Http\Controllers\Backend\Owner\OwnerController::class, 'updateKill'])->name('owner.kill.update');
    Route::get('/taluk', [App\Http\Controllers\Backend\Owner\OwnerController::class, 'taluk'])->name('backend.taluk');
});
