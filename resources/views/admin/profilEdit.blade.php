@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PROFIL</h1></center>
        <form action="{{ route('admin.profil.update', $profil->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="gambar">Pilih Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">

                @if(isset($profil->gambar))
                    <div class="mt-2">
                        <label>Gambar Saat Ini:</label><br>
                        <img src="{{ asset('images/profil/'.$profil->gambar) }}" alt="Gambar Profil" 
                            style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="user_id">Nama Pelanggan</label>
                <select class="form-select" name="user_id" id="user_id" required>
                    <option disabled>-- Pilih User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $profil->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ old('alamat', $profil->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="telepon">Telepon</label>
                <input class="form-control" type="text" name="telepon" id="telepon" value="{{ old('telepon', $profil->telepon) }}">
            </div>

            <div class="mb-3">
                <label for="role">Role</label>
                <select class="form-select" name="role" id="role" required>
                    <option value="customer" {{ $profil->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ $profil->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">UBAH PROFIL</button>
        </form>
    </div>
</div>
@endsection
