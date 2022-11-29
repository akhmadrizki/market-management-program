<?php

namespace App\Exports\Pengeluaran;

use App\Models\Pengeluaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllExport implements FromView
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $pengeluarans = Pengeluaran::with('user')->get();

        return view('exports.pengeluaran.all', [
            'pengeluarans' => $pengeluarans,
        ]);
    }
}
