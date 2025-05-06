@extends('layouts.app')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <center><h2 class="mb-4">Tambah Data Transaksi</h2></center>
        <form action="/transaksi" method="post">
            @csrf

            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    <option disabled selected>-- Pilih Pelanggan --</option>
                    @foreach ($profil as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="produk_id" class="form-label">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id" required>
                    <option disabled selected>-- Pilih Produk --</option>
                    @foreach ($produk as $pr)
                        <option value="{{ $pr->id }}">{{ $pr->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="pembayaran_id" class="form-label">Metode Pembayaran</label>
                <select class="form-select" name="pembayaran_id" id="pembayaran_id" required>
                    <option disabled selected>-- Pilih Metode Pembayaran --</option>
                    @foreach ($pembayaran as $pay)
                        <option value="{{ $pay->id }}">{{ $pay->metode_pembayaran }} - {{ $pay->status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status Transaksi</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="pending" selected>Pending</option>
                    <option value="diproses">Diproses</option>
                    <option value="dikirim">Dikirim</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <button class="btn btn-success w-100" type="submit">Tambah Transaksi</button>
        </form>
    </div>
</div>
@endsection
