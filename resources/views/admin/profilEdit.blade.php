@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PROFIL</h1></center>
        <form action="{{ route('admin.profil.update', $profil->id) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Nama User (user_id) -->
            <div class="mb-3">
                <label for="user_id">Nama User</label>
                <select class="form-select" name="user_id" id="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $profil->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat">{{ $profil->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label for="telepon">Telepon</label>
                <input class="form-control" type="text" name="telepon" id="telepon" value="{{ $profil->telepon }}">
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
