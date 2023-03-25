<?php

namespace App\Exports\Laporan;

use App\Models\Keuangan;
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

        $keuangans = Keuangan::with('user')
            ->orderBy('tanggal', 'asc');
        if ($filter->has('saldo')) {
            $keuangans = $keuangans->whereDate('tanggal', $filter->saldo);

            $daily = Carbon::parse($filter->saldo)->translatedFormat('l d F Y');
        } else {
            $keuangans = $keuangans->whereDate('tanggal', Carbon::today());

            $daily = Carbon::now()->translatedFormat('l d F Y');
        }

        $keuangans = $keuangans->get();

        $saldoTest = 0;

        $final = [];

        foreach ($keuangans as $key) {
            $a = $key->pemasukan;
            $b = $key->pengeluaran;

            if ($key->pengeluaran_id == null) {
                $saldoTest = $saldoTest + $key->pemasukan;
            } else {
                $saldoTest = $saldoTest - $key->pengeluaran;
            }

            $final[] = (object) [
                'keterangan' => $key->keterangan,
                'tanggal' => $key->tanggal,
                'operator' => $key->user->name,
                'pemasukan' => $key->pemasukan,
                'pengeluaran' => $key->pengeluaran,
                'saldo' => $saldoTest,
            ];
        }

        $uangmasuk  = $keuangans->sum('pemasukan');
        $uangkeluar = $keuangans->sum('pengeluaran');
        $totalsaldo = $uangmasuk - $uangkeluar;

        return view('exports.laporan.harian', [
            'daily'      => $daily,
            'uangmasuk'  => $uangmasuk,
            'uangkeluar' => $uangkeluar,
            'totalsaldo' => $totalsaldo,
            'final'      => $final,
        ]);
    }
}
