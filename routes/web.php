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
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TreatmentController;

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

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

//Front Side Login Routes
Route::get('/', [UserAuthController::class, 'index'])->name('home');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout', [UserAuthController::class, 'index'])->name('logout');

Route::get('/about', function () {
    return view('about');
});

Route::get('/packages', [PackageController::class, 'frontSidePackages'])->name('packages');

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

//Admin Language
Route::get('/rudder/get-language', [LanguageController::class, 'getLanguageEdit']);
Route::get('/rudder/get-language-create', [LanguageController::class, 'getLanguageCreate']);
Route::get('/rudder/get-language-detail', [LanguageController::class, 'getLanguage']);

//Admin Menu
Route::resource('rudder/menu', MenuController::class, [
    'names' => [
        'index' => 'admin.menu',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/menu-post', [MenuController::class, 'datagrid']);
Route::get('/rudder/upper-menu-list', [MenuController::class, 'upperMenuGetList'])->name('admin.upper-menu-list')->middleware('auth:webadmin');

// Facility

Route::resource('rudder/facility', FacilityController::class, [
    'names' => [
        'index' => 'admin.facility',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/facility-list', [FacilityController::class, 'datagrid']);

//Admin Packages
Route::resource('rudder/package', PackageController::class, [
    'names' => [
        'index' => 'admin.package',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/package-list', [PackageController::class, 'datagrid']);
Route::post('/rudder/package-file-upload', [PackageController::class, 'uploadFile'])->middleware('auth:webadmin');


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
Route::get('/rudder/hotel-list-active', [HotelController::class, 'datagridActive']);


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
Route::get('/rudder/currency-list-active', [CurrencyController::class, 'datagridActive']);

//Customer

Route::resource('rudder/customer', CustomerController::class, [
    'names' => [
        'index' => 'admin.customer',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/customer-list', [CustomerController::class, 'datagrid']);

// Profile

Route::resource('rudder/profile', ProfileController::class, [
    'names' => [
        'index' => 'admin.profile',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/getProfile', [ProfileController::class, 'getProfile'])->middleware('auth:webadmin');


//Accommodation
Route::resource('rudder/accomodation', AccomodationController::class, [
    'names' => [
        'index' => 'admin.accomodation',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/accomodation-list', [AccomodationController::class, 'datagrid']);

//Treatment
Route::resource('rudder/treatment', TreatmentController::class, [
    'names' => [
        'index' => 'admin.treatment',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/treatment-list', [TreatmentController::class, 'datagrid']);



//file upload
Route::post('/rudder/file-upload', [FileController::class, 'uploadFile'])->name('uploadFile');
Route::post('/rudder/get-file-list', [FileController::class, 'getFileList']);
Route::post('/rudder/check-cover-file', [FileController::class, 'coverFileCheck']);
Route::post('/rudder/delete-file', [FileController::class, 'deleteFile'])->middleware('auth:webadmin');





























