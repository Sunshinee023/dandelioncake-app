@extends('layouts.app')

@section('content')
<center><h1 class="mb-5">TABLE PELANGGAN</h1></center>
@if (session()->has('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
@endif
<a href="/profil/create" class="btn btn-primary mb-2">+Tambah Data</a>
<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Telepon</th>
        <th scope="col">Role</th>
        <th>Aksi</th>
      </tr>
    </thead>
    @foreach ($profil as $item)
      <tbody>
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->alamat }}</td>
          <td>{{ $item->telepon }}</td>
          <td>{{ $item->role }}</td>
          <td>
            <a href="/profil/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
            <form action="/profil/{{ $item->id }}" method="POST" class="d-inline">
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
