@extends('layouts.app')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <center><h2 class="mb-4">Tambah Data Pembayaran</h2></center>
        <form action="{{ route('admin.pembayaran.store') }}" method="post">
            @csrf

            <!-- Pelanggan -->
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    <option disabled selected>-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Produk -->
            <div class="mb-3">
                <label for="produk_id" class="form-label">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id" required>
                    <option disabled selected>-- Pilih Produk --</option>
                    @foreach ($product as $pr)
                        <option value="{{ $pr->id }}">{{ $pr->nama_kue }} - {{ $pr->varian_kue }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" required>
            </div>

            <!-- Alamat Pengiriman -->
            <div class="mb-3">
                <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                <input class="form-control" type="text" name="alamat_pengiriman" id="alamat_pengiriman" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" name="metode_pembayaran" id="metode_pembayaran" required>
                    <option disabled selected>-- Pilih Metode Pembayaran --</option>
                    <option value="transfer">Transfer</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                    <!-- Tambahkan metode pembayaran lain sesuai kebutuhan -->
                </select>
            </div>

            <!-- Status Pembayaran -->
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select class="form-select" name="status_pembayaran" id="status_pembayaran" required>
                    <option value="pending" selected>Pending</option>
                    <option value="sudah dibayar">Sudah Dibayar</option>
                    <option value="belum dibayar">Belum Dibayar</option>
                </select>
            </div>

            <!-- Tanggal Checkout -->
            <div class="mb-3">
                <label for="tanggal_checkout" class="form-label">Tanggal Checkout</label>
                <input class="form-control" type="datetime-local" name="tanggal_checkout" id="tanggal_checkout" required>
            </div>

            <button class="btn btn-success w-100" type="submit">Tambah Transaksi</button>
        </form>
    </div>
</div>
@endsection
