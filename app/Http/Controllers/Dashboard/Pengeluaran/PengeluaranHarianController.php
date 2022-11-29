<?php

namespace App\Http\Controllers\Dashboard\Pengeluaran;

use App\Exports\Pengeluaran\HarianExport;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranHarianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('pengeluaran')) {
            $pengeluarans = Pengeluaran::whereDate('tanggal', $request->pengeluaran)
                ->with('user')
                ->get();
        } else {
            $pengeluarans = Pengeluaran::whereDate('tanggal', Carbon::today())
                ->with('user')
                ->get();
        }

        return view('pages.dashboard.pengeluaran.harian.index', compact('pengeluarans', 'request'));
    }

    public function export(Request $request)
    {
        if (!empty($request->pengeluaran)) {
            $period = Carbon::parse($request->pengeluaran)->translatedFormat('l d F Y');
        } else {
            $period = Carbon::now()->translatedFormat('l d F Y');
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Pengeluaran Harian ' . $period . '.' . $formatFile;

        return Excel::download(new HarianExport($request), $fileName);
    }
}
