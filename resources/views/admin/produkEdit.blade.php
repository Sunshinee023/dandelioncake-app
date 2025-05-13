@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PRODUK</h1></center>
        <form action="{{ route('admin.produk.update', $product->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="gambar">URL Gambar</label>
                <input type="url" name="gambar" class="form-control" placeholder="Masukkan URL gambar" value="{{ $product->gambar }}">
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
