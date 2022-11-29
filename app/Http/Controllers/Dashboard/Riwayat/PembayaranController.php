<?php

namespace App\Http\Controllers\Dashboard\Riwayat;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index($id)
    {
        $dataKontrak = Kontrak::with('penyewa', 'jenisToko')->where('id', $id)->first();;

        $getHistories = Pembayaran::where('kontrak_id', $dataKontrak->id)
            ->with('user', 'kontrak')
            ->get();

        return view('pages.dashboard.pembayaran.history', compact('dataKontrak', 'getHistories'));
    }
}
