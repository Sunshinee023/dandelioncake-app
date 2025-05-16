@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($product))
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama }}</h5>
                <p class="card-text">Harga: Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="jumlah" value="1">
                    <button type="submit" class="btn btn-pink">Bayar Sekarang</button>
                </form>
            </div>
        </div>

    @elseif(isset($keranjang) && count($keranjang) > 0)
        <form action="{{ route('transaksi.keranjangBayar') }}" method="POST">
            @csrf
            @foreach($keranjang as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->product->nama }}</h5>
                        <p class="card-text">Jumlah: {{ $item->jumlah }}</p>
                        <p class="card-text">Subtotal: Rp{{ number_format($item->product->harga * $item->jumlah, 0, ',', '.') }}</p>
                        <input type="hidden" name="keranjang_id[]" value="{{ $item->id }}">
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-pink">Bayar Semua</button>
        </form>
    @else
        <p>Tidak ada item untuk dibayar.</p>
    @endif
</div>
@endsection
