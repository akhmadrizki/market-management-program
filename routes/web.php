<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DataAdminController;
use App\Http\Controllers\Dashboard\DataContractController;
use App\Http\Controllers\Dashboard\DataPenyewaController;
use App\Http\Controllers\Dashboard\JenisPasarController;
use App\Http\Controllers\Dashboard\PengeluaranController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/dashboard-login');

Route::get('/dashboard-login', [LoginController::class, 'index'])->name('admin');

Route::prefix('/')->group(function () {
    Route::redirect('/login', '/dashboard-login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/data-kontrak', [DataContractController::class, 'index'])->name('kontrak.index');
        Route::get('/tambah-data-kontrak', [DataContractController::class, 'create'])->name('kontrak.cerate');

        // Route Pengeluaran
        Route::resource('/pengeluaran', PengeluaranController::class);

        // Route Admin Data
        Route::resource('/admin-data', DataAdminController::class);

        // Route Data Toko
        Route::resource('/jenis-pasar', JenisPasarController::class)->except(['show']);

        // Route Data Penyewa
        Route::resource('/pedagang', DataPenyewaController::class);
    });
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
