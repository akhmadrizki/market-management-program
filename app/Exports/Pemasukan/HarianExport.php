<?php

namespace App\Exports\Pemasukan;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HarianExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $filter = $this->request;

        if ($filter->has('pemasukan')) {
            $pemasukans = Pembayaran::where('tanggal', $filter->pemasukan)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        } else {
            $pemasukans = Pembayaran::whereDate('tanggal', Carbon::today())
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();
        }

        return view('exports.pemasukan.harian', [
            'filter' => $filter,
            'pemasukans' => $pemasukans,
        ]);
    }
}
