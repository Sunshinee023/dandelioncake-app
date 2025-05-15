@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PRODUK</h1></center>
        <form action="{{ route('admin.produk.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="gambar">Pilih Gambar</label>
                <!-- Input file untuk memilih gambar dari galeri -->
                <input type="file" name="gambar" class="form-control" accept="image/*">
                
                <!-- Menampilkan gambar yang sudah ada jika sedang mengedit produk -->
                @if(isset($product->gambar))
                    <div class="mt-2">
                        <label>Gambar Saat Ini:</label>
                        <img src="{{ asset('images/products/'.$product->gambar) }}" alt="{{ $product->nama_kue }}" 
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="nama_kue">Nama Kue</label>
                <input class="form-control" type="text" name="nama_kue" id="nama_kue" value="{{ $product->nama_kue }}">
            </div>

            <div class="mb-3">
                <label for="varian_kue">Varian Kue</label>
                <input class="form-control" type="text" name="varian_kue" id="varian_kue" value="{{ $product->varian_kue }}">
            </div>

            <div class="mb-3">
                <label for="stok">Stok</label>
                <input class="form-control" type="number" name="stok" id="stok" value="{{ $product->stok }}">
            </div>

            <div class="mb-3">
                <label for="harga">Harga</label>
                <input class="form-control" type="number" name="harga" id="harga" value="{{ $product->harga }}">
            </div>

            <button class="btn btn-primary" type="submit">UBAH PRODUK</button>
        </form>
    </div>
</div>
@endsection
