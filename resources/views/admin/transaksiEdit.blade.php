@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA TRANSAKSI</h1></center>
        <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    <option disabled selected>-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $transaksi->pelanggan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->user->name ?? 'Nama user tidak tersedia' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produk -->
            <div class="mb-3">
                <label for="produk_id">Produk</label>
                <select name="produk_id" id="produk_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($product as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $transaksi->produk_id ? 'selected' : '' }}>
                            {{ $item->nama_kue }} - {{ $item->varian_kue }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" 
                value="{{ $transaksi->total_harga }}" required>
            </div>

            <!-- Tanggal Transaksi -->
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input class="form-control" type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" 
                value="{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- Status Transaksi -->
            <div class="mb-3">
                <label for="status" class="form-label">Status Transaksi</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ $transaksi->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $transaksi->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">UBAH TRANSAKSI</button>
        </form>
    </div>
</div>
@endsection
