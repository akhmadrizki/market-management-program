@extends('layouts.dashboard')
@section('title')
Pemasukan Bulanan
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Pemasukan Bulanan</h3>
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
                        <div class="row">
                            <div class="col-6">
                                <select name="month" class="form-select mb-4">
                                    <option value="none" {{ request()->query('month') == '' ? 'selected' : '' }}
                                        disabled>
                                        - Pilih Bulan -
                                    </option>
                                    <option value="01" {{ request()->query('month') == '01' ? 'selected' : '' }}>
                                        Januari
                                    </option>
                                    <option value="02" {{ request()->query('month') == '02' ? 'selected' : '' }}>
                                        Februari
                                    </option>
                                    <option value="03" {{ request()->query('month') == '03' ? 'selected' : '' }}>Maret
                                    </option>
                                    <option value="04" {{ request()->query('month') == '04' ? 'selected' : '' }}>April
                                    </option>
                                    <option value="05" {{ request()->query('month') == '05' ? 'selected' : '' }}>Mei
                                    </option>
                                    <option value="06" {{ request()->query('month') == '06' ? 'selected' : '' }}>Juni
                                    </option>
                                    <option value="07" {{ request()->query('month') == '07' ? 'selected' : '' }}>Juli
                                    </option>
                                    <option value="08" {{ request()->query('month') == '08' ? 'selected' : '' }}>
                                        Agustus
                                    </option>
                                    <option value="09" {{ request()->query('month') == '09' ? 'selected' : '' }}>
                                        September
                                    </option>
                                    <option value="10" {{ request()->query('month') == '10' ? 'selected' : '' }}>
                                        Oktober
                                    </option>
                                    <option value="11" {{ request()->query('month') == '11' ? 'selected' : '' }}>
                                        November
                                    </option>
                                    <option value="12" {{ request()->query('month') == '12' ? 'selected' : '' }}>
                                        Desember
                                    </option>
                                </select>
                            </div>

                            <div class="col-6">
                                <input type="text" name="year" class="form-control" placeholder="Tahun. Contoh: 2022" value="{{ request()->query('year') }}">
                            </div>
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
                            <h4>Data Pembayaran</h4>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('laporan-saldo.bulanan', $request->query()) }}"
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
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Operator</th>
                                <th>Pemasukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($final as $keuangan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($keuangan->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $keuangan->keterangan }}</td>
                                <td>{{ $keuangan->operator }}</td>
                                <td>Rp{{ number_format($keuangan->pemasukan, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Total Pemasukan</th>
                                <th colspan="4" style="text-align: right">
                                    Rp{{ number_format($uangMasuk, 0, ',', '.') }}
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
