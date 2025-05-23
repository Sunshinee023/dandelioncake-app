@extends('layouts.user')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

<div class="card profile-edit-page">
    <h4 class="mb-4 text-center">Edit Profil</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror

        <label for="gambar">Foto Profil (jpg/png)</label>
        <input type="file" id="gambar" name="gambar">
        @if($user->pelanggan && $user->pelanggan->gambar)
            <small>Gambar saat ini:</small><br>
            <img src="{{ asset('images/profil/' . $user->pelanggan->gambar) }}" alt="Foto Profil" style="width: 100px; border-radius: 50%; margin-top: 5px;">
        @endif
        @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror
<br>
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat">{{ old('alamat', $user->pelanggan->alamat ?? '') }}</textarea>
        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $user->pelanggan->telepon ?? '') }}">
        @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror

        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="{{ route('user.profile.index') }}" class="btn-secondary">Batal</a>
    </form>
</div>

@endsection


