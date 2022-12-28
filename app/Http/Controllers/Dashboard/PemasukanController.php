<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pemasukan\StoreRequest;
use App\Http\Requests\Pemasukan\UpdateRequest;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukans = Pemasukan::orderBy('tanggal', 'asc')->get();
        return view('pages.dashboard.pemasukan.index', compact('pemasukans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $pemasukan = new Pemasukan($request->validated());
            $pemasukan->user_id = Auth::user()->id;

            $pemasukan->save();

            $fields = [
                'tanggal'      => $pemasukan->tanggal,
                'keterangan'   => $pemasukan->deskripsi,
                'user_id'      => $pemasukan->user_id,
                'pemasukan'    => $pemasukan->jumlah,
                'pemasukan_id' => $pemasukan->id,
            ];

            Keuangan::create($fields);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('pemasukan.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pemasukan.index')->with([
            'message' => 'Data pemasukan berhasil ditambahkan',
            'status'  => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $pemasukan)
    {
        return view('pages.dashboard.pemasukan.edit', compact('pemasukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Pemasukan $pemasukan)
    {
        DB::beginTransaction();

        try {
            $pemasukan->update($request->validated());

            $keuangan = Keuangan::where('pemasukan_id', $pemasukan->id)->first();

            $fields = [
                'tanggal'        => $pemasukan->tanggal,
                'keterangan'     => $pemasukan->deskripsi,
                'pemasukan'    => $pemasukan->jumlah,
            ];

            $keuangan->update($fields);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('pemasukan.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pemasukan.index')->with([
            'message' => 'Data pemasukan berhasil diubah',
            'status'  => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasukan $pemasukan)
    {
        DB::beginTransaction();

        try {
            $keuangan = Keuangan::where('pemasukan_id', $pemasukan->id)->first();
            $keuangan->delete();

            $pemasukan->delete();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('pemasukan.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pemasukan.index')->with([
            'message' => 'Data pemasukan berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
