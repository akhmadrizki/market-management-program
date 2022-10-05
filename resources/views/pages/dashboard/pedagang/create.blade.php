@extends('layouts.dashboard')
@section('title')
Tambah Data Pedagang
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambah Data Pedagang</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">

        <div class="card-body">
            <form action="{{ route('pedagang.store') }}" method="POST" class="form form-vertical">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" autofocus
                                    required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Masukan alamat"
                                        value="{{ old('address') }}" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="contact">No.Telpn</label>
                                    <input type="tel" class="form-control @error('contact') is-invalid @enderror"
                                        id="contact" name="contact" placeholder="Format: 6281..." required
                                        value="{{ old('contact') }}">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Tambah</button>
                            <a href="{{ route('pedagang.index') }}" type="button"
                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection