<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
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


//Front Side Login Routes
Route::get('/', [UserAuthController::class, 'index'])->name('home');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout', [UserAuthController::class, 'index'])->name('logout');


//Admin Side Login Routes
Route::get('rudder/', [AdminAuthController::class, 'index'])->name('admin.home')->middleware('auth:webadmin');
Route::get('rudder/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('rudder/login-post', [AdminAuthController::class, 'handleLogin'])->name('admin.handleLogin');
Route::get('rudder/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

