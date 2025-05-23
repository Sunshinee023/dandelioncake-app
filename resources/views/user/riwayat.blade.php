@extends('layouts.user')

@section('content')

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Gambar Produk</th>
            <th>Produk</th>
            <th>Total Harga</th>
            <th>Status Transaksi</th>
            <th>Status Pembayaran</th>
            <th>Tanggal Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($riwayat as $item)
        <tr>
            <td><img src="{{ asset('images/products/' . $item->product->gambar) }}" style="width: 80px; height: 80px;"></td>
            <td>{{ $item->transaksi->product->nama_kue ?? 'Produk tidak ditemukan' }}</td>
            <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            <td>{{ $item->transaksi->status }}</td>
            <td>{{ $item->status_pembayaran }}</td>
            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
