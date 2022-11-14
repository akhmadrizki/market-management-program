<?php

namespace App\Http\Controllers\Dashboard\Pengeluaran;

use App\Exports\Pengeluaran\TahunanExport;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranTahunanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('year')) {
            $pengeluarans = Pengeluaran::whereYear('tanggal', $request->year)
                ->with('user')
                ->get();
        } else {
            $pengeluarans = Pengeluaran::whereYear('tanggal', Carbon::now()->year)
                ->with('user')
                ->get();
        }

        return view('pages.dashboard.pengeluaran.tahunan.index', compact('pengeluarans', 'request'));
    }

    public function export(Request $request)
    {
        if (!empty($request->year)) {
            $period = $request->year;
        } else {
            $period = Carbon::now()->year;
        }

        $formatFile = 'xlsx';
        $fileName   = 'Laporan Pengeluaran Tahunan ' . $period . '.' . $formatFile;

        return Excel::download(new TahunanExport($request), $fileName);
    }
}
