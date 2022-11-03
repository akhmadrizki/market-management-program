<?php

namespace App\Http\Controllers\Dashboard\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranBulananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('month')) {
            $pengeluarans = Pengeluaran::whereMonth('tanggal', $request->month)
                ->whereYear('tanggal', $request->year)
                ->get();
        } else {
            $pengeluarans = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->get();
        }

        return view('pages.dashboard.pengeluaran.bulanan.index', compact('pengeluarans'));
    }
}
