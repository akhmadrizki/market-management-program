<?php

namespace App\Exports\Pemasukan;

use App\Models\Pembayaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllExport implements FromView
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $pemasukans = Pembayaran::with('user', 'kontrak.penyewa', 'kontrak.jenisToko')->get();

        return view('exports.pemasukan.all', [
            'pemasukans' => $pemasukans,
        ]);
    }
}
