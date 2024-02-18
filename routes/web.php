<?php

use App\Http\Controllers\Dashboard\ShopLevelsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\MessagesController;
use App\Http\Controllers\Dashboard\PaychecksController;
use App\Http\Controllers\Dashboard\ShopController;
use App\Http\Controllers\Dashboard\ShopLogsController;
use App\Http\Controllers\Dashboard\ShopRolesController;
use App\Http\Controllers\Dashboard\TicketController;
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
    Route::get('/paychecks', [DashboardController::class, 'paychecksIndex'])->name('paychecks');

    //Shops
    Route::resource('shop', ShopController::class)->only(['show']);
    Route::get('/shop/{shop}/generate-qr', [ShopController::class, 'generateShopQr'])->name('shop.generate.qr');
    Route::get('/s/{shop}/scan-qr', [UserController::class, 'scanQr'])->name('user.scan.shop.qr');
    Route::get('/s/{shop}/unmark', [UserController::class, 'unmarkShop'])->name('user.shop.unmark');

    Route::middleware('checkOwnedShop')->group(function () {
        Route::get('/s/{shop}/panel', [ShopController::class, 'overview'])->name('shop.panel.overview');
        Route::get('/s/{shop}/customers', [ShopController::class, 'customerList'])->name('shop.panel.customers');

        Route::put('/s/{shop}/configuration', [ShopController::class, 'update'])->name('shop.update');
        Route::put('/s/{shop}/data', [ShopController::class, 'updateData'])->name('shop.update.data');

        // Menu
        Route::get('/s/{shop}/configuration', [ShopController::class, 'shopConfig'])->name('shop.panel.configuration');
        Route::get('/s/{shop}/configuration/rewards', [ShopLevelsController::class, 'index'])->name('shop.panel.configuration.rewards.index');
        Route::put('/s/{shop}/configuration/rewards', [ShopLevelsController::class, 'update'])
            ->name('shop.panel.configuration.rewards');
        Route::get('/s/{shop}/configuration/roles', [ShopRolesController::class, 'index'])->name('shop.panel.configuration.roles.index');
        Route::get('/s/{shop}/configuration/logs', [ShopLogsController::class, 'index'])->name('shop.panel.configuration.logs.index');
        Route::get('/s/{shop}/configuration/appearance', [ShopController::class, 'shopAppearance'])->name('shop.panel.configuration.appearance.index');

        // Ticket System
        Route::get('/s/{shop}/tickets', [TicketController::class, 'ticketsList'])->name('shop.panel.tickets');
        Route::get('/s/{shop}/tickets/{ticket}', [TicketController::class, 'returnTicket'])
            ->name('shop.panel.tickets.return');
        Route::get('/s/{shop}/{user}/read-qr', [ShopController::class, 'scanQrTicket'])->name('user.scan.qr');
        Route::post('/s/{shop}/{user}/read-qr', [TicketController::class, 'saveTicket'])->name('shop.saveTicket');

        // Paycheck System
        Route::get('/s/{shop}/paychecks', [PaychecksController::class, 'list'])->name('shop.panel.paychecks');
        Route::get('/s/{shop}/{user}/pay-check', [PaychecksController::class, 'create'])
            ->name('shop.panel.paychecks.create');
        Route::post('/s/{shop}/{user}/pay-check', [PaychecksController::class, 'store'])
            ->name('shop.panel.paychecks.store');
        Route::get('/s/{shop}/pay-check/{paycheck}', [PaychecksController::class, 'destroy'])
            ->name('shop.panel.paychecks.destroy');

        // Messages
        Route::get('/s/{shop}/messages', [MessagesController::class, 'index'])->name('shop.panel.messages');

        // Ajax
        Route::post('shop_roles/{shop}', [ShopRolesController::class, 'store'])->name('shop_roles.store');
        Route::get('shop_roles/{shop}/create', [ShopRolesController::class, 'create'])->name('shop_roles.create');
        Route::delete('shop_roles/{shop}', [ShopRolesController::class, 'destroy'])->name('shop_roles.destroy');
        Route::get('shop_roles/{shop}/edit/{shopRole}', [ShopRolesController::class, 'edit'])->name('shop_roles.edit');
        Route::put('shop_roles/{shop}/edit/{shopRole}', [ShopRolesController::class, 'update'])->name('shop_roles.update');
        Route::get('shop_levels/{shop}', [ShopLevelsController::class, 'index'])->name('shop_levels.index');

        Route::get('/s/{shop}/users/select2', [UserController::class, 'select2'])->name('users.select2');
    });
})->namespace('Admin');

// Auth Routes
Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Translations Assets
Route::get('js/translations.js', [TranslationController::class, 'index'])->name('translations');
