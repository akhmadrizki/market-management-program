<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penyewa\StoreRequest;
use App\Http\Requests\Penyewa\UpdateRequest;
use App\Models\Penyewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyewas = Penyewa::all();
        return view('pages.dashboard.pedagang.index', compact('penyewas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.pedagang.create');
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
            $pedagang = new Penyewa($request->validated());
            $pedagang->save();

            DB::commit();

            return redirect()->route('pedagang.index')->with([
                'message' => 'Data pedagang berhasil ditambahkan',
                'status'  => 'success',
            ]);
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('pedagang.create')->with('message', $error->getMessage());
        }
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
    public function edit(Penyewa $pedagang)
    {
        return view('pages.dashboard.pedagang.edit', compact('pedagang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Penyewa $pedagang)
    {
        DB::beginTransaction();

        try {
            $validated = $request->only(['contact', 'address', 'name']);

            if ($validated['name'] != $pedagang->name) {
                $this->validate(
                    $request,
                    ['name' => 'required|min:3|unique:penyewas'],
                    ['name.unique' => 'Data pedagang sudah ada']
                );

                $name = $request->name;
            } else {
                $name = $validated['name'];
            }

            $fields = [
                'name'     => $name,
                'contact'  => $validated['contact'],
                'address'  => $validated['address'],
            ];

            $pedagang->update($fields);

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('pedagang.index')->with('message', $error->getMessage());
        }

        return redirect()->route('pedagang.index')->with([
            'message' => 'Data pedagang berhasil diubah',
            'status'  => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyewa $pedagang)
    {
        DB::beginTransaction();

        try {
            $pedagang->delete();

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('pedagang.index', $pedagang->id)->with('message', $error->getMessage());
        }

        return redirect()->route('pedagang.index')->with([
            'message' => 'Data pedagang berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
