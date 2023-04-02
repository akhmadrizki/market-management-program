<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Exports\Pemasukan\TahunanExport;
use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanTahunanController extends Controller
{
    public function index(Request $request)
    {
        $keuangans = Keuangan::with('user')
            ->whereDoesntHave('pengeluaran')
            ->groupByRaw('month(tanggal)')
            ->select([
                DB::raw('max(user_id) as user_id'),
                DB::raw('month(tanggal) as tanggal'),
                DB::raw('SUM(pemasukan) as pemasukan')
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


            $saldoTest = $saldoTest + $key->pemasukan;

            $final[] = (object) [
                'tanggal' => Carbon::createFromFormat('m', $key->tanggal)->translatedFormat('F'),
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'saldo' => $saldoTest,
            ];
        }

        $uangMasuk  = $keuangans->sum('pemasukan');
        $uangKeluar = $keuangans->sum('pengeluaran');
        $totalSaldo = $uangMasuk - $uangKeluar;

        return view('pages.dashboard.pemasukan.tahunan.index', compact('final', 'keuangans', 'request', 'uangMasuk', 'uangKeluar', 'totalSaldo'));
    }

    public function export(Request $request)
    {
        if (!empty($request->year)) {
            $period = $request->year;
        } else {
            $period = Carbon::now()->year;
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Pemasukan Tahunan ' . $period . '.' . $formatFile;

        return Excel::download(new TahunanExport($request), $fileName);
    }
}
