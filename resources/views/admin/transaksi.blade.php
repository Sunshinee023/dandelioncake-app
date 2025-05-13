@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Daftar Transaksi</h2>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Produk</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Status Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <!-- Nama Pelanggan -->
                        <td>{{ $item->pelanggan->name ?? 'Tidak Diketahui' }}</td> <!-- Tampilkan nama pelanggan -->
                        <!-- Nama Produk -->
                        <td>{{ $item->product->nama_kue ?? '-' }}</td> <!-- Tampilkan nama produk -->
                        <!-- Tanggal Transaksi -->
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') }}</td>
                        <!-- Total Harga -->
                        <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td> <!-- Tampilkan total harga -->
                        <!-- Status Transaksi -->
                        <td>
                            <span class="badge 
                                @if ($item->status == 'pending') bg-secondary
                                @elseif ($item->status == 'diproses') bg-warning
                                @elseif ($item->status == 'dikirim') bg-info
                                @elseif ($item->status == 'selesai') bg-success
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.transaksi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
