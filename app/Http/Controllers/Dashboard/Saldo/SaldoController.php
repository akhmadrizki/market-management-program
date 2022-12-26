<?php

namespace App\Http\Controllers\Dashboard\Saldo;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function harian(Request $request)
    {
        if ($request->has('pengeluaran')) {
            $keuangans = Keuangan::whereDate('tanggal', $request->pengeluaran)
                ->with('user')
                ->get();

            $uangMasuk  = $keuangans->sum('pemasukan');
            $uangKeluar = $keuangans->sum('pengeluaran');
            $saldo      = $uangMasuk - $uangKeluar;
        } else {
            $keuangans = Keuangan::whereDate('tanggal', Carbon::today())
                ->with('user')
                ->get();

            $uangMasuk  = $keuangans->sum('pemasukan');
            $uangKeluar = $keuangans->sum('pengeluaran');
            $saldo      = $uangMasuk - $uangKeluar;
        }

        return view('pages.dashboard.saldo.harian.index', compact('keuangans', 'request', 'uangMasuk', 'uangKeluar', 'saldo'));
    }

    public function bulanan(Request $request)
    {
        if ($request->has('month')) {
            $keuangans = Keuangan::whereMonth('tanggal', $request->month)
                ->whereYear('tanggal', $request->year)
                ->with('user')
                ->get();

            $uangMasuk  = $keuangans->sum('pemasukan');
            $uangKeluar = $keuangans->sum('pengeluaran');
            $saldo      = $uangMasuk - $uangKeluar;
        } else {
            $keuangans = Keuangan::whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->with('user')
                ->get();

            $uangMasuk  = $keuangans->sum('pemasukan');
            $uangKeluar = $keuangans->sum('pengeluaran');
            $saldo      = $uangMasuk - $uangKeluar;
        }

        return view('pages.dashboard.saldo.bulanan.index', compact('keuangans', 'request', 'uangMasuk', 'uangKeluar', 'saldo'));
    }

    public function tahunan(Request $request)
    {
        if ($request->has('year')) {
            $keuangans = Keuangan::whereYear('tanggal', $request->year)
                ->with('user')
                ->get();

            $uangMasuk  = $keuangans->sum('pemasukan');
            $uangKeluar = $keuangans->sum('pengeluaran');
            $saldo      = $uangMasuk - $uangKeluar;
        } else {
            $keuangans = Keuangan::whereYear('tanggal', Carbon::now()->year)
                ->with('user')
                ->get();

            $uangMasuk  = $keuangans->sum('pemasukan');
            $uangKeluar = $keuangans->sum('pengeluaran');
            $saldo      = $uangMasuk - $uangKeluar;
        }

        return view('pages.dashboard.saldo.tahunan.index', compact('keuangans', 'request', 'uangMasuk', 'uangKeluar', 'saldo'));
    }
}
