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
    Route::get('tokens/add', [TokenController::class, 'add'])->name('tokens.add');
    Route::post('tokens/add', [TokenController::class, 'store'])->name('tokens.store');
    Route::get('tokens/{token}/edit', [TokenController::class, 'edit'])->name('tokens.edit');
    Route::put('tokens/{token}/edit', [TokenController::class, 'update'])->name('tokens.update');
    Route::delete('tokens/{token}/delete', [TokenController::class, 'destroy'])->name('tokens.destroy');

    Route::get('boxs', [BoxController::class, 'index'])->name('box.index');
    Route::get('boxs/{drawbox}/show', [BoxController::class, 'show'])->name('box.show');
    Route::get('boxs/add', [BoxController::class, 'add'])->name('box.add');
    Route::post('boxs/add', [BoxController::class, 'store'])->name('box.store');
    Route::get('boxs/{drawbox}/edit', [BoxController::class, 'edit'])->name('box.edit');
    Route::put('boxs/{drawbox}/edit', [BoxController::class, 'update'])->name('box.update');
    Route::delete('boxs/{drawbox}/delete', [BoxController::class, 'destroy'])->name('box.destroy');

    Route::get('items', [ItemController::class, 'index'])->name('items.index');
    Route::get('items/add', [ItemController::class, 'add'])->name('items.add');
    Route::post('items/add', [ItemController::class, 'store'])->name('items.store');
    Route::get('items/{boxItem}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('items/{boxItem}/edit', [ItemController::class, 'update'])->name('items.update');
    Route::delete('items/{boxItem}/delete', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [ReportController::class, 'exportToExcel'])->name('reports.export');
});
