@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush
<div class="container">
    <div class="dashboard-card">
        <div class="dashboard-header">Selamat Datang di Dashboard Admin</div>

        <div class="stats-grid">
            <!-- Kue Paling Laris -->
            <div class="stat-box stat-box-kue">
                <p>Kue Paling Laris</p>
                <h3>{{ $kueTerlaris->nama_produk ?? 'Belum ada data' }}</h3>
                <p>Total Terjual: {{ $kueTerlaris->jumlah_terjual ?? 0 }}</p>
            </div>

            <!-- Total Penjualan -->
            <div class="stat-box stat-box-total">
                <p>Total Penjualan</p>
                <h3>Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="quote-box">
            "Setiap kue yang terjual adalah senyuman untuk pelanggan."
        </div>

        <!-- <img src="{{ asset('img/dashboard-illustration.png') }}" alt="Dashboard Illustration" class="dashboard-img"> -->
    </div>
</div>
@endsection
