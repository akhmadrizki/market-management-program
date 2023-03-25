<?php

namespace App\Exports\Laporan;

use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class TahunanExport implements FromView
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

        $keuangans = Keuangan::with('user')
            ->groupByRaw('month(tanggal)')
            ->select([
                DB::raw('max(user_id) as user_id'),
                DB::raw('month(tanggal) as tanggal'),
                DB::raw('SUM(pemasukan) as pemasukan'),
                DB::raw('SUM(pengeluaran) as pengeluaran')
            ])
            ->orderBy('tanggal', 'asc');

        if ($filter->has('year')) {
            $keuangans = $keuangans->whereYear('tanggal', $filter->year);

            $yearly = $filter->year;
        } else {
            $keuangans = $keuangans->whereYear('tanggal', Carbon::now()->year);

            $yearly = Carbon::now()->year;
        }

        $keuangans = $keuangans->get();

        $saldoTest = 0;

        $final = [];

        foreach ($keuangans as $key) {
            $a = $key->pemasukan;
            $b = $key->pengeluaran;


            $saldoTest = $saldoTest + ($key->pemasukan - $key->pengeluaran);

            $final[] = (object) [
                'tanggal' => Carbon::createFromFormat('m', $key->tanggal)->translatedFormat('F'),
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'pengeluaran' => $key->pengeluaran,
                'saldo' => $saldoTest,
            ];
        }

        $uangmasuk  = $keuangans->sum('pemasukan');
        $uangkeluar = $keuangans->sum('pengeluaran');
        $totalsaldo = $uangmasuk - $uangkeluar;

        return view('exports.laporan.tahunan', [
            'yearly'     => $yearly,
            'uangmasuk'  => $uangmasuk,
            'uangkeluar' => $uangkeluar,
            'totalsaldo' => $totalsaldo,
            'final'      => $final,
        ]);
    }
}
