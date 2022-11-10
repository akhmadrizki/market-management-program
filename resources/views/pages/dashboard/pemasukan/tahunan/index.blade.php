@extends('layouts.dashboard')
@section('title')
Pemasukan Tahunan
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Pemasukan Tahunan</h3>
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
                            <h4>Data Pembayaran</h4>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-sm btn-success" style="float: right">
                                <span>Unduh Laporan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Pedagang</th>
                                <th>Jenis</th>
                                <th>Nomor Toko</th>
                                <th>Jenis Kontrak</th>
                                <th>Biaya Sewa</th>
                                <th>Tanggal</th>
                                <th>Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasukans as $pemasukan)
                            <tr>
                                <td>{{ $pemasukan->kontrak->penyewa->name }}</td>
                                <td>{{ $pemasukan->kontrak->jenisToko->name }}</td>
                                <td>{{ $pemasukan->kontrak->no_toko }}</td>
                                <td>{{ $pemasukan->kontrak->jenis_kontrak }}</td>
                                <td>Rp{{ number_format($pemasukan->biaya_sewa, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($pemasukan->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $pemasukan->user->name }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Total Pemasukan</th>
                                @php
                                $uangMasuk = $pemasukans->sum('biaya_sewa');
                                @endphp
                                <th colspan="6" style="text-align: right">
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