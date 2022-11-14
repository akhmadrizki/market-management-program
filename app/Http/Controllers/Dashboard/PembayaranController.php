<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kontrak;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::all();

        $kontraks = Pembayaran::with('user', 'kontrak.penyewa', 'kontrak.jenisToko')->get();

        return view('pages.dashboard.pembayaran.index', compact('penyewas', 'kontraks'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $getDataKontrak = Kontrak::where('id_penyewa', $request->id_penyewa)
                ->where('id_jenis_toko', $request->id_jenis_toko)
                ->where('no_toko', $request->no_toko)
                ->first();

            if ($request->dibayarkan < $getDataKontrak->biaya_sewa) {
                $bayarKontrak = $getDataKontrak->biaya_sewa - $request->dibayarkan;

                $updateTunggakan = [
                    'tunggakan' => $getDataKontrak->tunggakan + $bayarKontrak,
                ];

                $getDataKontrak->update($updateTunggakan);
            }

            if ($getDataKontrak->tunggakan != 0 && $request->dibayarkan > $getDataKontrak->biaya_sewa) {

                $bayarKontrak = $request->dibayarkan - $getDataKontrak->biaya_sewa;

                $updateTunggakan = [
                    'tunggakan' => $getDataKontrak->tunggakan - $bayarKontrak,
                ];

                $getDataKontrak->update($updateTunggakan);
            }

            $fields = [
                'kontrak_id' => $getDataKontrak->id,
                'tanggal'    => $request->tanggal,
                'biaya_sewa' => $getDataKontrak->biaya_sewa,
                'dibayarkan' => $request->dibayarkan,
                'tunggakan'  => $getDataKontrak->tunggakan,
                'user_id'    => Auth::user()->id,
            ];

            Pembayaran::create($fields);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('pembayaran.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pembayaran.index')->with([
            'message' => 'Pembayaran berhasil ditambahkan',
            'status'  => 'success',
        ]);
    }

    public function fetch($id)
    {
        $kontrak = Kontrak::where('id_penyewa', $id)
            ->with('penyewa', 'jenisToko')
            ->get();

        return response()->json($kontrak);
    }
}
