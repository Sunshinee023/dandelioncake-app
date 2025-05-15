@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
@endpush

<!-- Card Header -->
<div class="card-header">
    <h1>DAFTAR PRODUK</h1>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">+ Tambah Data</a>
</div>

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Table Container -->
<div class="container-fluid d-flex justify-content-center">
    <table class="table table-dark table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama Kue</th>
                <th scope="col">Varian Kue</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $products)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <img src="{{ asset('images/products/' . $products->gambar) }}" alt="gambar produk" 
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                    </td>
                    
                    <td>{{ $products->nama_kue }}</td>
                    <td>{{ $products->varian_kue }}</td>
                    <td>{{ $products->stok }}</td>
                    <td>{{ number_format($products->harga, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.produk.edit', $products->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $products->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
