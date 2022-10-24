<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penyewa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $pedagang = Penyewa::all();
        $admin = User::where('role_id', '=', 2)->get();

        // Request
        $dateFilter = $request->date;
        $monthFilter = $request->month;
        $yearFilter = $request->year;

        if ($request->has('date') || $request->has('month') || $request->has('year')) {
            $pemasukan = Pembayaran::where('tanggal', $dateFilter)
                ->whereMonth('tanggal', $monthFilter)
                ->whereYear('tanggal', $yearFilter)
                ->get();

            $pengeluaran = Pengeluaran::where('tanggal', $dateFilter)
                ->whereMonth('tanggal', $monthFilter)
                ->whereYear('tanggal', $yearFilter)
                ->get();
        } else {
            $pemasukan = Pembayaran::all();
            $pengeluaran = Pengeluaran::all();
        }

        return view('pages.index', compact(
            'pemasukan',
            'pengeluaran',
            'pedagang',
            'admin',
            'dateFilter',
            'monthFilter',
            'yearFilter',
        ));
    }
}
