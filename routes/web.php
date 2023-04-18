<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
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

Route::controller(RegisterController::class)->group(function () {
	Route::get('/register', 'show')->name('register.show');
	Route::post('/register', 'register')->name('register');
});

Route::controller(LoginController::class)->group(function () {
	Route::get('/login', 'show')->name('login.show');
	Route::post('/login', 'login')->name('login');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::controller(EmailVerificationController::class)->middleware('auth')->group(function () {
	Route::get('/email/verify', 'show')->name('verification.notice');
	Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware('signed');
});

Route::controller(ResetPasswordController::class)->middleware('guest')->group(function () {
	Route::get('/reset-password', 'show')->name('password.request_show');
	Route::post('/reset-password', 'request')->name('password.request');
	Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset_show');
	Route::post('/reset-password/{token}', 'reset')->name('password.reset');
});
