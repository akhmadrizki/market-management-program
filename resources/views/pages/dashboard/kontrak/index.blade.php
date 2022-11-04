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
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($contracts as $contract)
          <tr>
            <td>{{ $contract->penyewa->name }}</td>
            <td>{{ $contract->jenisToko->name }}</td>
            <td>{{ $contract->no_toko }}</td>
            <td>{{ $contract->jenis_kontrak }}</td>
            <td>Rp{{ number_format($contract->biaya_sewa, 0, ',', '.') }}</td>
            <td>
              <span class="badge bg-info">Active</span>
            </td>
            <td>
              <a href="{{ route('kontrak.edit', $contract->id) }}" class="btn btn-sm btn-warning" title="Edit"><i
                  class="bi bi-pencil-square"></i></a>

              <button type="button" class="btn btn-sm btn-danger block" data-bs-toggle="modal"
                data-bs-target="#delete-{{ $contract->id }}">
                <i class="bi bi-trash3-fill"></i>
              </button>
            </td>
            <td>
              <a href="{{ route('riwayat.pembayaran', $contract->id) }}" class="btn btn-sm btn-success"
                title="Detail Pembayaran">Riwayat Pembayaran</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</section>
@endsection

@section('modal')
@foreach ($contracts as $contract)
<div class="modal fade text-left" id="delete-{{ $contract->id }}" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel4">Hapus Kontrak {{ $contract->penyewa->name }}</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus kontrak <b>toko nomor {{ $contract->no_toko }} ?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>

        <form action="{{ route('kontrak.destroy', $contract->id) }}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Delete</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
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
            backgroundColor: `{{ 
                    session('status') == 'success' ? 'linear-gradient(to right, #00b09b, #96c93d)' : 'linear-gradient(to right, #FF5F6D, #FFC371)' 
                }}`,
            }).showToast();
    @endif
</script>
@endsection