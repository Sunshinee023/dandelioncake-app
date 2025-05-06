@extends('layouts.app')

@section('content')
<div class="container">
    <center><h1 class="mb-4">Daftar Pembayaran</h1></center>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="/pembayaran/create" class="btn btn-primary mb-3">+ Tambah Data</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Alamat Pengiriman</th>
                    <th>Status</th>
                    <th>Tanggal Checkout</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pelanggan->nama ?? 'Tidak ditemukan' }}</td>
                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $item->metode_pembayaran }}</td>
                    <td>{{ $item->alamat_pengiriman }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $item->status == 'pending' ? 'secondary' : 
                            ($item->status == 'diproses' ? 'warning' : 
                            ($item->status == 'dikirim' ? 'info' : 'success')) }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_checkout)->format('d M Y H:i') }}</td>
                    <td>
                        <a href="/pembayaran/{{ $item->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form action="/pembayaran/{{ $item->id }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection