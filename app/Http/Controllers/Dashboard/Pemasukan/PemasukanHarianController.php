<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Exports\Pemasukan\HarianExport;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanHarianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('pemasukan')) {
            $pemasukans = Pembayaran::where('tanggal', $request->pemasukan)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        } else {
            $pemasukans = Pembayaran::whereDate('tanggal', Carbon::today())
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        }

        return view('pages.dashboard.pemasukan.harian.index', compact('pemasukans', 'request'));
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
