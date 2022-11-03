<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('pages.dashboard.pemasukan.tahunan.index', compact('pemasukans'));
    }
}
