@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
@endpush

<div class="card-header">
    <h1>DAFTAR TRANSAKSI</h1>
    <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
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
                        <td>{{ $item->pelanggan->user->name ?? 'Tidak Diketahui' }}</td> 
                        <!-- Nama Produk -->
                        <td>{{ $item->product->nama_kue ?? '-' }}</td> 
                        <!-- Tanggal Transaksi -->
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') }}</td>
                        <!-- Total Harga -->
                        <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td> 
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
