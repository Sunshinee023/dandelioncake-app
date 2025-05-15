@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>TAMBAH DATA PRODUK</h1></center>
        <form action="{{ route('admin.produk.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="gambar">Pilih Gambar</label>
                <!-- Input file untuk memilih gambar dari galeri -->
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                
                <!-- Menampilkan gambar jika sudah ada (untuk edit produk) -->
                @if(isset($products->image))
                    <img src="{{ asset('images/products/'.$products->image) }}" alt="{{ $products->nama_kue }}" 
                     style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                @endif
            </div>

            <div class="mb-3">
                <label for="nama_kue">Nama Kue</label>
                <input class="form-control" type="text" name="nama_kue" id="nama_kue">
            </div>

            <div class="mb-3">
                <label for="varian_kue">Varian Kue</label>
                <input class="form-control" type="text" name="varian_kue" id="varian_kue">

            <div class="mb-3">
                <label for="stok">Stok</label>
                <input class="form-control" type="number" name="stok" id="stok">
            </div>

            <div class="mb-3">
                <label for="harga">Harga</label>
                <input class="form-control" type="number" name="harga" id="harga">
            </div>

            <button class="btn btn-primary" type="submit">TAMBAH PRODUK</button>
        </form>
    </div>
</div>
@endsection
