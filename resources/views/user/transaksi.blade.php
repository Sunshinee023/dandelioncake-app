@extends('layouts.user')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<div class="card profile-edit-page">
    <h4 class="mb-4 text-center">Daftar Transaksi Anda</h4>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" value="{{ $pelanggan->user->name }}" readonly>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" value="{{ $pelanggan->user->email }}" readonly>
    </div>

    <div class="mb-3">
        <label>No. Telepon</label>
        <input type="text" value="{{ $pelanggan->telepon }}" readonly>
    </div>

    <div class="mb-3">
        <label>Alamat Pengiriman</label>
        <textarea readonly>{{ $pelanggan->alamat }}</textarea>
    </div>

    <h5>Rincian Produk</h5>
    @if($transaksi->isEmpty())
        <div class="alert alert-warning">Tidak ada transaksi pending. Silakan belanja terlebih dahulu.</div>
    @else
        <ul class="list-group mb-3" style="list-style: none; padding-left: 0;">
            @foreach($transaksi as $item)
                <li class="d-flex justify-content-between align-items-center" style="margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/products/' . $item->product->gambar) }}" alt="{{ $item->product->nama_kue }}" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 8px;">
                        <div>
                            {{ $item->product->nama_kue }} - {{ $item->product->varian_kue }} 
                            (x{{ (int) ($item->total_harga / $item->product->harga) }})
                        </div>
                    </div>
                    <div>
                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mb-3 text-end">
            <strong>Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>
        </div>

        <div>
            <a href="{{ route('user.pembayaran.index') }}" class="btn">
                Bayar Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
