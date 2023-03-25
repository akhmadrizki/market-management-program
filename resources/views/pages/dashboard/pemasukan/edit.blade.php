@extends('layouts.dashboard')
@section('title')
Edit Pemasukan Pasar
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ubah Pemasukan Pasar</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">

        <div class="card-body">
            <form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST" class="form form-vertical">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi">Keterangan</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi" name="deskripsi" value="{{ $pemasukan->deskripsi }}" autofocus
                                    required>

                                @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">Total</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                    id="jumlah" name="jumlah" value="{{ $pemasukan->jumlah }}" required>

                                @error('jumlah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal" value="{{ $pemasukan->tanggal }}" required>

                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                            <a href="{{ route('pemasukan.index') }}" type="button"
                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection