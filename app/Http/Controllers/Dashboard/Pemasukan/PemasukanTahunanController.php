<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Exports\Pemasukan\TahunanExport;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanTahunanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('year')) {
            $pemasukans = Pembayaran::whereYear('tanggal', $request->year)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        } else {
            $pemasukans = Pembayaran::whereYear('tanggal', Carbon::now()->year)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        }

        return view('pages.dashboard.pemasukan.tahunan.index', compact('pemasukans', 'request'));
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
