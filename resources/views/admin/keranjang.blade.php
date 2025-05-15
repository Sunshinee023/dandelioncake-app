@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
@endpush

<!-- Card Header -->
<div class="card-header">
    <h1>DAFTAR PRODUK KERANJANG</h1>
    <a href="{{ route('admin.keranjang.create') }}" class="btn btn-primary">+ Tambah Data</a>
</div>

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Table Container -->
<div class="container-fluid d-flex justify-content-center">
    <table class="table table-dark table-striped" style="width: 100%;"> <!-- Sesuaikan dengan class yang ada di CSS -->
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Gambar</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keranjang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pelanggan->user->name ?? '-' }}</td>
                    <td>{{ $item->product->nama_kue ?? '-' }}</td>

                    {{-- Kolom Gambar --}}
                    <td>
                        @if($item->product && $item->product->gambar)
                            <img src="{{ asset('images/products/' . $item->product->gambar) }}" alt="Gambar Produk" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </td>

                    <td>{{ $item->jumlah }}</td>
                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>

                    <td>
                        <a href="{{ route('admin.keranjang.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.keranjang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
