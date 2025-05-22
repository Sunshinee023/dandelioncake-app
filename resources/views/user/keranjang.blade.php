@extends('layouts.user')

@section('content')
<div class="container">
    @if($keranjang->isEmpty())
        <p>Keranjang Anda kosong.</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Lanjutkan Belanja</a>
    @else
        <form method="POST" id="form-keranjang">
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
                            <td>
                                <input type="checkbox" name="produk_id[]" value="{{ $item->product->id }}" class="produk-checkbox">
                                <input type="hidden" name="jumlah[]" value="{{ $item->jumlah }}">
                            </td>
                            <td><img src="{{ asset('images/products/' . $item->product->gambar) }}" style="width: 80px; height: 80px;"></td>
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

            <div class="d-flex justify-content-between">
                <button type="submit" 
                        formaction="{{ route('user.keranjang.hapusTerpilih') }}" 
                        formmethod="POST" 
                        onclick="return confirm('Yakin hapus produk terpilih?')"
                        class="btn btn-danger">
                    Hapus Produk Terpilih
                </button>

                <button type="submit" 
                        formaction="{{ route('user.transaksi.store') }}" 
                        formmethod="POST" 
                        class="btn btn-primary">
                    Lanjutkan Bayar
                </button>
            </div>
        </form>
    @endif
</div>

<script>
    // Fungsi untuk select/deselect semua checkbox
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.produk-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    // Validasi sebelum submit form
    document.getElementById('form-keranjang').addEventListener('submit', function(e) {
        const checked = document.querySelectorAll('.produk-checkbox:checked');
        if (checked.length === 0) {
            e.preventDefault();
            alert('Silakan pilih produk terlebih dahulu.');
        }
    });
</script>
@endsection
