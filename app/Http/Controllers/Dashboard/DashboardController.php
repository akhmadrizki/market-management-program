<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penyewa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $getDateNow = Carbon::now()->translatedFormat('l, d F Y');

        // harian
        $pemasukanHarian   = Pembayaran::whereDate('tanggal', Carbon::today())->get();
        $pengeluaranHarian = Pengeluaran::whereDate('tanggal', Carbon::today())->get();
        $pedagangHarian    = Penyewa::whereDate('created_at', Carbon::today())->get();
        $adminHarian       = User::where('role_id', '=', 2)->whereDate('created_at', Carbon::today())->get();
        $saldoHarian       = Keuangan::whereDate('tanggal', Carbon::today())->get();

        // bulanan
        $pemasukanBulanan   = Pembayaran::whereMonth('tanggal', Carbon::now()->month)->get();
        $pengeluaranBulanan = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)->get();
        $pedagangBulanan    = Penyewa::whereMonth('created_at', Carbon::now()->month)->get();
        $adminBulanan       = User::where('role_id', '=', 2)->whereMonth('created_at', Carbon::now()->month)->get();
        $saldoBulanan       = Keuangan::whereMonth('tanggal', Carbon::now()->month)->get();

        // tahunan
        $pemasukanTahunan   = Pembayaran::whereYear('tanggal', Carbon::now()->year)->get();
        $pengeluaranTahunan = Pengeluaran::whereYear('tanggal', Carbon::now()->year)->get();
        $pedagangTahunan    = Penyewa::whereYear('created_at', Carbon::now()->year)->get();
        $adminTahunan       = User::where('role_id', '=', 2)->whereYear('created_at', Carbon::now()->year)->get();
        $saldoTahunan       = Keuangan::whereYear('tanggal', Carbon::now()->year)->get();

        return view('pages.index', compact(
            'pemasukanHarian',
            'pengeluaranHarian',
            'pedagangHarian',
            'adminHarian',
            'pemasukanBulanan',
            'pengeluaranBulanan',
            'pedagangBulanan',
            'adminBulanan',
            'pemasukanTahunan',
            'pengeluaranTahunan',
            'pedagangTahunan',
            'adminTahunan',
            'getDateNow',
            'saldoHarian',
            'saldoBulanan',
            'saldoTahunan',
        ));
    }
}
