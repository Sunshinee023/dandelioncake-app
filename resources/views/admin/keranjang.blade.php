@extends('layouts.app')

@section('content')
<h1 class="mb-5" class="text-center">TABEL KERANJANG</h1>

@if (session()->has('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<a href="{{ route('admin.keranjang.create') }}" class="btn btn-primary mb-2">+ Tambah Data</a>
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;" align-items= "center">
    <table class="table table-bordered table-striped table-hover align-middle">
    <thead class="table-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Pelanggan</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Total Harga</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($keranjang as $item)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $item->pelanggan_name }}</td> 
        <td>{{ optional($item->product)->nama_kue ?? '-' }}</td>     
        <td>{{ $item->jumlah }}</td>
        <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
        <td>
          <a href="{{ route('admin.keranjang.edit', $item->id) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('admin.keranjang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6" class="text-center">Tidak ada data keranjang.</td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
