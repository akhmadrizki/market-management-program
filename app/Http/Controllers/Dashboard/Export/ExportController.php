<?php

namespace App\Http\Controllers\Dashboard\Export;

use App\Exports\Pemasukan\AllExport;
use App\Exports\Pengeluaran\AllExport as PengeluaranAllExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function pemasukan(Request $request)
    {
        $formatFile = 'xlsx';
        $fileName   = 'Laporan Seluruh Pemasukan' . '.' . $formatFile;

        return Excel::download(new AllExport($request), $fileName);
    }

    public function pengeluaran(Request $request)
    {
        $formatFile = 'xlsx';
        $fileName   = 'Laporan Seluruh Pengeluaran' . '.' . $formatFile;

        return Excel::download(new PengeluaranAllExport($request), $fileName);
    }
}
