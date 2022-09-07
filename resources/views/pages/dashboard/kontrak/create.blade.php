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
      <form class="form form-vertical">
        <div class="form-body">
          <div class="row">
            <div class="col-md-12">
              <label for="nama">Nama Pedagang</label>
              <div class="form-group">
                <select class="choices form-select">
                  <option value="square">Square</option>
                  <option value="rectangle">Rectangle</option>
                  <option value="rombo">Rombo</option>
                  <option value="romboid">Romboid</option>
                  <option value="trapeze">Trapeze</option>
                  <option value="traible">Triangle</option>
                  <option value="polygon">Polygon</option>
                  <option value="yoga">Yoga</option>
                </select>
              </div>
            </div>


            <div class="col-4">
              <div class="form-group">
                <label for="email-id-icon">Jenis Pasar</label>
                <select class="form-select">
                  <option>IT</option>
                  <option>Blade Runner</option>
                  <option>Thor Ragnarok</option>
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="email-id-icon">Jenis Kontrak</label>
                <select class="form-select">
                  <option>IT</option>
                  <option>Blade Runner</option>
                  <option>Thor Ragnarok</option>
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group has-icon-left">
                <label for="password-id-icon">Biaya Sewa</label>
                <div class="position-relative">
                  <input type="number" min="0" class="form-control" placeholder="300000" id="password-id-icon">
                  <div class="form-control-icon">
                    <span>Rp</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary me-1 mb-1">Tambah</button>
              <button type="button" class="btn btn-light-secondary me-1 mb-1">Kembali</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>
@endsection