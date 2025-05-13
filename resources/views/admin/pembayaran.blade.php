@extends('layouts.app')

@section('content')
<div class="container">
    <center><h1 class="mb-4">Daftar Pembayaran</h1></center>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Varian Produk</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Transaksi</th>
                    <th>Alamat Pengiriman</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Checkout</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- Nama Pelanggan -->
                    <td>{{ $item->pelanggan->name ?? 'Tidak ditemukan' }}</td>
                    <!-- Nama Produk -->
                    <td>{{ $item->product->nama_kue ?? 'Tidak ditemukan' }}</td>
                    <!-- Varian Produk -->
                    <td>{{ $item->product->varian_kue ?? 'Tidak ditemukan' }}</td>
                    <!-- Metode Pembayaran -->
                    <td>{{ $item->metode_pembayaran ?? 'Tidak ditemukan' }}</td>
                    <!-- Status Transaksi -->
                    <td>
                        <span class="badge bg-{{ 
                            $item->transaksi->status == 'pending' ? 'secondary' : 
                            ($item->transaksi->status == 'diproses' ? 'warning' : 
                            ($item->transaksi->status == 'selesai' ? 'success' : 'danger')) }}">
                            {{ ucfirst($item->transaksi->status) }}
                        </span>
                    </td>
                    <!-- Alamat Pengiriman -->
                    <td>{{ $item->alamat_pengiriman ?? 'Tidak ditemukan' }}</td>
                    <!-- Status Pembayaran -->
                    <td>
                        <span class="badge bg-{{ 
                            $item->status_pembayaran == 'pending' ? 'secondary' : 
                            ($item->status_pembayaran == 'sudah dibayar' ? 'success' : 'danger') }}">
                            {{ ucfirst($item->status_pembayaran) }}
                        </span>
                    </td>
                    <!-- Tanggal Checkout -->
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_checkout)->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.pembayaran.destroy', $item->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
