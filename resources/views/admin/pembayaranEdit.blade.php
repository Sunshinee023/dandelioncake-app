@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PEMBAYARAN</h1></center>
        <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Pelanggan -->
            <div class="mb-3">
                <label for="pelanggan_id">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $pembayaran->pelanggan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produk -->
            <div class="mb-3">
                <label for="produk_id">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id" required>
                    @foreach ($product as $pr)
                        <option value="{{ $pr->id }}" {{ $pembayaran->produk_id == $pr->id ? 'selected' : '' }}>
                            {{ $pr->nama_kue }} - {{ $pr->varian_kue }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="total_harga">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" 
                value="{{ $pembayaran->total_harga }}" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <input class="form-control" type="text" name="metode_pembayaran" id="metode_pembayaran" 
                value="{{ $pembayaran->metode_pembayaran }}" required>
            </div>

            <!-- Alamat Pengiriman -->
            <div class="mb-3">
                <label for="alamat_pengiriman">Alamat Pengiriman</label>
                <input class="form-control" type="text" name="alamat_pengiriman" id="alamat_pengiriman" 
                value="{{ $pembayaran->alamat_pengiriman }}" required>
            </div>

            <!-- Status Pembayaran -->
            <div class="mb-3">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-select" name="status_pembayaran" id="status_pembayaran" required>
                    <option value="pending" {{ $pembayaran->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sudah dibayar" {{ $pembayaran->status_pembayaran == 'sudah dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                    <option value="belum dibayar" {{ $pembayaran->status_pembayaran == 'belum dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                </select>
            </div>

            <!-- Tanggal Checkout -->
            <div class="mb-3">
                <label for="tanggal_checkout">Tanggal Checkout</label>
                <input class="form-control" type="datetime-local" name="tanggal_checkout" id="tanggal_checkout" 
                value="{{ \Carbon\Carbon::parse($pembayaran->tanggal_checkout)->format('Y-m-d\TH:i') }}" required>
            </div>

            <button class="btn btn-primary" type="submit">UBAH PEMBAYARAN</button>
        </form>
    </div>
</div>
@endsection
