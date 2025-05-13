@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Keranjang Saya</h2>
    
    <form action="{{ route('user.keranjang.checkout') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="check-all"></th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjangItems as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/'.$item->produk->gambar) }}" alt="Produk" width="60" class="me-2">
                                    <span>{{ $item->produk->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->jumlah }}" class="form-control w-50" min="1">
                            </td>
                            <td>
                                Rp{{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                            </td>
                            <td>
                                <button formaction="{{ route('user.keranjang.update', $item->id) }}" class="btn btn-sm btn-primary">Update</button>
                                <button formaction="{{ route('user.keranjang.destroy', $item->id) }}" formmethod="POST" class="btn btn-sm btn-danger" onclick="return confirm('Hapus item ini?')">
                                    @method('DELETE') @csrf Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <strong>Total: Rp{{ number_format($totalHarga, 0, ',', '.') }}</strong>
            <button type="submit" class="btn btn-success">Checkout</button>
        </div>
    </form>
</div>

<script>
    // Pilih semua checkbox
    document.getElementById('check-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection
