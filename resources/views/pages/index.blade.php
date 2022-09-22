@extends('layouts.dashboard')
@section('title')
Dashboard
@endsection

@section('content')
<div class="page-heading">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <h3>Selamat Datang, <span class="text-capitalize">{{ Auth::user()->name }} ✋</span></h3>
    </div>
  </div>
</div>

<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="email-id-icon">Harian</label>
                <input type="date" class="form-control">
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label for="email-id-icon">Bulanan</label>
                <select class="form-select">
                  <option value="none" selected disabled>- Pilih Bulan -</option>
                  <option value="january">Januari</option>
                  <option value="february">Februari</option>
                  <option value="march">Maret</option>
                  <option value="april">April</option>
                  <option value="may">Mei</option>
                  <option value="june">Juni</option>
                  <option value="july">Juli</option>
                  <option value="august">Agustus</option>
                  <option value="september">September</option>
                  <option value="october">Oktober</option>
                  <option value="november">November</option>
                  <option value="december">Desember</option>
                </select>
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label for="email-id-icon">Tahunan</label>
                <select class="form-select">
                  <option>IT</option>
                  <option>Blade Runner</option>
                  <option>Thor Ragnarok</option>
                </select>
              </div>
            </div>

            <div class="col-12 d-flex justify-content-center">
              <button type="button" class="btn btn-primary me-1 mb-1">Terapkan</button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon purple">
                    <i class="iconly-boldShow"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Profile Views</h6>
                  <h6 class="font-extrabold mb-0">112.000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon blue">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Followers</h6>
                  <h6 class="font-extrabold mb-0">183.000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon green">
                    <i class="iconly-boldAdd-User"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Following</h6>
                  <h6 class="font-extrabold mb-0">80.000</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <div class="stats-icon red">
                    <i class="iconly-boldBookmark"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Saved Post</h6>
                  <h6 class="font-extrabold mb-0">112</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection