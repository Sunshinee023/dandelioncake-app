@extends('layouts.app')

@section('content')
<center><h1 class="mb-5">TABLE KERANJANG</h1></center>
@if (session()->has('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
@endif
<a href="/keranjang/create" class="btn btn-primary mb-2">+Tambah Data</a>
<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Pelanggan ID</th>
        <th scope="col">Produk ID</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Total Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    @foreach ($keranjang as $item)
      <tbody>
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->pelanggan_id }}</td>
          <td>{{ $item->produk_id }}</td>
          <td>{{ $item->jumlah }}</td>
          <td>{{ $item->total_harga }}</td>
          <td>
            <a href="/keranjang/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
            <form action="/keranjang/{{ $item->id }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      </tbody>
    @endforeach
  </table>
@endsection
