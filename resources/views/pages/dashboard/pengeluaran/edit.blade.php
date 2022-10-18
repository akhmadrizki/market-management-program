@extends('layouts.dashboard')
@section('title')
Edit Pengeluaran Pasar
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ubah Pengeluaran Pasar</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">

        <div class="card-body">
            <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST" class="form form-vertical">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc">Keterangan</label>
                                <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc"
                                    name="desc" value="{{ $pengeluaran->desc }}" autofocus required>

                                @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" class="form-control @error('total') is-invalid @enderror"
                                    id="total" name="total" value="{{ $pengeluaran->total }}" required>

                                @error('total')
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
                                    id="tanggal" name="tanggal" value="{{ $pengeluaran->tanggal }}" required>

                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                            <a href="{{ route('pengeluaran.index') }}" type="button"
                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection