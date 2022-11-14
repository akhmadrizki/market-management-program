<?php

namespace App\Exports\Pengeluaran;

use App\Models\Pengeluaran;
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
            $pengeluarans = Pengeluaran::whereYear('tanggal', $filter->year)
                ->with('user')
                ->get();

            $yearly = $filter->year;
        } else {
            $pengeluarans = Pengeluaran::whereYear('tanggal', Carbon::now()->year)
                ->with('user')
                ->get();

            $yearly = Carbon::now()->year;
        }

        return view('exports.pengeluaran.tahunan', [
            'yearly'       => $yearly,
            'pengeluarans' => $pengeluarans,
        ]);
    }
}
