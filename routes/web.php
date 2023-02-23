<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MenuController;
use \App\Http\Controllers\LanguageController;
use \App\Http\Controllers\CurrencyController;
use \App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LookupController;

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


//Front Side Login Routes
Route::get('/', [UserAuthController::class, 'index'])->name('home');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout', [UserAuthController::class, 'index'])->name('logout');

Route::get('/about-us', function () {
    return view('about');
});

//Admin Side Login Routes
Route::get('rudder/', [AdminAuthController::class, 'index'])->name('admin.home')->middleware('auth:webadmin');
Route::get('rudder/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('rudder/login-post', [AdminAuthController::class, 'handleLogin'])->name('admin.handleLogin');
Route::get('rudder/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get("rudder/dashboard", [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:webadmin');

Route::get("rudder/table" , [AdminAuthController::class, 'table'])->name('admin.table')->middleware('auth:webadmin');

Route::get("rudder/withoutMenu" , [AdminAuthController::class, 'withoutMenu'])->name('admin.withoutMenu')->middleware('auth:webadmin');

//Lookup
Route::get('/rudder/getCityList', [LookupController::class, 'getCities']);
Route::get('/rudder/getCity', [LookupController::class, 'getCity']);
Route::get('/rudder/getCountryList', [LookupController::class, 'getCountries']);
Route::get('/rudder/getCountry', [LookupController::class, 'getCountry']);


//Admin Menu
Route::resource('rudder/menu', MenuController::class, [
    'names' => [
        'index' => 'admin.menu',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/menu-post', [MenuController::class, 'datagrid']);
Route::get('/rudder/get-language', [MenuController::class, 'getLanguageEdit']);
Route::get('/rudder/get-language-create', [MenuController::class, 'getLanguageCreate']);
Route::get('/rudder/get-language-detail', [LanguageController::class, 'getLanguage']);




//Admin Contact

Route::resource('rudder/contact', ContactController::class, [
    'names' => [
        'index' => 'admin.contact',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/contact-list', [ContactController::class, 'datagrid']);



//Hotel
Route::resource('rudder/hotel', HotelController::class, [
    'names' => [
        'index' => 'admin.hotel',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/hotel-list', [HotelController::class, 'datagrid']);


//language
Route::resource('rudder/language', LanguageController::class, [
    'names' => [
        'index' => 'admin.language',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/language-list', [LanguageController::class, 'datagrid']);

//currency

Route::resource('rudder/currency', CurrencyController::class, [
    'names' => [
        'index' => 'admin.currency',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/currency-list', [CurrencyController::class, 'datagrid']);

//Customer

Route::resource('rudder/customer', CustomerController::class, [
    'names' => [
        'index' => 'admin.customer',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/customer-list', [CustomerController::class, 'datagrid']);


































