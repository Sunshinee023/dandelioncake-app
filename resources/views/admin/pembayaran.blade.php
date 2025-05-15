@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
@endpush

<div class="card-header">
    <h1>DAFTAR PEMBAYARAN</h1>
    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary">+ Tambah Data</a>
</div>

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-fluid d-flex justify-content-center">
    <div class="table-responsive">
        <table class="table table-dark table-striped" style="width: 100%;">
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
                    <th>Total Harga</th>
                    <th>Tanggal Checkout</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- Nama Pelanggan -->
                    <td>{{ optional(optional($item->pelanggan)->user)->name ?? 'Tidak ditemukan' }}</td>
                    <!-- Nama Produk -->
                    <td>{{ optional($item->product)->nama_kue ?? 'Tidak ditemukan' }}</td>
                    <!-- Varian Produk -->
                    <td>{{ optional($item->product)->varian_kue ?? 'Tidak ditemukan' }}</td>
                    <!-- Metode Pembayaran -->
                    <td>{{ $item->metode_pembayaran ?? '-' }}</td>
                    <!-- Status Transaksi -->
                    <td>
                        @php
                            $statusTransaksi = optional($item->transaksi)->status;
                            $badgeClass = 'secondary';
                            if ($statusTransaksi == 'diproses') $badgeClass = 'warning';
                            elseif ($statusTransaksi == 'selesai') $badgeClass = 'success';
                            elseif ($statusTransaksi && !in_array($statusTransaksi, ['pending', 'diproses', 'selesai'])) $badgeClass = 'danger';
                        @endphp
                        <span class="badge bg-{{ $badgeClass }}">
                            {{ ucfirst($statusTransaksi ?? 'Tidak ada') }}
                        </span>
                    </td>
                    <!-- Alamat Pengiriman -->
                    <td>{{ $item->alamat_pengiriman ?? '-' }}</td>
                    <!-- Status Pembayaran -->
                    <td>
                        @php
                            $statusBayar = $item->status_pembayaran;
                            $badgeBayarClass = 'secondary';
                            if ($statusBayar == 'sudah dibayar') $badgeBayarClass = 'success';
                            elseif ($statusBayar == 'belum dibayar') $badgeBayarClass = 'danger';
                        @endphp
                        <span class="badge bg-{{ $badgeBayarClass }}">
                            {{ ucfirst($statusBayar ?? 'Tidak ada') }}
                        </span>
                    </td>
                    <!-- Total Harga -->
                    <td>Rp{{ number_format($item->total_harga ?? 0, 0, ',', '.') }}</td>
                    <!-- Tanggal Checkout -->
                    <td>{{ $item->tanggal_checkout ? \Carbon\Carbon::parse($item->tanggal_checkout)->format('d M Y H:i') : '-' }}</td>
                    <!-- Aksi -->
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
