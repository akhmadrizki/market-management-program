@extends('layouts.dashboard')
@section('title')
Riwayat Pembayaran
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3 class="text-capitalize">Riwayat Pembayaran, {{ $dataKontrak->penyewa->name }}</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="text-capitalize">
                        Jenis <span class="text-info">{{ $dataKontrak->jenisToko->name }}</span>,
                        No. <span class="text-info">{{ $dataKontrak->no_toko}}</span>,
                        Tipe Bayar <span class="text-info">{{ $dataKontrak->jenis_kontrak }}</span>
                    </h5>
                </div>
                <div class="col-6">
                    <a href="{{ route('kontrak.index') }}" class="btn btn-sm btn-success" style="float: right">
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Biaya Sewa</th>
                        <th>Status</th>
                        <th>Tanggal Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getHistories as $history)
                    <tr>
                        <td>Rp{{ number_format($history->biaya_sewa, 0, ',', '.') }}</td>
                        <td><span class="badge bg-info">Lunas</span></td>
                        <td>{{ \Carbon\Carbon::parse($history->tanggal)->translatedFormat('d F Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection