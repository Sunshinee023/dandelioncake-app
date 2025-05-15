@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

<div class="card">
    <h1>Edit Data Keranjang</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.keranjang.update', $keranjang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="pelanggan_id">Nama Pelanggan</label>
        <select name="pelanggan_id" id="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            @foreach ($pelanggan as $p)
                <option value="{{ $p->id }}" {{ $keranjang->pelanggan_id == $p->id ? 'selected' : '' }}>
                    {{ $p->user->name ?? 'Tidak ditemukan' }}
                </option>
            @endforeach
        </select>

        <select name="produk_id" id="produk_id" required>
            <option value="">-- Pilih Produk --</option>
            @foreach ($product as $prod)
                <option 
                    value="{{ $prod->id }}"
                    {{ $keranjang->produk_id == $prod->id ? 'selected' : '' }}>
                    {{ $prod->nama_kue }}
                </option>
            @endforeach
        </select>

        <label>Nama Produk:</label>
        <p id="previewNamaProduk" style="margin-top: -10px;">
            {{ $keranjang->product->nama_kue ?? '-' }}
        </p>

        <img id="previewGambarProduk" 
            src="{{ $keranjang->product && $keranjang->product->gambar ? asset('storage/' . $keranjang->product->gambar) : '' }}" 
            alt="Preview Gambar Produk" 
            style="max-width: 100%; height: auto; {{ $keranjang->product && $keranjang->product->gambar ? '' : 'display:none;' }} border-radius: 6px; margin-bottom: 15px;">

        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" min="1" value="{{ $keranjang->jumlah }}" required>

        <label for="total_harga">Total Harga</label>
        <input type="number" name="total_harga" id="total_harga" value="{{ $keranjang->total_harga }}" required>

        <button type="submit" class="btn">Update</button>
        <a href="{{ route('admin.keranjang.index') }}" >Kembali</a>
    </form>
</div>

<script>
document.getElementById('product_id').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const nama = selected.getAttribute('data-nama');
    const gambar = selected.getAttribute('data-gambar');

    document.getElementById('previewNamaProduk').innerText = nama || '-';

    const img = document.getElementById('previewGambarProduk');
    if (gambar) {
        img.src = gambar;
        img.style.display = 'block';
    } else {
        img.style.display = 'none';
    }
});
</script>
@endsection
