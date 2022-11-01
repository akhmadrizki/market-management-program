<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('pages.dashboard.pemasukan.harian.index', compact('pemasukans'));
    }
}
