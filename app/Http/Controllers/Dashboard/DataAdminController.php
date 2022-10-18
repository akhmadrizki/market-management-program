<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = User::where('role_id', '=', 2)->latest()->get();

        return view('pages.dashboard.admin.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request)
    {
        try {
            $validated = $request->safe()->only(['contact', 'username']);

            $fields = [
                'username' => strtolower($validated['username']),
                'name'     => $request->name,
                'contact'  => $validated['contact'],
                'address'  => $request->address,
                'role_id'  => 2,
                'password' => Hash::make('admin123#')
            ];

            User::create($fields);

            return redirect()->route('admin-data.index')->with([
                'message' => 'Data admin berhasil ditambahkan',
                'status'  => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('admin-data.create')->with('message', $error->getMessage());
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
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('pages.dashboard.admin.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        try {
            $data = User::findOrFail($id);
            $validated = $request->safe()->only(['contact', 'username']);

            if ($validated['username'] != $data->username) {
                $this->validate(
                    $request,
                    ['username' => 'required|string|min:4|max:20|unique:users'],
                    ['username.unique' => 'Username sudah terdaftar, mohon gunakan username lain']
                );

                $username = $request->username;
            } else {
                $username = $validated['username'];
            }

            $fields = [
                'username' => strtolower($username),
                'name'     => $request->name,
                'contact'  => $validated['contact'],
                'address'  => $request->address
            ];

            $data->update($fields);

            return redirect()->route('admin-data.index')->with([
                'message' => 'Data admin berhasil diubah',
                'status'  => 'success',
            ]);
        } catch (Exception $error) {
            return redirect()->route('admin-data.index')->with('message', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $data = User::findOrFail($id);

            $data->delete();

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->route('admin-data.index')->with('message', $error->getMessage());
        }

        return redirect()->route('admin-data.index')->with([
            'message' => 'Data admin berhasil dihapus',
            'status'  => 'success',
        ]);
    }
}
