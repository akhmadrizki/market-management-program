<?php

namespace App\Exports\Pemasukan;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TahunanExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $filter = $this->request;

        if ($filter->has('year')) {
            $pemasukans = Pembayaran::whereYear('tanggal', $filter->year)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();

            $yearly = $filter->year;
        } else {
            $pemasukans = Pembayaran::whereYear('tanggal', Carbon::now()->year)
                ->with('user', 'kontrak.penyewa', 'kontrak.jenisToko')
                ->get();

            $yearly = Carbon::now()->year;
        }

        return view('exports.pemasukan.tahunan', [
            'yearly'     => $yearly,
            'pemasukans' => $pemasukans,
        ]);
    }
}
