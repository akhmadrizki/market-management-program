<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $password
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(User $user)
    {
        return view('pages.dashboard.password.index', compact('user'));
    }

    public function update(PasswordRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $validated = $request->safe()->only(['password']);

            $field = [
                'password' => Hash::make($validated['password']),
            ];

            $user->update($field);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('dashboard')->with('message', $error->getMessage());
        }

        return redirect()->route('dashboard')->with([
            'message' => 'Password berhasil diubah',
            'status'  => 'success',
        ]);
    }
}
