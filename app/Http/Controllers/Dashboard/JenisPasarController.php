<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rukos = JenisToko::all();
        return view('pages.dashboard.toko.index', compact('rukos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.toko.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            JenisToko::create($request->all());

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('jenis-pasar.index')->with('message', $error->getMessage());
        }

        return redirect()->route('jenis-pasar.index')->with([
            'message' => 'Jenis ruko berhasil ditambahkan',
            'status'  => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisToko $jenisPasar)
    {
        // binding value must named based on the resource url
        return view('pages.dashboard.toko.edit', compact('jenisPasar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisToko $jenisPasar)
    {
        DB::beginTransaction();

        try {
            $jenisPasar->update($request->all());

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('jenis-pasar.index')->with('message', $error->getMessage());
        }

        return redirect()->route('jenis-pasar.index')->with([
            'message' => 'Jenis ruko berhasil diubah',
            'status'  => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisToko $jenisPasar)
    {
        DB::beginTransaction();

        try {
            $jenisPasar->delete();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('jenis-pasar.index')->with('message', $error->getMessage());
        }

        return redirect()->route('jenis-pasar.index')->with([
            'message' => 'Jenis ruko berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
