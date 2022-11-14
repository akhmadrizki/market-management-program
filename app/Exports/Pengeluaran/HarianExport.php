<?php

namespace App\Exports\Pengeluaran;

use App\Models\Pengeluaran;
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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(): View
    {
        $filter = $this->request;

        if ($filter->has('pengeluaran')) {
            $pengeluarans = Pengeluaran::whereDate('tanggal', $filter->pengeluaran)
                ->with('user')
                ->get();

            $daily = Carbon::parse($filter->pengeluaran)->translatedFormat('l d F Y');
        } else {
            $pengeluarans = Pengeluaran::whereDate('tanggal', Carbon::today())
                ->with('user')
                ->get();

            $daily = Carbon::now()->translatedFormat('l d F Y');
        }

        return view('exports.pengeluaran.harian', [
            'daily'        => $daily,
            'pengeluarans' => $pengeluarans,
        ]);
    }
}
