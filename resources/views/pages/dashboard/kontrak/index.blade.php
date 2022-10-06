@extends('layouts.dashboard')
@section('title')
Data Kontrak
@endsection

@section('content')
<div class="page-heading">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <h3>Data Kontrak Pasar</h3>
    </div>
  </div>
</div>

<section class="section">
  <div class="card">
    <div class="card-header">
      <a href="{{ route('kontrak.cerate') }}" class="btn btn-sm btn-primary">
        <span>Buat Kontrak Baru</span>
      </a>
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
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Nurhadi Cahyono</td>
            <td>Pasar Senggol</td>
            <td>3</td>
            <td>Bulanan</td>
            <td>Rp300.000</td>
            <td>
              <span class="badge bg-info">Active</span>
            </td>
            <td>
              <a href="#" class="btn btn-sm btn-success" title="Detail Pembayaran"><i class="bi bi-eye-fill"></i></a>
              <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
              <a href="#" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash3-fill"></i></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</section>
@endsection