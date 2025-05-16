@extends('layouts.user')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($keranjang->isEmpty())
        <p>Keranjang Anda kosong.</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Lanjutkan Belanja</a>
    @else
    <form action="{{ route('user.keranjang.store') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Varian</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($keranjang as $item)
                @php
                    $subtotal = $item->jumlah * $item->product->harga;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td><input type="checkbox" name="selected_items[]" value="{{ $item->id }}"></td>
                    <td><img src="{{ asset('images/products/' . $item->product->gambar) }}" alt="{{ $item->product->nama_kue }}" style="width: 80px; height: 80px; object-fit: cover;"></td>
                    <td>{{ $item->product->nama_kue }}</td>
                    <td>{{ $item->product->varian_kue }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->product->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-end fw-bold">Total</td>
                    <td class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('user.keranjang.hapusTerpilih') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item yang dipilih?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        
        <form action="{{ route('user.transaksi.keranjangBayar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Lanjutkan Belanja</button>
        </form>
    </form>
    @endif
</div>
@endsection

<script>
function incrementQty(button) {
    const input = button.parentElement.querySelector('.qty-input');
    input.stepUp();
}

function decrementQty(button) {
    const input = button.parentElement.querySelector('.qty-input');
    if (parseInt(input.value) > 1) {
        input.stepDown();
    }
}
</script>
