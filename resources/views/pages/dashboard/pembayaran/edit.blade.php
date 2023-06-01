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
                                    <label>Jenis</label>
                                    <input type="hidden" name="id_jenis_toko"
                                        value="{{ $kontraks->kontrak->jenisToko->id }}">
                                    <input type="text" class="form-control"
                                        value="{{ $kontraks->kontrak->jenisToko->name }}" readonly>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jenis Sewa</label>
                                    <input type="hidden" name="jenis_kontrak"
                                        value="{{ $kontraks->kontrak->jenis_kontrak }}">
                                    <input type="text" class="form-control"
                                        value="{{ $kontraks->kontrak->jenis_kontrak }}" readonly>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Nomor</label>
                                    <input type="hidden" name="no_toko" value="{{ $kontraks->kontrak->no_toko }}">
                                    <input type="text" class="form-control" value="{{ $kontraks->kontrak->no_toko }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Biaya Sewa</label>
                                    <input type="hidden" name="biaya_sewa" value="{{ $kontraks->kontrak->biaya_sewa }}">
                                    <input type="text" class="form-control" value="{{ $kontraks->kontrak->biaya_sewa }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group has-icon-left">
                                    <label for="tunggakan">Tunggakan</label>
                                    <div class="position-relative">
                                        <input type="number" value="{{ $kontraks->kontrak->tunggakan }}" name="tunggakan"
                                            min="0" class="form-control" placeholder="0" id="tunggakan" required>
                                        <div class="form-control-icon">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
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

                            <div class="col-3">
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
