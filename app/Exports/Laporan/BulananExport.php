<?php

namespace App\Exports\Laporan;

use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BulananExport implements FromView
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
        if ($filter->has('month')) {
            $keuangans = $keuangans->whereMonth('tanggal', $filter->month);
        } else {
            $keuangans = $keuangans->whereMonth('tanggal', Carbon::now()->month);
        }

        if ($filter->has('year')) {
            $keuangans = $keuangans->whereYear('tanggal', $filter->year);
        } else {
            $keuangans = $keuangans->whereYear('tanggal', Carbon::now()->year);
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

        $getMonth = $filter->month;
        $year     = $filter->year;

        if (!empty($getMonth) && !empty($year)) {
            $convertMonth = match ($getMonth) {
                '01' => 'Januari',
                '02' => 'Febuari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            };

            $combined = $convertMonth . ' ' . $year;
        } else {
            $combined = Carbon::now()->translatedFormat('F Y');
        }

        $uangmasuk  = $keuangans->sum('pemasukan');
        $uangkeluar = $keuangans->sum('pengeluaran');
        $totalsaldo = $uangmasuk - $uangkeluar;

        return view('exports.laporan.bulanan', [
            'combined'   => $combined,
            'uangmasuk'  => $uangmasuk,
            'uangkeluar' => $uangkeluar,
            'totalsaldo' => $totalsaldo,
            'final'      => $final,
        ]);
    }
}
