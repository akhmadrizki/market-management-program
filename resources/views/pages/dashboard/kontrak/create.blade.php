@extends('layouts.dashboard')
@section('title')
Tambah Data Kontrak
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
      <h3>Tambah Data Kontrak Pasar</h3>
    </div>
  </div>
</div>

<section class="section">
  <div class="card">

    <div class="card-body">
      <form action="{{ route('kontrak.store') }}" method="POST" class="form form-vertical">
        @csrf
        <div class="form-body">
          <div class="row">
            <div class="col-md-12">
              <label for="nama">Nama Penyewa</label>
              <div class="form-group">
                <select name="id_penyewa" class="choices form-select @error('id_penyewa') is-invalid @enderror">
                  <option value="none" selected disabled>- Pilih Penyewa -</option>

                  @foreach ($pedagangs as $pedagang)
                  <option value="{{ $pedagang->id }}">{{ $pedagang->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label for="email-id-icon">Jenis</label>
                <select name="id_jenis_toko" class="form-select @error('id_jenis_toko') is-invalid @enderror">
                  <option value="none" selected disabled>- Pilih Jenis -</option>

                  @foreach ($jenisPasars as $jenisPasar)
                  <option value="{{ $jenisPasar->id }}">{{ $jenisPasar->name }}</option>
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
                <label for="email-id-icon">Jenis Sewa</label>
                <select name="jenis_kontrak" class="form-select @error('jenis_kontrak') is-invalid @enderror">
                  <option value="none" selected disabled>- Pilih Jenis Sewa -</option>
                  <option value="harian">Harian</option>
                  <option value="bulanan">Bulanan</option>
                  <option value="6bulanan">6 Bulanan</option>
                  <option value="tahunan">Tahunan</option>
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
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror">

                @error('tanggal')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Nomor</label>
                <input type="text" name="no_toko" value="{{ old('no_toko') }}"
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
                  <input type="number" value="{{ old('biaya_sewa') }}" name="biaya_sewa" min="0"
                    class="form-control @error('biaya_sewa') is-invalid @enderror" placeholder="300000"
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
                  <input type="number" value="{{ old('tunggakan') }}" name="tunggakan" min="0"
                    class="form-control @error('tunggakan') is-invalid @enderror" placeholder="0" id="tunggakan">
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
              <button type="submit" class="btn btn-primary me-1 mb-1">Tambah</button>
              <a href="{{ route('kontrak.index') }}" type="button" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>
@endsection