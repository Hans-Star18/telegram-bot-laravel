<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\BoxController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\TokenController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\DashboardController;

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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('tokens', [TokenController::class, 'index'])->name('tokens.index');

    Route::get('boxs', [BoxController::class, 'index'])->name('box.index');

    Route::get('items', [ItemController::class, 'index'])->name('items.index');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});
