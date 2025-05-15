@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush
@section('content')
<div class="card mt-4">
    <div class="card-body">
        <center><h2 class="mb-4">Edit Data Pembayaran</h2></center>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Pelanggan -->
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    <option disabled>-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}"
                            {{ old('pelanggan_id', $pembayaran->pelanggan_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->user->name ?? 'Nama user tidak tersedia' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produk -->
            <div class="mb-3">
                <label for="produk_id" class="form-label">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id" required>
                    <option disabled>-- Pilih Produk --</option>
                    @foreach ($product as $pr)
                        <option value="{{ $pr->id }}"
                            {{ old('produk_id', $pembayaran->produk_id) == $pr->id ? 'selected' : '' }}>
                            {{ $pr->nama_kue }} - {{ $pr->varian_kue }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Transaksi -->
            <div class="mb-3">
                <label for="transaksi_id" class="form-label">Transaksi</label>
                <select class="form-select" name="transaksi_id" id="transaksi_id" required>
                    <option disabled>-- Pilih Transaksi --</option>
                    @foreach ($transaksi as $t)
                        <option value="{{ $t->id }}"
                            {{ old('transaksi_id', $pembayaran->transaksi_id) == $t->id ? 'selected' : '' }}>
                            {{ $t->id }} - {{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01"
                       value="{{ old('total_harga', $pembayaran->total_harga) }}" required>
            </div>

            <!-- Alamat Pengiriman -->
            <div class="mb-3">
                <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                <input class="form-control" type="text" name="alamat_pengiriman" id="alamat_pengiriman"
                       value="{{ old('alamat_pengiriman', $pembayaran->alamat_pengiriman) }}" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" name="metode_pembayaran" id="metode_pembayaran" required>
                    <option disabled>-- Pilih Metode Pembayaran --</option>
                    <option value="transfer" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="cash_on_delivery" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                </select>
            </div>

            <!-- Status Pembayaran -->
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select class="form-select" name="status_pembayaran" id="status_pembayaran" required>
                    <option value="pending" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sudah dibayar" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'sudah dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                    <option value="belum dibayar" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'belum dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                </select>
            </div>

            <!-- Tanggal Checkout -->
            <div class="mb-3">
                <label for="tanggal_checkout" class="form-label">Tanggal Checkout</label>
                <input class="form-control" type="datetime-local" name="tanggal_checkout" id="tanggal_checkout"
                       value="{{ old('tanggal_checkout', $pembayaran->tanggal_checkout ? \Carbon\Carbon::parse($pembayaran->tanggal_checkout)->format('Y-m-d\TH:i') : '') }}" required>
            </div>

            <button class="btn btn-primary w-100" type="submit">Update Pembayaran</button>
        </form>
    </div>
</div>
@endsection
