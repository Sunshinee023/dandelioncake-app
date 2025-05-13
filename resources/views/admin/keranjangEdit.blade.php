@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT ITEM KERANJANG</h1></center>
        <form action="{{ route('admin.keranjang.update', $keranjang->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pelanggan_id">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id">
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $keranjang->pelanggan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="produk_id">Produk</label>
                <select class="form-select" name="produk_id" id="produk_id">
                    @foreach ($product as $p)
                        <option value="{{ $p->id }}" {{ $keranjang->produk_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_kue }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah">Jumlah</label>
                <input class="form-control" type="number" name="jumlah" id="jumlah" min="1" value="{{ $keranjang->jumlah }}" required>
            </div>

            <div class="mb-3">
                <label for="total_harga">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" value="{{ $keranjang->total_harga }}" required>
            </div>

            <button class="btn btn-primary" type="submit">UBAH ITEM KERANJANG</button>
        </form>
    </div>
</div>
@endsection
