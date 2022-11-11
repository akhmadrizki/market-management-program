@extends('layouts.dashboard')
@section('title')
Pemasukan Harian
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-6 col-md-6">
            <h3>Pemasukan Harian</h3>
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
                        <input name="pemasukan" type="date" class="form-control mb-3">

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
                            <a href="{{ route('laporan-pemasukan.harian', $request->query()) }}"
                                class="btn btn-sm btn-success" style="float: right">
                                <span>Unduh Laporan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Penyewa</th>
                                <th>Jenis</th>
                                <th>Nomor</th>
                                <th>Jenis Sewa</th>
                                <th>Biaya Sewa</th>
                                <th>Dibayarkan</th>
                                <th>Tanggal</th>
                                <th>Operator</th>
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
                                <td>Rp{{ number_format($pemasukan->dibayarkan, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($pemasukan->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $pemasukan->user->name }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Total Pemasukan</th>
                                @php
                                $uangMasuk = $pemasukans->sum('dibayarkan');
                                @endphp
                                <th colspan="7" style="text-align: right">
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