<?php

namespace App\Http\Controllers\Dashboard\Saldo;

use App\Exports\Laporan\BulananExport;
use App\Exports\Laporan\HarianExport;
use App\Exports\Laporan\TahunanExport;
use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SaldoController extends Controller
{
    public function harian(Request $request)
    {
        $keuangans = Keuangan::with('user')
            ->orderBy('tanggal', 'asc');
        if ($request->has('saldo')) {
            $keuangans = $keuangans->whereDate('tanggal', $request->saldo);
        } else {
            $keuangans = $keuangans->whereDate('tanggal', Carbon::today());
        }

        $keuangans = $keuangans->get();

        $saldoTest = 0;

        $final = [];

        foreach ($keuangans as $key) {
            $a = $key->pemasukan;
            $b = $key->pengeluaran;

            if ($key->pengeluaran_id == null) {
                $saldoTest = $saldoTest + $key->pemasukan;
            } else {
                $saldoTest = $saldoTest - $key->pengeluaran;
            }

            $final[] = (object) [
                'keterangan' => $key->keterangan,
                'tanggal' => $key->tanggal,
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'pengeluaran' => $key->pengeluaran,
                'saldo' => $saldoTest,
            ];
        }

        $uangMasuk  = $keuangans->sum('pemasukan');
        $uangKeluar = $keuangans->sum('pengeluaran');
        $totalSaldo = $uangMasuk - $uangKeluar;

        return view('pages.dashboard.saldo.harian.index', compact('final', 'keuangans', 'request', 'uangMasuk', 'uangKeluar', 'totalSaldo'));
    }

    public function exportHarian(Request $request)
    {
        if (!empty($request->saldo)) {
            $period = Carbon::parse($request->saldo)->translatedFormat('l d F Y');
        } else {
            $period = Carbon::now()->translatedFormat('l d F Y');
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Keuangan Harian ' . $period . '.' . $formatFile;

        return Excel::download(new HarianExport($request), $fileName);
    }

    public function bulanan(Request $request)
    {
        $keuangans = Keuangan::with('user')
            ->orderBy('tanggal', 'asc');
        if ($request->has('month')) {
            $keuangans = $keuangans->whereMonth('tanggal', $request->month);
        } else {
            $keuangans = $keuangans->whereMonth('tanggal', Carbon::now()->month);
        }

        if ($request->has('year')) {
            $keuangans = $keuangans->whereYear('tanggal', $request->year);
        } else {
            $keuangans = $keuangans->whereYear('tanggal', Carbon::now()->year);
        }

        $keuangans = $keuangans->get();

        $saldoTest = 0;

        $final = [];

        foreach ($keuangans as $key) {
            $a = $key->pemasukan;
            $b = $key->pengeluaran;

            if ($key->pengeluaran_id == null) {
                $saldoTest = $saldoTest + $key->pemasukan;
            } else {
                $saldoTest = $saldoTest - $key->pengeluaran;
            }

            $final[] = (object) [
                'keterangan' => $key->keterangan,
                'tanggal' => $key->tanggal,
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'pengeluaran' => $key->pengeluaran,
                'saldo' => $saldoTest,
            ];
        }

        $uangMasuk  = $keuangans->sum('pemasukan');
        $uangKeluar = $keuangans->sum('pengeluaran');
        $totalSaldo = $uangMasuk - $uangKeluar;

        return view('pages.dashboard.saldo.bulanan.index', compact('final', 'keuangans', 'request', 'uangMasuk', 'uangKeluar', 'totalSaldo'));
    }

    public function exportBulanan(Request $request)
    {
        $getMonth = $request->month;
        $year     = $request->year;

        if (!empty($getMonth) && !empty($year)) {
            $convertMonth = match ($getMonth) {
                '01' => 'Januari',
                '02' => 'Febuari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            };

            $combined = $convertMonth . ' ' . $year;
        } else {
            $combined = Carbon::now()->translatedFormat('F Y');
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Keuangan Bulanan ' . $combined . '.' . $formatFile;

        return Excel::download(new BulananExport($request), $fileName);
    }

    public function tahunan(Request $request)
    {
        $keuangans = Keuangan::with('user')
            ->groupByRaw('month(tanggal)')
            ->select([
                DB::raw('max(user_id) as user_id'),
                DB::raw('month(tanggal) as tanggal'),
                DB::raw('SUM(pemasukan) as pemasukan'),
                DB::raw('SUM(pengeluaran) as pengeluaran')
            ])
            ->orderBy('tanggal', 'asc');

        if ($request->has('year')) {
            $keuangans = $keuangans->whereYear('tanggal', $request->year);
        } else {
            $keuangans = $keuangans->whereYear('tanggal', Carbon::now()->year);
        }

        $keuangans = $keuangans->get();

        $saldoTest = 0;

        $final = [];

        foreach ($keuangans as $key) {
            $a = $key->pemasukan;
            $b = $key->pengeluaran;


            $saldoTest = $saldoTest + ($key->pemasukan - $key->pengeluaran);

            $final[] = (object) [
                'tanggal' => Carbon::createFromFormat('m', $key->tanggal)->translatedFormat('F'),
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'pengeluaran' => $key->pengeluaran,
                'saldo' => $saldoTest,
            ];
        }

        $uangMasuk  = $keuangans->sum('pemasukan');
        $uangKeluar = $keuangans->sum('pengeluaran');
        $totalSaldo = $uangMasuk - $uangKeluar;

        return view('pages.dashboard.saldo.tahunan.index', compact('final', 'keuangans', 'request', 'uangMasuk', 'uangKeluar', 'totalSaldo'));
    }

    public function exportTahunan(Request $request)
    {
        if (!empty($request->year)) {
            $period = $request->year;
        } else {
            $period = Carbon::now()->year;
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Keuangan Tahunan ' . $period . '.' . $formatFile;

        return Excel::download(new TahunanExport($request), $fileName);
    }
}
