@extends('layouts.dashboard')
@section('title')
Pembayaran
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
            <h3>Pembayaran Sewa Pasar</h3>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <label for="nama">Nama Penyewa</label>
                                <div class="form-group">
                                    <select name="id_penyewa" id="nama_pedagang" class="choices form-select">
                                        <option value="none" selected disabled>- Pilih Penyewa -</option>

                                        @foreach ($penyewas as $penyewa)
                                        <option value="{{ $penyewa->id }}">{{ $penyewa->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email-id-icon">Jenis</label>
                                    <select name="id_jenis_toko" id="jenis_toko" class="form-select">
                                        <option value="none" selected disabled>- Pilih Jenis -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email-id-icon">Jenis Sewa</label>
                                    <select name="jenis_kontrak" id="jenis_kontrak" class="form-select">
                                        <option value="none" selected disabled>- Pilih Jenis Sewa -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email-id-icon">Nomor</label>
                                    <select name="no_toko" id="nomor_toko" class="form-select">
                                        <option value="none" selected disabled>- Pilih Nomor -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="email-id-icon">Biaya Sewa</label>
                                    <select name="biaya_sewa" id="uang_sewa" class="form-select">
                                        <option value="none" selected disabled>- Pilih Biaya Sewa -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="dibayarkan">Dibayarkan</label>
                                    <div class="position-relative">
                                        <input type="number" value="{{ old('dibayarkan') }}" name="dibayarkan" min="0"
                                            class="form-control @error('dibayarkan') is-invalid @enderror"
                                            placeholder="0" id="dibayarkan" required>
                                        <div class="form-control-icon">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1 mb-1"
                                onclick="return confirm('Apakah Yakin Data Yang Anda Inputkan Sudah Benar ?')">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Pembayaran</h4>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Penyewa</th>
                                <th>Jenis</th>
                                <th>Nomor</th>
                                <th>Jenis Sewa</th>
                                <th>Biaya Sewa</th>
                                <th>Dibayarkan</th>
                                <th>Tunggakan</th>
                                <th>Tanggal</th>
                                <th>Operator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontraks as $kontrak)
                            <tr>
                                <td>{{ $kontrak->kontrak->penyewa->name }}</td>
                                <td>{{ $kontrak->kontrak->jenisToko->name }}</td>
                                <td>{{ $kontrak->kontrak->no_toko }}</td>
                                <td>{{ $kontrak->kontrak->jenis_kontrak }}</td>
                                <td>Rp{{ number_format($kontrak->biaya_sewa, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($kontrak->dibayarkan, 0, ',', '.') }}</td>
                                <td class="text-danger">Rp{{ number_format($kontrak->tunggakan, 0, ',', '.') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($kontrak->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $kontrak->user->name }}</td>
                                <td>
                                    <a href="{{ route('pembayaran.edit', $kontrak->id) }}"
                                        class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger block" data-bs-toggle="modal"
                                        data-bs-target="#delete">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#nama_pedagang').change(function(){
        const getUrl = window.location.origin+'/dashboard/pembayaran/fetch/'+this.value
        $.ajax({
            url: getUrl,
            method: 'GET',
            success:function(data){
                const books = data.map(function(d){
                    return `<option value='${d.jenis_kontrak}'>${d.jenis_kontrak}</option>`
                })

                const toko = data.map(function(d){
                    return `<option value='${d.no_toko}'>${d.no_toko}</option>`
                })

                const sewa = data.map(function(d){
                    return `<option value='${d.biaya_sewa}'>${d.biaya_sewa}</option>`
                })

                const ruko = data.map(function(d){
                    return `<option value='${d.id_jenis_toko}'>${d.jenis_toko.name}</option>`
                })

                $('#jenis_kontrak').html(books)
                $('#nomor_toko').html(toko)
                $('#uang_sewa').html(sewa)
                $('#jenis_toko').html(ruko)
            }
        });
    })

    @if(Session::has('message'))
        Toastify({
            text: `{{ session('message') }}`,
            duration: 3000,
            close: true,
            gravity: "top", // `top` or `bottom`
            positionLeft: false, // `true` or `false`
            backgroundColor: `{{
                session('status') == 'success' ? 'linear-gradient(to right, #00b09b, #96c93d)' : 'linear-gradient(to right, #FF5F6D,
                #FFC371)'
            }}`,
        }).showToast();
    @endif
</script>
@endsection