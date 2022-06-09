<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DataAdminController;
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
        // Route Admin Data
        Route::resource('/admin-data', DataAdminController::class);
    });
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
