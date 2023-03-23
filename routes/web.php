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
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\HotelFacilityController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AccomodationTypeController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\PackageTreatmentController;

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

Route::get('/mest-club-card', function () {
    return view('mest-club-card');
});





Route::get('/health-in-turkey', function () {
    return view('health-in-turkey');
});


//Admin Side Login Routes
Route::get('rudder/', [AdminAuthController::class, 'index'])->name('admin.home')->middleware('auth:webadmin');
Route::get('rudder/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('rudder/login-post', [AdminAuthController::class, 'handleLogin'])->name('admin.handleLogin');
Route::get('rudder/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get("rudder/dashboard", [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:webadmin');

Route::get("rudder/table", [AdminAuthController::class, 'table'])->name('admin.table')->middleware('auth:webadmin');

Route::get("rudder/withoutMenu", [AdminAuthController::class, 'withoutMenu'])->name('admin.withoutMenu')->middleware('auth:webadmin');

//Lookup
Route::get('/rudder/getCityList', [LookupController::class, 'getCities']);
Route::get('/rudder/getCity', [LookupController::class, 'getCity']);
Route::get('/rudder/getCountryList', [LookupController::class, 'getCountries']);
Route::get('/rudder/getCountry', [LookupController::class, 'getCountry']);

//Admin Language
Route::get('/rudder/get-language', [LanguageController::class, 'getLanguageEdit']);
Route::get('/rudder/get-language-create', [LanguageController::class, 'getLanguageCreate']);
Route::get('/rudder/get-language-detail', [LanguageController::class, 'getLanguage']);

//Admin Facility_Hotel
Route::resource('rudder/hotel_facility', HotelFacilityController::class, [
    'names' => [
        'index' => 'admin.hotel_facility',
    ]])->middleware('auth:webadmin');

Route::post('/rudder/get-hotel-facility', [HotelFacilityController::class, 'HotelInsertFacility'])->middleware('auth:webadmin');



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
Route::get('/packages', [PackageController::class, 'frontSidePackages'])->name('packages');
Route::get('/package/{slug}', [PackageController::class, 'frontSidePackagesDetail']);


//Contact

Route::resource('rudder/contact', ContactController::class, [
    'names' => [
        'index' => 'admin.contact',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/contact-list', [ContactController::class, 'datagrid']);
Route::get('/contact', [ContactController::class, 'frontSideContact']);

//Hotel
Route::resource('rudder/hotel', HotelController::class, [
    'names' => [
        'index' => 'admin.hotel',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/hotel-list', [HotelController::class, 'datagrid']);
Route::get('/rudder/hotel-list-active', [HotelController::class, 'datagridActive']);
Route::post('/rudder/hotel-file-upload', [HotelController::class, 'uploadFile'])->middleware('auth:webadmin');
Route::get('/hotel/{slug}', [HotelController::class, 'frontSideHotelDetail']);

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

//Config
Route::resource('rudder/config', ConfigController::class, [
    'names' => [
        'index' => 'admin.config',
    ]])->middleware('auth:webadmin');


//Accommodation
Route::resource('rudder/accomodation', AccomodationController::class, [
    'names' => [
        'index' => 'admin.accomodation',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/accomodation-list', [AccomodationController::class, 'datagrid']);

//Accommodation Type
Route::resource('rudder/accomodationType', AccomodationTypeController::class, [
    'names' => [
        'index' => 'admin.accomodationType',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/accomodationType-list', [AccomodationTypeController::class, 'datagrid']);

//Exchange Rate
Route::resource('rudder/exchangeRate', ExchangeRateController::class, [
    'names' => [
        'index' => 'admin.exchangeRate',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/exchangeRate-list', [ExchangeRateController::class, 'datagrid']);

Route::get('/rudder/getExchangeRates', [ExchangeRateController::class, 'getExchangeRates']);

//Package Treatment
Route::post('/rudder/get-treatment-package', [PackageTreatmentController::class, 'TreatmentInsertFacility'])->middleware('auth:webadmin');

//Treatment
Route::resource('rudder/treatment', TreatmentController::class, [
    'names' => [
        'index' => 'admin.treatment',
    ]])->middleware('auth:webadmin');
Route::get('/rudder/treatment-list-active', [TreatmentController::class, 'datagridActive'])->middleware('auth:webadmin');
Route::get('/rudder/treatment-list', [TreatmentController::class, 'datagrid']);
Route::post('/rudder/treatment-file-upload', [TreatmentController::class, 'uploadFile'])->middleware('auth:webadmin');
Route::get('/treatment/{slug}', [TreatmentController::class, 'frontSideTreatmentsDetail']);

//Questions
Route::resource('rudder/questions', QuestionsController::class, [
    'names' => [
        'index' => 'admin.questions',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/questions-list', [QuestionsController::class, 'datagrid']);

//file upload
Route::post('/rudder/file-upload', [FileController::class, 'uploadFile'])->name('uploadFile');
Route::post('/rudder/get-file-list', [FileController::class, 'getFileList']);
Route::post('/rudder/check-cover-file', [FileController::class, 'coverFileCheck']);
Route::post('/rudder/delete-file', [FileController::class, 'deleteFile'])->middleware('auth:webadmin');

// Blog
Route::resource('rudder/blog', BlogController::class, [
    'names' => [
        'index' => 'admin.blog',
    ]])->middleware('auth:webadmin');
Route::get('/rudder/blog-list', [BlogController::class, 'datagrid']);
Route::post('/rudder/blog-file-upload', [BlogController::class, 'uploadFile'])->middleware('auth:webadmin');
Route::get('/blog', [BlogController::class, 'frontSideBlog'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'frontSideBlogDetail']);


//Offices
Route::resource('rudder/offices', OfficesController::class, [
    'names' => [
        'index' => 'admin.offices',
    ]])->middleware('auth:webadmin');

Route::get('/rudder/offices-list', [OfficesController::class, 'datagrid']);
