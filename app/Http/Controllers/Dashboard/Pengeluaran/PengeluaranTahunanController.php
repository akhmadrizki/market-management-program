<?php

namespace App\Http\Controllers\Dashboard\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranTahunanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('year')) {
            $pengeluarans = Pengeluaran::whereYear('tanggal', $request->year)->get();
        } else {
            $pengeluarans = Pengeluaran::whereYear('tanggal', Carbon::now()->year)->get();
        }

        return view('pages.dashboard.pengeluaran.tahunan.index', compact('pengeluarans'));
    }
}
