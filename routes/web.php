<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\EmailVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [LoginController::class, 'show'])->name('home.index');

Route::controller(RegisterController::class)->prefix('register')->group(function () {
	Route::get('/', 'show')->name('register.show');
	Route::post('/', 'register')->name('register');
});

Route::controller(LoginController::class)->prefix('login')->middleware('guest')->group(function () {
	Route::get('/', 'show')->name('login.show');
	Route::post('/', 'login')->name('login');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('/email/verify')->controller(EmailVerificationController::class)->group(function () {
	Route::get('/', 'show')->name('verification.notice');
	Route::get('/{id}/{hash}', 'verify')->name('verification.verify')->middleware('signed');
});

Route::prefix('reset-password')->controller(ResetPasswordController::class)->middleware('guest')->group(function () {
	Route::get('/', 'show')->name('password.request_show');
	Route::post('/', 'request')->name('password.request');
	Route::get('/{token}', 'showResetForm')->name('password.reset_show');
	Route::post('/{token}', 'reset')->name('password.reset');
});

Route::middleware(['auth'])->controller(CountriesController::class)->group(function () {
	Route::get('/dashboard', 'show')->name('dashboard.show');
	Route::get('/dashboard/countries', 'index')->name('countries.index');
});

Route::get('/set-locale/{locale}', [LocalizationController::class, 'setLanguage'])->name('set.locale');
