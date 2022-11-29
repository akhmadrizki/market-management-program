<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DataAdminController;
use App\Http\Controllers\Dashboard\DataContractController;
use App\Http\Controllers\Dashboard\DataPenyewaController;
use App\Http\Controllers\Dashboard\Export\ExportController;
use App\Http\Controllers\Dashboard\GarageContractController;
use App\Http\Controllers\Dashboard\JenisPasarController;
use App\Http\Controllers\Dashboard\PasswordController;
use App\Http\Controllers\Dashboard\Pemasukan\PemasukanBulananController;
use App\Http\Controllers\Dashboard\Pemasukan\PemasukanHarianController;
use App\Http\Controllers\Dashboard\Pemasukan\PemasukanTahunanController;
use App\Http\Controllers\Dashboard\PembayaranController;
use App\Http\Controllers\Dashboard\Pengeluaran\PengeluaranBulananController;
use App\Http\Controllers\Dashboard\Pengeluaran\PengeluaranHarianController;
use App\Http\Controllers\Dashboard\Pengeluaran\PengeluaranTahunanController;
use App\Http\Controllers\Dashboard\PengeluaranController;
use App\Http\Controllers\Dashboard\Riwayat\PembayaranController as RiwayatPembayaranController;
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
        // Route Ganti Password
        Route::get('/profile/{user}/password', [PasswordController::class, 'edit'])->name('profile.password');
        Route::put('/profile/{user}/password', [PasswordController::class, 'update'])->name('profile.password.update');

        // Route Kontrak Pasar
        Route::get('/data-kontrak', [DataContractController::class, 'index'])->name('kontrak.index');
        Route::get('/data-kontrak/create', [DataContractController::class, 'create'])->name('kontrak.cerate');
        Route::post('/data-kontrak', [DataContractController::class, 'store'])->name('kontrak.store');
        Route::get('/data-kontrak/{data_kontrak}/edit', [DataContractController::class, 'edit'])->name('kontrak.edit');
        Route::put('/data-kontrak/{data_kontrak}', [DataContractController::class, 'update'])->name('kontrak.update');
        Route::delete('/data-kontrak/{data_kontrak}/delete', [DataContractController::class, 'destroy'])->name('kontrak.destroy');

        // Route Pemasukan
        Route::get('/pemasukan-harian', [PemasukanHarianController::class, 'index'])->name('pemasukan.harian');
        Route::get('/pemasukan-bulanan', [PemasukanBulananController::class, 'index'])->name('pemasukan.bulanan');
        Route::get('/pemasukan-tahunan', [PemasukanTahunanController::class, 'index'])->name('pemasukan.tahunan');

        // Export laporan pemasukan
        Route::get('/laporan-pemasukan', [ExportController::class, 'pemasukan'])->name('laporan.pemasukan');
        Route::get('/laporan-pemasukan-harian', [PemasukanHarianController::class, 'export'])->name('laporan-pemasukan.harian');
        Route::get('/laporan-pemasukan-bulanan', [PemasukanBulananController::class, 'export'])->name('laporan-pemasukan.bulanan');
        Route::get('/laporan-pemasukan-tahunan', [PemasukanTahunanController::class, 'export'])->name('laporan-pemasukan.tahunan');

        // Export laporan pengeluaran
        Route::get('/laporan-pengeluaran', [ExportController::class, 'pengeluaran'])->name('laporan.pengeluaran');
        Route::get('/laporan-pengeluaran-harian', [PengeluaranHarianController::class, 'export'])->name('laporan-pengeluaran.harian');
        Route::get('/laporan-pengeluaran-bulanan', [PengeluaranBulananController::class, 'export'])->name('laporan-pengeluaran.bulanan');
        Route::get('/laporan-pengeluaran-tahunan', [PengeluaranTahunanController::class, 'export'])->name('laporan-pengeluaran.tahunan');

        // Route Pembayaran
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/fetch/{id}', [PembayaranController::class, 'fetch'])->name('pembayaran.fetch');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/{pembayaran}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
        Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');
        Route::delete('/pembayaran/{pembayaran}/delete', [PembayaranController::class, 'destroy'])->name('pembayaran.delete');

        // Route Riwayat Pembayaran
        Route::get('/riwayat-pembayaran/{id}', [RiwayatPembayaranController::class, 'index'])->name('riwayat.pembayaran');

        // Route Pengeluaran
        Route::resource('/pengeluaran', PengeluaranController::class);

        Route::get('/pengeluaran-harian', [PengeluaranHarianController::class, 'index'])->name('pengeluaran.harian');
        Route::get('/pengeluaran-bulanan', [PengeluaranBulananController::class, 'index'])->name('pengeluaran.bulanan');
        Route::get('/pengeluaran-tahunan', [PengeluaranTahunanController::class, 'index'])->name('pengeluaran.tahunan');

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

Route::redirect('/home', '/dashboard');
