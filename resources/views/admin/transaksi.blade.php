@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Daftar Transaksi</h2>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="/transaksi/create" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Produk</th> {{-- ✅ Tambahan kolom produk --}}
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Status Transaksi</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pelanggan->nama ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $item->product->nama ?? '-' }}</td> {{-- ✅ Tampilkan nama produk --}}
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') }}</td>
                        <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge 
                                @if ($item->status == 'pending') bg-secondary
                                @elseif ($item->status == 'diproses') bg-warning
                                @elseif ($item->status == 'dikirim') bg-info
                                @elseif ($item->status == 'selesai') bg-success
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->pembayaran->metode_pembayaran ?? '-' }}</td>
                        <td>{{ $item->pembayaran->status ?? '-' }}</td>
                        <td>
                            <a href="/transaksi/{{ $item->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                            <form action="/transaksi/{{ $item->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
