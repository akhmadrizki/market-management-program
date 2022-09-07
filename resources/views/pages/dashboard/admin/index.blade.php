@extends('layouts.dashboard')
@section('title')
Data Admin
@endsection

@section('content')
<div class="page-heading">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <h3>Data Admin</h3>
    </div>
  </div>
</div>

<section class="section">
  {{-- @if (session('message'))
  <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif --}}

  <div class="card">
    <div class="card-header">
      <a href="{{ route('admin-data.create') }}" class="btn btn-sm btn-primary">
        <span>Tambah Data Admin</span>
      </a>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Tlpn</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($datas as $data)
          <tr>
            <td>{{ $data->name }}</td>
            <td>{{ $data->address }}</td>
            <td>{{ $data->contact }}</td>
            <td>
            <td>
              <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
              <a href="#" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash3-fill"></i></i></a>
            </td>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</section>
@endsection

@section('js')
<script>
  @if(Session::has('message'))
  Toastify({
        text: `{{ session('message') }}`,
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        positionLeft: false, // `true` or `false`
        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
        }).showToast();
  @endif
</script>
@endsection