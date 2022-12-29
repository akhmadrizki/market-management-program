@extends('layouts.dashboard')
@section('title')
Laporan Keuangan Tahunan
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Laporan Keuangan Tahunan</h3>
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
                        <div class="col-12 mb-3">
                            <select name="year" class="form-select mb-4">
                                <option value="none" {{ request()->query('year') == '' ? 'selected' : '' }}
                                    disabled>
                                    - Pilih Tahun -
                                </option>
                                <option value="2022" {{ request()->query('year') == '2022' ? 'selected' : '' }}>
                                    2022
                                </option>
                                <option value="2023" {{ request()->query('year') == '2023' ? 'selected' : '' }}>
                                    2023
                                </option>
                                <option value="2024" {{ request()->query('year') == '2024' ? 'selected' : '' }}>
                                    2024
                                </option>
                                <option value="2025" {{ request()->query('year') == '2025' ? 'selected' : '' }}>
                                    2025
                                </option>
                                <option value="2026" {{ request()->query('year') == '2026' ? 'selected' : '' }}>
                                    2026
                                </option>
                                <option value="2027" {{ request()->query('year') == '2027' ? 'selected' : '' }}>
                                    2027
                                </option>
                                <option value="2028" {{ request()->query('year') == '2028' ? 'selected' : '' }}>
                                    2028
                                </option>
                                <option value="2029" {{ request()->query('year') == '2029' ? 'selected' : '' }}>
                                    2029
                                </option>
                                <option value="2030" {{ request()->query('year') == '2030' ? 'selected' : '' }}>
                                    2030
                                </option>
                                <option value="2031" {{ request()->query('year') == '2031' ? 'selected' : '' }}>
                                    2031
                                </option>
                                <option value="2032" {{ request()->query('year') == '2032' ? 'selected' : '' }}>
                                    2032
                                </option>
                                <option value="2033" {{ request()->query('year') == '2033' ? 'selected' : '' }}>
                                    2033
                                </option>

                            </select>
                        </div>

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

                            <a href="{{ route('laporan-saldo.tahunan', $request->query()) }}"
                                class="btn btn-sm btn-success" style="float: right; margin-right: 8px">
                                <span>Unduh Laporan Tahunan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th style="background-color: #baf7b1;">Pemasukan</th>
                                <th style="background-color: #dc354561">Pengeluaran</th>
                                <th style="background-color: #435ebe69">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($final as $keuangan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $keuangan->tanggal }}</td>
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
                                <th colspan="2" class="text-success">Total</th>
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