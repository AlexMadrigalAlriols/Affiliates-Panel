<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\HomeController;
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
})->namespace('Admin');

// Auth Routes
Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Translations Assets
Route::get('js/translations.js', [TranslationController::class, 'index'])->name('translations');