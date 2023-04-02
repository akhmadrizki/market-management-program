<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Exports\Pemasukan\HarianExport;
use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanHarianController extends Controller
{
    public function index(Request $request)
    {
        $keuangans = Keuangan::with('user')->whereDoesntHave('pengeluaran')->orderBy('tanggal', 'asc');

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

        return view('pages.dashboard.pemasukan.harian.index', compact('final', 'keuangans', 'request', 'uangMasuk', 'uangKeluar', 'totalSaldo'));
    }

    public function export(Request $request)
    {
        if (!empty($request->pemasukan)) {
            $period = Carbon::parse($request->pemasukan)->translatedFormat('l d F Y');
        } else {
            $period = Carbon::now()->translatedFormat('l d F Y');
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Pemasukan Harian ' . $period . '.' . $formatFile;

        return Excel::download(new HarianExport($request), $fileName);
    }
}
