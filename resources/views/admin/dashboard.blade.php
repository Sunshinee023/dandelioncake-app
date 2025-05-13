@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Selamat Datang di Dashboard Admin</h2>

    <div class="row mb-5">
        <!-- Kue Terlaris -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h5 class="text-muted">Kue Paling Laris</h5>
                <h3 class="text-primary mt-2">{{ $kueTerlaris->nama_produk ?? 'Belum ada data' }}</h3>
                <p class="text-success">Total Terjual: {{ $kueTerlaris->jumlah_terjual ?? 0 }}</p>
            </div>
        </div>

        <!-- Total Penjualan -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h5 class="text-muted">Total Penjualan</h5>
                <h3 class="text-primary mt-2">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Pemanis Dashboard -->
    <div class="card text-center border-0 shadow p-5" style="background-color: #fff0f5;">
        <h4 class="mb-3">✨ Tetap Semangat Menjual ✨</h4>
        <p class="mb-0">"Setiap kue yang terjual adalah senyuman untuk pelanggan."</p>
        <img src="/images/dashboard-sweet.png" alt="Dashboard Illustration" style="max-height: 200px;" class="mt-3">
    </div>
</div>
@endsection
