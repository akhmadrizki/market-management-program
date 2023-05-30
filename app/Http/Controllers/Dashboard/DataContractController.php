<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kontrak\StoreRequest;
use App\Http\Requests\Kontrak\UpdateRequest;
use App\Models\JenisToko;
use App\Models\Kontrak;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataContractController extends Controller
{
    public function index()
    {
        $contracts = Kontrak::with('penyewa', 'jenisToko')->latest()->get();

        return view('pages.dashboard.kontrak.index', compact('contracts'));
    }

    public function create()
    {
        $pedagangs   = Penyewa::all();
        $jenisPasars = JenisToko::all();

        return view('pages.dashboard.kontrak.create', compact('pedagangs', 'jenisPasars'));
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $kontrak = new Kontrak($request->safe(['id_penyewa', 'id_jenis_toko', 'jenis_kontrak', 'tanggal', 'biaya_sewa', 'tunggakan', 'no_toko']));

            $kontrak->no_toko = $request->no_toko ?? 0;

            $kontrak->save();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('kontrak.index')->with('message', $error->getMessage());
        }

        return redirect()->route('kontrak.index')->with([
            'message' => 'Data kontrak berhasil ditambahkan',
            'status'  => 'success',
        ]);
    }

    public function edit(Kontrak $data_kontrak)
    {
        $pedagangs   = Penyewa::all();
        $jenisPasars = JenisToko::all();

        return view('pages.dashboard.kontrak.edit', compact('data_kontrak', 'jenisPasars', 'pedagangs'));
    }

    public function update(UpdateRequest $request, Kontrak $data_kontrak)
    {
        DB::beginTransaction();

        try {

            $data_kontrak->fill($request->safe(['id_jenis_toko', 'jenis_kontrak', 'tanggal', 'biaya_sewa', 'tunggakan', 'no_toko']));

            $data_kontrak->id_penyewa = $data_kontrak->id_penyewa;

            $data_kontrak->save();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('kontrak.index')->with('message', $error->getMessage());
        }

        return redirect()->route('kontrak.index')->with([
            'message' => 'Data kontrak berhasil diupdate',
            'status'  => 'success',
        ]);
    }

    public function destroy(Kontrak $data_kontrak)
    {
        DB::beginTransaction();

        try {
            $data_kontrak->delete();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('kontrak.index')->with('message', $error->getMessage());
        }

        return redirect()->route('kontrak.index')->with([
            'message' => 'Data kontrak berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
