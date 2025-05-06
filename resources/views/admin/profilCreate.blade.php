@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>TAMBAH DATA PROFIL</h1></center>
        <form action="/profil" method="post">
            @csrf

            <div class="mb-3">
                <label for="nama">Nama</label>
                <input class="form-control" type="text" name="nama" id="nama" required>
            </div>

            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"></textarea>
            </div>

            <div class="mb-3">
                <label for="telepon">Telepon</label>
                <input class="form-control" type="text" name="telepon" id="telepon">
            </div>

            <div class="mb-3">
                <label for="role">Role</label>
                <select class="form-select" name="role" id="role" required>
                    <option value="customer" selected>Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">TAMBAH PROFIL</button>
        </form>
    </div>
</div>
@endsection
