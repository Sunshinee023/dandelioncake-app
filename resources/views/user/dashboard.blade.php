@extends('layouts.user')

@section('content')

@if(isset($keyword))
    <h5>Hasil pencarian untuk: <strong>{{ $keyword }}</strong></h5>
@endif

<div class="container">

    <div class="row">
        @foreach($product as $produk)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm product-card border-0 position-relative">
                <img src="{{ asset('images/products/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama_kue }}" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-semibold">{{ $produk->nama_kue }}</h5>
                    <p class="card-title fw-semibold">{{ $produk->varian_kue }}</p>
                    <p class="card-title">Rp{{ number_format($produk->harga, 2, ',', '.') }}</p>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex align-items-center gap-2">

   <div class="card-footer bg-white border-top-0 d-flex align-items-center justify-content-center gap-2">

    <form action="{{ route('user.keranjang.store') }}" method="POST" class="d-flex align-items-center gap-2 mb-0">
        @csrf
        <input type="hidden" name="product_id" value="{{ $produk->id }}">

        <input 
            type="number" 
            name="jumlah" 
            value="1" 
            min="1" 
            class="form-control text-center qty-input" 
            style="width: 50px; height: 32px; font-size: 14px; padding: 0 6px;"
            oninput="if(this.value < 1) this.value = 1;"
        >

        <button type="submit" class="btn btn-baby-blue" title="Tambah ke Keranjang" style="padding: 5px 12px; font-size: 16px;">
            🛒
        </button>
    </form>

    <form action="{{ route('user.transaksi.beli') }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="hidden" name="jumlah" value="1"> {{-- default jumlah 1 --}}
        <button type="submit" class="btn btn-pink" style="padding: 5px 12px; font-size: 14px;">
            🛍️ Beli
        </button>
    </form>


</div>

</div>

            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $product->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
.product-card:hover {
    transform: scale(1.02);
    transition: 0.3s;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}
</style>
@endpush
