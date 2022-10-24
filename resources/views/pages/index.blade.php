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
      <small>{{ date('l, d-M-Y') }}</small>
    </div>
  </div>
</div>

<div class="page-content">
  <section class="row">
    <div class="col-12">
      <form action="" method="GET">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="email-id-icon">Harian</label>
                  <input name="date" type="date" class="form-control">
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label for="email-id-icon">Bulanan</label>
                  <select name="month" class="form-select">
                    <option value="none" selected disabled>- Pilih Bulan -</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                  <label for="email-id-icon">Tahunan</label>
                  <select name="year" id="year" class="form-control">
                    @php
                    $year = date('Y');
                    @endphp

                    @for ($i = $year; $i <= $year + 8; $i++) <option value="{{ $i }}">{{ $i }}</option>
                      @endfor

                  </select>
                </div>
              </div>

              <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-1 mb-1">Terapkan</button>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>

    {{-- stats session --}}
    <div class="col-12">
      <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-12">
                  <h6 class="text-muted font-semibold">
                    Pemasukan
                    @if (isset($dateFilter))
                    {{ date( 'd/m/Y', strtotime($dateFilter)) }}
                    @elseif(isset($monthFilter))
                    {{ date( 'F', strtotime($monthFilter)) }}
                    @endif

                  </h6>
                  @php
                  $uangMasuk = $pemasukan->sum('biaya_sewa');
                  @endphp
                  <h6 class="font-extrabold mb-0">Rp{{ number_format($uangMasuk, 0, ',', '.') }}</h6>

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
                  <h6 class="text-muted font-semibold">Pengeluaran {{ date('F') }} {{ date('Y') }}</h6>
                  @php
                  $uangKeluar = $pengeluaran->sum('total');
                  @endphp
                  <h6 class="font-extrabold mb-0">Rp{{ number_format($uangKeluar, 0, ',', '.') }}</h6>

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
                  <h6 class="font-extrabold mb-0">{{ count($pedagang) }}</h6>

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
                  <h6 class="font-extrabold mb-0">{{ count($admin) }}</h6>

                  <a href="#">Lihat Detail &rarr;</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    {{-- end stats session --}}

  </section>
</div>
@endsection