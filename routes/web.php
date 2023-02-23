<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LanguageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!dash
|
*/

//Language

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

//Front Side
Route::get('/', [UserAuthController::class, 'index'])->name('home');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout', [UserAuthController::class, 'index'])->name('logout');

Route::get('/about-us', function () {
    return view('about');
});

//Admin Side
Route::get('rudder/', [AdminAuthController::class, 'index'])->name('admin.home')->middleware('auth:webadmin');
Route::get('rudder/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('rudder/login-post', [AdminAuthController::class, 'handleLogin'])->name('admin.handleLogin');
Route::get('rudder/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get("rudder/dashboard", [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:webadmin');
Route::get("rudder/table" , [AdminAuthController::class, 'table'])->name('admin.table')->middleware('auth:webadmin');
Route::get("rudder/withoutMenu" , [AdminAuthController::class, 'withoutMenu'])->name('admin.withoutMenu')->middleware('auth:webadmin');

//Admin Menu
Route::resource('rudder/menu', MenuController::class, [
    'names' => [
        'index' => 'admin.menu',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/menu-post', [MenuController::class, 'datagrid']);
Route::get('/rudder/get-language', [MenuController::class, 'getLanguageEdit']);
Route::get('/rudder/get-language-create', [MenuController::class, 'getLanguageCreate']);
Route::get('/rudder/get-language-detail', [LanguageController::class, 'getLanguage']);


