@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PRODUK</h1></center>
        <form action="/produk/{{ $product->id }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_kue">Nama Kue</label>
                <input class="form-control" type="text" name="nama_kue" id="nama_kue" value="{{ $product->nama_kue }}">
            </div>

            <div class="mb-3">
                <label for="varian_kue">Varian Kue</label>
                <input class="form-control" type="text" name="varian_kue" id="varian_kue" value="{{ $product->varian_kue }}">
            </div>

            <div class="mb-3">
                <label for="jumlah">Jumlah</label>
                <input class="form-control" type="number" name="jumlah" id="jumlah" value="{{ $product->jumlah }}">
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
