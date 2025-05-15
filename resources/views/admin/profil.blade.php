@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
@endpush

<div class="card-header">
    <h1>DAFTAR PELANGGAN</h1>
    <a href="{{ route('admin.profil.create') }}" class="btn btn-primary">+ Tambah Data</a>
</div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
<div class="container-fluid d-flex justify-content-center">
        
        <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto Profil</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($profil as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('images/profil/' . $item->gambar) }}" alt="Foto Profil" 
                                    style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->user->name ?? 'Tidak ditemukan' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td>{{ $item->telepon ?? '-' }}</td>
                        <td>{{ ucfirst($item->role) }}</td>
                        <td>
                            <a href="{{ route('admin.profil.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.profil.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus profil ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data profil.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        
    </div>
@endsection
