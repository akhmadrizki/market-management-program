@extends('layouts.dashboard')
@section('title')
Laporan Keuangan Harian
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Laporan Keuangan Harian</h3>
        </div>

        <div class="col-6 col-md-6">
            <a href="{{ route('dashboard') }}" style="float: right" type="button"
                class="btn btn-outline-primary me-1 mb-1">&larr; Kembali</a>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        <label for="email-id-icon">Harian</label>
                        <input name="pengeluaran"
                            value="{{ request()->query('pengeluaran') == '' ? date('Y-m-d') : request()->query('pengeluaran') }}"
                            type="date" class="form-control mb-3">

                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4>Data Keuangan</h4>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('laporan.pemasukan') }}" class="btn btn-sm btn-secondary"
                                style="float: right">
                                <span>Unduh Seluruh Laporan Bulanan</span>
                            </a>

                            <a href="{{ route('laporan-pemasukan.bulanan', $request->query()) }}"
                                class="btn btn-sm btn-success" style="float: right; margin-right: 8px">
                                <span>Unduh Laporan Bulanan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Operator</th>
                                <th style="background-color: #baf7b1;">Pemasukan</th>
                                <th style="background-color: #dc354561">Pengeluaran</th>
                                <th style="background-color: #435ebe69">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($final as $keuangan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($keuangan->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $keuangan->keterangan }}</td>
                                <td>{{ $keuangan->operator }}</td>
                                <td class="text-success" style="background-color: #baf7b1">
                                    Rp{{number_format($keuangan->pemasukan, 0, ',', '.') }}
                                </td>
                                <td class="text-danger" style="background-color: #dc354561">
                                    Rp{{ number_format($keuangan->pengeluaran, 0, ',', '.') }}
                                </td>
                                <td style="background-color: #435ebe69">
                                    Rp{{ number_format($keuangan->saldo, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="4" class="text-success">Total</th>
                                <th class="text-success" style="background-color: #baf7b1">
                                    Rp{{ number_format($uangMasuk, 0, ',', '.') }}
                                </th>
                                <th class="text-danger" style="background-color: #dc354561">
                                    Rp{{ number_format($uangKeluar, 0, ',', '.') }}
                                </th>
                                <th class="text-dark" style="background-color: #435ebe69">
                                    @if (!$totalSaldo)
                                    Rp0
                                    @else
                                    Rp{{ number_format($totalSaldo, 0, ',', '.') }}
                                    @endif
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection