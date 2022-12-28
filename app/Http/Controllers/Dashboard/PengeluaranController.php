<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pengeluaran\StoreRequest;
use App\Http\Requests\Pengeluaran\UpdateRequest;
use App\Models\Keuangan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal', 'asc')->get();

        return view('pages.dashboard.pengeluaran.index', compact('pengeluarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.pengeluaran.create');
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
            $pengeluaran = new Pengeluaran($request->validated());
            $pengeluaran->user_id = Auth::user()->id;

            $pengeluaran->save();

            $fields = [
                'tanggal'        => $pengeluaran->tanggal,
                'keterangan'     => $pengeluaran->desc,
                'user_id'        => Auth::user()->id,
                'pengeluaran'    => $pengeluaran->total,
                'pengeluaran_id' => $pengeluaran->id,
            ];

            Keuangan::create($fields);

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('pengeluaran.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pengeluaran.index')->with([
            'message' => 'Data pengeluaran berhasil ditambahkan',
            'status'  => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        return view('pages.dashboard.pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Pengeluaran $pengeluaran)
    {
        DB::beginTransaction();

        try {
            $pengeluaran->update($request->validated());

            $keuangan = Keuangan::where('pengeluaran_id', $pengeluaran->id)->first();

            $fields = [
                'tanggal'        => $pengeluaran->tanggal,
                'keterangan'     => $pengeluaran->desc,
                'pengeluaran'    => $pengeluaran->total,
            ];

            $keuangan->update($fields);

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('pengeluaran.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pengeluaran.index')->with([
            'message' => 'Data pengeluaran berhasil diubah',
            'status'  => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        DB::beginTransaction();

        try {
            $keuangan = Keuangan::where('pengeluaran_id', $pengeluaran->id)->first();
            $keuangan->delete();

            $pengeluaran->delete();

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('pengeluaran.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pengeluaran.index')->with([
            'message' => 'Data pengeluaran berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
