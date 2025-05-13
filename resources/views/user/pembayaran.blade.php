<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h4 class="mb-4">Konfirmasi Pembayaran</h4>
            <form action="{{ route('user.pembayaran.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="metode" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" name="metode_pembayaran" required>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="e-wallet">E-Wallet</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Pengiriman</label>
                    <textarea name="alamat_pengiriman" class="form-control" required>{{ old('alamat_pengiriman') }}</textarea>
                </div>

                <input type="hidden" name="total" value="{{ $total }}"> {{-- Kirim total dari checkout --}}

                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
            </form>
        </div>
    </div>
</x-app-layout>
