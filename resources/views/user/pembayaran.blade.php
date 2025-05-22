@extends('layouts.user')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

<div class="profile-edit-page">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4 class="mb-4 text-center">Detail Pembayaran</h4>

    <p class="mb-4 text-center"><strong>Nama Pelanggan:</strong> {{ $pelanggan->user->name }}</p>
    <p class="mb-4 text-center"><strong>Email:</strong> {{ $pelanggan->user->email }}</p>
    <p class="mb-4 text-center"><strong>No. Telepon:</strong> {{ $pelanggan->telepon }}</p>

    <hr>

    <h5 class="mb-3">Transaksi Belum Dibayar</h5>

    @if($transaksi->isEmpty())
        <div class="alert alert-warning">Tidak ada transaksi yang belum dibayar.</div>
    @else
        @foreach($transaksi as $trx)
            <div class="card mb-4 p-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/products/' . $trx->product->gambar) }}" 
                         alt="{{ $trx->product->nama_kue }}" 
                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; margin-right: 15px; border: 2px solid #FFC6C4;">
                    <div style="flex: 1">
                        <p><strong>Nama Produk:</strong> {{ $trx->product->nama_kue }}</p>
                        <p><strong>Varian:</strong> {{ $trx->product->varian_kue ?? '-' }}</p>
                        <p><strong>Total Harga:</strong> Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($trx->status) }}</p>

                        <form action="{{ route('user.pembayaran.bayar', $trx->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-2">
                                <label for="metode_pembayaran_{{ $trx->id }}">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select" required onchange="toggleDetailInput(this, {{ $trx->id }})">
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="COD">COD</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                </select>
                            </div>

                            <div class="mb-3" id="detail_metode_{{ $trx->id }}" style="display: none;">
                                <label>Detail Metode</label>
                                <input type="text" name="detail_metode" class="form-control" placeholder="Contoh: Dana - 08123456789">
                            </div>

                            <button type="submit" class="btn mt-2">Bayar Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
    function toggleDetailInput(selectElement, trxId) {
        const selected = selectElement.value;
        const detailInput = document.getElementById('detail_metode_' + trxId);
        detailInput.style.display = (selected === 'E-Wallet' || selected === 'Transfer Bank') ? 'block' : 'none';
    }
</script>
@endsection
