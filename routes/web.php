<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ShopController;
use App\Http\Controllers\Dashboard\ShopLogsController;
use App\Http\Controllers\Dashboard\ShopRolesController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('dashboard.main')->with('status', session('status'));
    }

    return redirect()->route('dashboard.main');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// Logged Dashboard
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth']], static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('main');

    //Shops
    Route::resource('shop', ShopController::class)->only(['show', 'update']);
    Route::get('/shop/{shop}/generate-qr', [ShopController::class, 'generateShopQr'])->name('shop.generate.qr');
    Route::get('/s/{shop}/scan-qr', [UserController::class, 'scanQr'])->name('user.scan.shop.qr');
    Route::middleware('checkOwnedShop')->group(function () {
        Route::get('/s/{shop}/panel', [ShopController::class, 'overview'])->name('shop.panel.overview');
        Route::get('/s/{shop}/customers', [ShopController::class, 'customerList'])->name('shop.panel.customers');
        Route::get('/s/{shop}/configuration', [ShopController::class, 'shopConfig'])->name('shop.panel.configuration');
        Route::get('/s/{shop}/tickets', [ShopController::class, 'ticketsList'])->name('shop.panel.tickets');
    });

    // Ajax
    Route::resource('shop_roles', ShopRolesController::class)->only(['update', 'destroy']);
    Route::get('shop_logs/{shop}', [ShopLogsController::class, 'index'])->name('shop_logs.index');
    Route::get('shop_roles/{shop}', [ShopRolesController::class, 'index'])->name('shop_roles.index');
})->namespace('Admin');

// Auth Routes
//Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Translations Assets
Route::get('js/translations.js', [TranslationController::class, 'index'])->name('translations');
