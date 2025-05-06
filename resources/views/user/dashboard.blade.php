@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Peningkatan Penjualan Bulan Ini</div>
                <div class="card-body">
                    <h3>{{ $peningkatanPenjualan }}%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Kue Terlaris</div>
                <div class="card-body">
                    <h4>{{ $kueTerlaris }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Pelanggan Loyal</div>
                <div class="card-body">
                    <h4>{{ $pelangganLoyal }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Status Pesanan</div>
                <div class="card-body">
                    <ul>
                        <li>Proses: {{ $statusPesanan['proses'] }}</li>
                        <li>Selesai: {{ $statusPesanan['selesai'] }}</li>
                        <li>Batal: {{ $statusPesanan['batal'] }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Grafik Tren Keuangan (6 Bulan)</div>
                <div class="card-body">
                    <canvas id="keuanganChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">Jam Sibuk Toko (Hari Ini)</div>
                <div class="card-body">
                    <canvas id="jamSibukChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Tren Keuangan
    var ctx1 = document.getElementById('keuanganChart').getContext('2d');
    var keuanganChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($labelBulan),
            datasets: [{
                label: 'Total Penjualan',
                data: @json($dataKeuangan),
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        }
    });

    // Grafik Jam Sibuk Toko
    var ctx2 = document.getElementById('jamSibukChart').getContext('2d');
    var jamSibukChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: @json($jamLabels),
            datasets: [{
                label: 'Jumlah Pembelian',
                data: @json($jumlahPembelianPerJam),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Jam'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Pembelian'
                    }
                }
            }
        }
    });
</script>
@endpush
