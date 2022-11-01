@extends('layouts.dashboard')
@section('title')
Dashboard
@endsection

@section('content')
<div class="page-heading">
  <div class="row">
    <div class="col-lg-6 col-md-6 order-md-1 order-last">
      <h3>Selamat Datang, <span class="text-capitalize">{{ Auth::user()->name }} ✋</span></h3>
    </div>

    <div class="col-lg-6 col-md-6 order-md-1 order-last text-end">
      <h6>{{ date('l, d-F-Y') }}</h6>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">List Pemasukan Pasar</h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
          <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#harian"
            role="tab">Harian</a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#bulanan" role="tab">Bulanan</a>
          <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#tahunan" role="tab">Tahunan</a>
        </div>

        <div class="tab-content text-justify">
          <div class="tab-pane fade show active" id="harian" role="tabpanel">
            {{-- stats session --}}
            <div class="col-12">
              <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Pemasukan</h6>
                          @php
                          $uangMasuk = $pemasukanHarian->sum('biaya_sewa');
                          @endphp
                          <h3 class="font-extrabold mb-0">Rp{{ number_format($uangMasuk, 0, ',', '.') }}</h3>

                          <a href="{{ route('pemasukan.harian') }}">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Pengeluaran</h6>
                          @php
                          $uangKeluar = $pengeluaranHarian->sum('total');
                          @endphp
                          <h3 class="font-extrabold mb-0">Rp{{ number_format($uangKeluar, 0, ',', '.') }}</h3>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Jumlah Pedagang</h6>
                          <h6 class="font-extrabold mb-0">{{ count($pedagangHarian) }}</h6>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Jumlah Admin</h6>
                          <h6 class="font-extrabold mb-0">{{ count($adminHarian) }}</h6>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            {{-- end stats session --}}
          </div>

          <div class="tab-pane fade" id="bulanan" role="tabpanel">
            {{-- stats session --}}
            <div class="col-12">
              <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Pemasukan</h6>
                          @php
                          $uangMasuk = $pemasukanBulanan->sum('biaya_sewa');
                          @endphp
                          <h3 class="font-extrabold mb-0">Rp{{ number_format($uangMasuk, 0, ',', '.') }}</h3>

                          <a href="{{ route('pemasukan.bulanan') }}">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Pengeluaran</h6>
                          @php
                          $uangKeluar = $pengeluaranBulanan->sum('total');
                          @endphp
                          <h3 class="font-extrabold mb-0">Rp{{ number_format($uangKeluar, 0, ',', '.') }}</h3>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Jumlah Pedagang</h6>
                          <h6 class="font-extrabold mb-0">{{ count($pedagangBulanan) }}</h6>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Jumlah Admin</h6>
                          <h6 class="font-extrabold mb-0">{{ count($adminBulanan) }}</h6>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            {{-- end stats session --}}
          </div>

          <div class="tab-pane fade" id="tahunan" role="tabpanel">
            {{-- stats session --}}
            <div class="col-12">
              <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Pemasukan</h6>
                          @php
                          $uangMasuk = $pemasukanTahunan->sum('biaya_sewa');
                          @endphp
                          <h3 class="font-extrabold mb-0">Rp{{ number_format($uangMasuk, 0, ',', '.') }}</h3>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Pengeluaran</h6>
                          @php
                          $uangKeluar = $pengeluaranTahunan->sum('total');
                          @endphp
                          <h3 class="font-extrabold mb-0">Rp{{ number_format($uangKeluar, 0, ',', '.') }}</h3>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Jumlah Pedagang</h6>
                          <h6 class="font-extrabold mb-0">{{ count($pedagangTahunan) }}</h6>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted font-semibold">Jumlah Admin</h6>
                          <h6 class="font-extrabold mb-0">{{ count($adminTahunan) }}</h6>

                          <a href="#">Lihat Detail &rarr;</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            {{-- end stats session --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection