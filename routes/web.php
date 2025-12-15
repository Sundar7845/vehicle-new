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

Route::fallback(function () {
    return view('error.error');
});

require base_path('routes/admin.php');
Route::middleware('killswitch')->group(function () {
    Route::get('/', function () {
        return view('frontend.login');
    });
    Route::prefix('frontend')->group(function () {
        Route::get('/login', [App\Http\Controllers\Frontend\Login\LoginController::class, 'login'])->name('frontend.login');
        Route::post('/loginstore', [App\Http\Controllers\Frontend\Login\LoginController::class, 'loginstore'])->name('frontend.loginstore');
        Route::get('/otp', [App\Http\Controllers\Frontend\Login\LoginController::class, 'otp'])->name('frontend.otp');
        Route::post('/otp-verify', [App\Http\Controllers\Frontend\Login\LoginController::class, 'otpVerify'])->name('frontend.otpverify');
    });

    Route::prefix('frontend')->middleware('auth')->group(function () {
        Route::get('/logout', [App\Http\Controllers\Frontend\Login\LoginController::class, 'logout'])->name('frontend.logout');
        Route::get('/dashboard', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'dashboard'])->name('frontend.dashboard');
        Route::get('/vehicle', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'vehicle'])->name('frontend.vehicle');
        Route::post('/vehiclestore', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'vehiclestore'])->name('frontend.vehiclestore');
        // Fetch vehicle details by number
        Route::get('/vehicle-details/{vehicleNumber}', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'fetchDetails']);

        // Fetch default unit for a vehicle type
        Route::get('/vehicle-default-unit/{vehicleTypeId}', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'fetchDefaultUnit']);
        // Vehicle checkout
        Route::post('/vehicle/out/{id}', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'vehicleOut'])->name('frontend.vehicleout');
    });
});
