@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>TAMBAH DATA PRODUK</h1></center>
        <form action="/produk" method="post">
            @csrf

            <div class="mb-3">
                <label for="nama_kue">Nama Kue</label>
                <input class="form-control" type="text" name="nama_kue" id="nama_kue">
            </div>

            <div class="mb-3">
                <label for="varian_kue">Varian Kue</label>
                <input class="form-control" type="text" name="varian_kue" id="varian_kue">

            <div class="mb-3">
                <label for="jumlah">Jumlah</label>
                <input class="form-control" type="number" name="jumlah" id="jumlah">
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
