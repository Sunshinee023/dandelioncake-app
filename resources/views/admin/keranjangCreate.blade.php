@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>TAMBAH ITEM KERANJANG</h1></center>
        <form action="/keranjang" method="post">
            @csrf

            <div class="mb-3">
                <label for="pelanggan_id">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id">
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="produk_id">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id">
                    @foreach ($produk as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah">Jumlah</label>
                <input class="form-control" type="number" name="jumlah" id="jumlah" min="1" required>
            </div>

            <div class="mb-3">
                <label for="total_harga">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" required>
            </div>

            <button class="btn btn-primary" type="submit">TAMBAH ITEM KERANJANG</button>
        </form>
    </div>
</div>
@endsection
