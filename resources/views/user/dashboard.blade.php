@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        @foreach($product as $produk)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm product-card border-0 position-relative">
                <img src="{{ asset('images/products/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama_kue }}" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-semibold">{{ $produk->nama_kue }}</h5>
                    <h5 class="card-title">{{ $produk->varian_kue }}</h5>
                    <p class="text-muted fw-semibold">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                    <form action="{{ route('user.keranjang.create', $produk->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-baby-blue" title="Tambah ke Keranjang">
                            🛒
                        </button>
                    </form>
                    <a href="{{ route('user.beli.sekarang', $produk->id) }}" class="btn btn-pink">
                        🛍️ Beli
                    </a>
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
