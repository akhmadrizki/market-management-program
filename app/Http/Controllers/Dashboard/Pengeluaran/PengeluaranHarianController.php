<?php

namespace App\Http\Controllers\Dashboard\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranHarianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('pengeluaran')) {
            $pengeluarans = Pengeluaran::whereDate('tanggal', $request->pengeluaran)->get();
        } else {
            $pengeluarans = Pengeluaran::whereDate('tanggal', Carbon::today())->get();
        }

        return view('pages.dashboard.pengeluaran.harian.index', compact('pengeluarans'));
    }
}
