<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Support\Facades\Auth;
use App\Models\Kontrak;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use Carbon\Carbon;
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

    public function edit($pembayaran)
    {
        $kontraks  = Pembayaran::where('id', $pembayaran)->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')->firstOrFail();

        $penyewa   = $kontraks->kontrak->penyewa->id;
        $jenisToko = Kontrak::where('id_penyewa', $penyewa)->with('jenisToko')->get();

        return view('pages.dashboard.pembayaran.edit', compact('kontraks', 'jenisToko'));
    }

    public function update(Request $request, $pembayaran)
    {
        DB::beginTransaction();

        try {
            $pembayarans  = Pembayaran::with('kontrak.penyewa', 'kontrak.jenisToko')->where('id', $pembayaran)->first();
            $kontrak      = Kontrak::where('id', $pembayarans->kontrak_id)->first();
            $keuangan     = Keuangan::where('pembayaran_id', $pembayaran)->first();

            if ($pembayarans->tunggakan === $request->tunggakan) {
                $reset = $pembayarans->tunggakan - ($request->dibayarkan - $pembayarans->dibayarkan);
            } else {
                $reset = $request->tunggakan;
            }

            $updateTunggakan = [
                'tunggakan' => $reset,
            ];

            $kontrak->update($updateTunggakan);

            $fields = [
                'kontrak_id' => $pembayarans->kontrak_id,
                'tanggal'    => $request->tanggal,
                'biaya_sewa' => $request->biaya_sewa,
                'dibayarkan' => $request->dibayarkan,
                'tunggakan'  => $kontrak->tunggakan,
            ];

            $pembayarans->update($fields);

            $description = 'Pembayaran kios ' . $pembayarans->kontrak->jenisToko->name . ' ' . $pembayarans->kontrak->penyewa->name . ' ' . 'No. ' . $pembayarans->kontrak->no_toko;

            $fieldsKeuangan = [
                'tanggal' => $request->tanggal,
                'keterangan' => $description,
                'pemasukan' => $request->dibayarkan,
            ];

            $keuangan->update($fieldsKeuangan);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('pembayaran.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pembayaran.index')->with([
            'message' => 'Pembayaran berhasil diupdate',
            'status'  => 'success',
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $getDataKontrak = Kontrak::where('id_penyewa', $request->id_penyewa)
                ->where('id_jenis_toko', $request->id_jenis_toko)
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

            $getYearAndMonthOfContract = Carbon::parse($getDataKontrak->tanggal)->format('Ym');
            $getYearAndMonthOfPayment  = Carbon::parse($request->tanggal)->format('Ym');

            $getMonthOfContract = Carbon::parse($getDataKontrak->tanggal)->format('mY');
            $getMonthOfPayment  = Carbon::parse($request->tanggal)->format('mY');

            if ($getYearAndMonthOfPayment < $getYearAndMonthOfContract || $getMonthOfPayment < $getMonthOfContract) {

                $updateTunggakan = [
                    'tunggakan' => $getDataKontrak->tunggakan - $request->dibayarkan,
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

            $pemasukan = Pembayaran::create($fields);

            $getData = Pembayaran::with('kontrak.penyewa', 'kontrak.jenisToko')
                ->where('id', $pemasukan->id)
                ->first();

            $description = 'Pembayaran kios ' . $getData->kontrak->jenisToko->name . ' ' . $getData->kontrak->penyewa->name . ' ' . 'No. ' . $getData->kontrak->no_toko;

            $fieldKeuangans = [
                'tanggal'       => $request->tanggal,
                'keterangan'    => $description,
                'user_id'       => Auth::user()->id,
                'pemasukan'     => $request->dibayarkan,
                'pembayaran_id' => $pemasukan->id,
            ];

            Keuangan::create($fieldKeuangans);

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

    public function destroy($pembayaran)
    {
        DB::beginTransaction();

        try {
            $pembayaran = Pembayaran::where('id', $pembayaran->id)->first();

            $kontrak = Kontrak::where('id', $pembayaran->kontrak_id)->first();
            $reset   = $pembayaran->tunggakan + ($pembayaran->dibayarkan - $pembayaran->biaya_sewa);

            $keuangan = Keuangan::where('pembayaran_id', $pembayaran->id)->first();

            $updateTunggakan = [
                'tunggakan' => $reset,
            ];

            $kontrak->update($updateTunggakan);

            $keuangan->delete();
            $pembayaran->delete();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('pembayaran.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pembayaran.index')->with([
            'message' => 'Pembayaran berhasil dihapus',
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
