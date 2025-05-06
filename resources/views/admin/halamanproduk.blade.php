@extends('layouts.app')

@section('content')
<center><h1 class="mb-5">TABLE PRODUCT</h1></center>
@if (session()->has('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
@endif
<a href="/produk/create" class="btn btn-primary mb-2">+Tambah Data</a>
<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Kue</th>
        <th scope="col">Varian Kue</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    @foreach ($product as $products)
      <tbody>
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $products->nama_kue }}</td>
          <td>{{ $products->varian_kue }}</td>
          <td>{{ $products->jumlah }}</td>
          <td>{{ $products->harga }}</td>
          <td>
            <a href="/produk/{{ $products->id }}/edit" class="btn btn-warning">Edit</a>
            <form action="/produk/{{ $products->id }}" method="POST" class="d-inline">
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
