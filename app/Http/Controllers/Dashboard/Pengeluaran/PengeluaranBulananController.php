<?php

namespace App\Http\Controllers\Dashboard\Pengeluaran;

use App\Exports\Pengeluaran\BulananExport;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranBulananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('month')) {
            $pengeluarans = Pengeluaran::whereMonth('tanggal', $request->month)
                ->whereYear('tanggal', $request->year)
                ->with('user')
                ->get();
        } else {
            $pengeluarans = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->with('user')
                ->get();
        }

        return view('pages.dashboard.pengeluaran.bulanan.index', compact('pengeluarans', 'request'));
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
        $fileName   = 'Laporan Pengeluaran Bulanan ' . $combined . '.' . $formatFile;

        return Excel::download(new BulananExport($request), $fileName);
    }
}
