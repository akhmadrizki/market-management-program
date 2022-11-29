<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Exports\Pemasukan\BulananExport;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanBulananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('month')) {
            $pemasukans = Pembayaran::whereMonth('tanggal', $request->month)
                ->whereYear('tanggal', $request->year)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        } else {
            $pemasukans = Pembayaran::whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        }

        return view('pages.dashboard.pemasukan.bulanan.index', compact('pemasukans', 'request'));
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
