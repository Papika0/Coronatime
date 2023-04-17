<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

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
