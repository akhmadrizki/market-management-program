<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pengeluaran\StoreRequest;
use App\Http\Requests\Pengeluaran\UpdateRequest;
use App\Models\Pengeluaran;
use Exception;
use Illuminate\Http\Request;
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
        $pengeluarans = Pengeluaran::all();

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
            $pengeluaran->save();

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
