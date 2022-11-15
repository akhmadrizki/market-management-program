@extends('layouts.dashboard')
@section('title')
Edit Pembayaran
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
            <h3>Edit Pembayaran</h3>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pembayaran.update', $kontraks->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Nama Penyewa</label>
                                    <input type="hidden" name="penyewa" value="{{ $kontraks->kontrak->penyewa->id }}">
                                    <input type="text" class="form-control" name="id_penyewa"
                                        value="{{ $kontraks->kontrak->penyewa->name }}" readonly>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email-id-icon">Jenis</label>
                                    <select name="id_jenis_toko" id="jenis_toko" class="form-select">
                                        @foreach ($jenisToko as $jenis)
                                        <option value="{{ $jenis->jenisToko->id }}" @if($jenis->jenisToko->name ==
                                            $kontraks->kontrak->jenisToko->name) selected @endif>
                                            {{$jenis->jenisToko->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email-id-icon">Jenis Sewa</label>
                                    <select name="jenis_kontrak" id="jenis_kontrak" class="form-select">
                                        @foreach ($jenisToko as $jenis)
                                        <option value="{{ $jenis->jenis_kontrak }}" @if($jenis->jenis_kontrak ==
                                            $kontraks->kontrak->jenis_kontrak) selected @endif>
                                            {{$jenis->jenis_kontrak }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="email-id-icon">Nomor</label>
                                    <select name="no_toko" id="nomor_toko" class="form-select">
                                        @foreach ($jenisToko as $jenis)
                                        <option value="{{ $jenis->no_toko }}" @if($jenis->no_toko ==
                                            $kontraks->kontrak->no_toko) selected @endif>
                                            {{$jenis->no_toko }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="email-id-icon">Biaya Sewa</label>
                                    <select name="biaya_sewa" id="uang_sewa" class="form-select">
                                        @foreach ($jenisToko as $jenis)
                                        <option value="{{ $jenis->biaya_sewa }}" @if($jenis->biaya_sewa ==
                                            $kontraks->kontrak->biaya_sewa) selected @endif>
                                            {{$jenis->biaya_sewa }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="dibayarkan">Dibayarkan</label>
                                    <div class="position-relative">
                                        <input type="number" value="{{ $kontraks->dibayarkan }}" name="dibayarkan"
                                            min="0" class="form-control" placeholder="0" id="dibayarkan" required>
                                        <div class="form-control-icon">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" value="{{ $kontraks->tanggal }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1 mb-1"
                                onclick="return confirm('Apakah Yakin Data Yang Anda Inputkan Sudah Benar ?')">Update</button>

                            <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-primary me-1 mb-1">&larr;
                                Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection