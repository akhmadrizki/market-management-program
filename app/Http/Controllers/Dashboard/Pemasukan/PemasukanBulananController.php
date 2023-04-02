<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Exports\Pemasukan\BulananExport;
use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanBulananController extends Controller
{
    public function index(Request $request)
    {
        $keuangans = Keuangan::with('user')->whereDoesntHave('pengeluaran')->orderBy('tanggal', 'asc');

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

            $saldoTest = $saldoTest + $key->pemasukan;

            $final[] = (object) [
                'keterangan' => $key->keterangan,
                'tanggal' => $key->tanggal,
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'saldo' => $saldoTest,
            ];
        }

        $uangMasuk  = $keuangans->sum('pemasukan');
        $uangKeluar = $keuangans->sum('pengeluaran');
        $totalSaldo = $uangMasuk - $uangKeluar;

        return view('pages.dashboard.pemasukan.bulanan.index', compact('final', 'keuangans', 'request', 'uangMasuk', 'uangKeluar', 'totalSaldo'));
    }

    public function export(Request $request)
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
        $fileName   = 'Laporan Pemasukan Bulanan ' . $combined . '.' . $formatFile;

        return Excel::download(new BulananExport($request), $fileName);
    }
}
