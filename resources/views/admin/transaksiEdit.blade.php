@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA TRANSAKSI</h1></center>
        <form action="/transaksi/{{ $transaksi->id }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $transaksi->pelanggan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="produk_id" class="form-label">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id" required>
                    @foreach ($produk as $prod)
                        <option value="{{ $prod->id }}" {{ $transaksi->produk_id == $prod->id ? 'selected' : '' }}>
                            {{ $prod->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="pembayaran_id" class="form-label">Metode Pembayaran</label>
                <select class="form-select" name="pembayaran_id" id="pembayaran_id" required>
                    @foreach ($pembayaran as $pay)
                        <option value="{{ $pay->id }}" {{ $transaksi->pembayaran_id == $pay->id ? 'selected' : '' }}>
                            {{ $pay->metode_pembayaran }} - {{ $pay->status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" 
                value="{{ $transaksi->total_harga }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input class="form-control" type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" 
                value="{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d\TH:i') }}" required>
            </div>

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
