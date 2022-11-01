@extends('layouts.dashboard')
@section('title')
Pemasukan Harian
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Pemasukan Harian</h3>
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
                                <td>{{ date( 'd/m/Y', strtotime($pemasukan->tanggal)) }}</td>
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