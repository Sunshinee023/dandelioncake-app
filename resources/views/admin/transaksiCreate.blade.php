@extends('layouts.app')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <center><h2 class="mb-4">Tambah Data Transaksi</h2></center>
        <form action="{{ route('admin.transaksi.store') }}" method="post">
            @csrf

            <!-- Pelanggan -->
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    <option disabled selected>-- Pilih Pelanggan --</option>
                    @foreach ($profil as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Produk -->
            <div class="mb-3">
                <label for="produk_id">Produk</label>
                <select name="produk_id" id="produk_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($product as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kue }} - {{ $item->varian_kue }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" required>
            </div>

            <!-- Tanggal Transaksi -->
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input class="form-control" type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" required>
            </div>

            <!-- Status Transaksi -->
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
