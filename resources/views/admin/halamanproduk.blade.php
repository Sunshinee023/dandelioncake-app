@extends('layouts.app')

@section('content')
    <center><h1 class="mb-5">TABEL PRODUK</h1></center>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-2">+ Tambah Data</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th> <!-- Kolom baru -->
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
                        <img src="{{ asset('storage/' . $products->gambar) }}" width="80" alt="Gambar Produk">
                    </td>
                    <td>{{ $products->nama_kue }}</td>
                    <td>{{ $products->varian_kue }}</td>
                    <td>{{ $products->stok }}</td>
                    <td>{{ $products->harga }}</td>
                    <td>
                        <a href="{{ route('admin.produk.edit', $products->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $products->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
