@extends('layouts.dashboard')
@section('title')
Ubah Data Kontrak
@endsection

@section('additional-css')
<style>
    .choices__inner {
        background-color: #fff !important;
    }

    .choices__input {
        color: #333;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ubah Data Kontrak Pasar</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">

        <div class="card-body">
            <form action="{{ route('kontrak.update', $data_kontrak->id) }}" method="POST" class="form form-vertical">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama">Nama Penyewa</label>

                            <select name="id_penyewa" disabled class="form-select">
                                @foreach ($pedagangs as $pedagang)
                                <option value="{{ $pedagang->id }}" @if($data_kontrak->id_penyewa ==
                                    $pedagang->id) selected @endif>{{ $pedagang->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="email-id-icon">Jenis</label>
                                <select name="id_jenis_toko"
                                    class="form-select @error('id_jenis_toko') is-invalid @enderror">
                                    <option value="none" selected disabled>- Pilih Jenis -</option>

                                    @foreach ($jenisPasars as $jenisPasar)
                                    <option value="{{ $jenisPasar->id }}" @if($data_kontrak->id_jenis_toko ==
                                        $jenisPasar->id) selected @endif>{{ $jenisPasar->name }}</option>
                                    @endforeach
                                </select>

                                @error('id_jenis_toko')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="email-id-icon">Jenis Kontrak</label>
                                <select name="jenis_kontrak"
                                    class="form-select @error('jenis_kontrak') is-invalid @enderror">
                                    <option value="none" disabled>- Pilih Jenis Kontrak -</option>
                                    <option value="harian" @if($data_kontrak->jenis_kontrak == 'harian') selected
                                        @endif>Harian</option>
                                    <option value="bulanan" @if($data_kontrak->jenis_kontrak == 'bulanan') selected
                                        @endif>Bulanan</option>
                                    <option value="6bulanan" @if($data_kontrak->jenis_kontrak == '6bulanan') selected
                                        @endif>6 Bulanan</option>
                                    <option value="tahunan" @if($data_kontrak->jenis_kontrak == 'tahunan') selected
                                        @endif>Tahunan</option>
                                </select>

                                @error('jenis_kontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ $data_kontrak->tanggal }}"
                                    class="form-control @error('tanggal') is-invalid @enderror">

                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Nomor <code>*kosongkan jika tidak ada</code></label>
                                <input type="text" name="no_toko" value="{{ $data_kontrak->no_toko }}"
                                    class="form-control @error('no_toko') is-invalid @enderror">

                                @error('no_toko')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-4">
                            <div class="form-group has-icon-left">
                                <label for="password-id-icon">Biaya Sewa</label>
                                <div class="position-relative">
                                    <input type="number" value="{{ $data_kontrak->biaya_sewa }}" name="biaya_sewa"
                                        min="0" class="form-control @error('biaya_sewa') is-invalid @enderror"
                                        id="password-id-icon">
                                    <div class="form-control-icon">
                                        <span>Rp</span>
                                    </div>
                                </div>

                                @error('biaya_sewa')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-4">
                            <div class="form-group has-icon-left">
                                <label for="tunggakan">Tunggakan <code>*kosongkan jika tidak ada</code></label>
                                <div class="position-relative">
                                    <input type="number" value="{{ $data_kontrak->tunggakan }}" name="tunggakan" min="0"
                                        class="form-control @error('tunggakan') is-invalid @enderror" placeholder="0"
                                        id="tunggakan">
                                    <div class="form-control-icon">
                                        <span>Rp</span>
                                    </div>
                                </div>

                                @error('tunggakan')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            <a href="{{ route('kontrak.index') }}" type="button"
                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection
