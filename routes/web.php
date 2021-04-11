<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('user/verify/{token}', [App\Http\Controllers\Auth\RegisterController::class , 'verifyEmail'])->name('verifyEmail');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
//Route::get('/ForgotPassword', [App\Http\Controllers\ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
//Route::get('/resetPassword', [App\Http\Controllers\ResetPasswordController::class, 'login'])->name('resetPassword');
