@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">TABEL PELANGGAN</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.profil.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Foto Profil</th>
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
                        <td>{{ $item->gambar ?? '-' }}</td>
                        <td>{{ $item->user->name ?? 'Tidak ditemukan' }}</td> <!-- Menampilkan nama user -->
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
                        <td colspan="6" class="text-center">Tidak ada data profil.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
