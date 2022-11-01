<?php

namespace App\Http\Controllers\Dashboard\Pemasukan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('pages.dashboard.pemasukan.bulanan.index', compact('pemasukans'));
    }
}
