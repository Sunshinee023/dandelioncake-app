@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container mt-5">
    <div class="alert alert-success">
        Selamat datang, {{ session('user_name') }}! Anda login sebagai <strong>User</strong>.
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Dashboard User</h4>
        </div>
        <div class="card-body">
            <p>Ini adalah halaman dashboard</p>

            <ul class="list-group">
                <li class="list-group-item">Akses produk</li>
                <li class="list-group-item">Riwayat transaksi</li>
                <li class="list-group-item">Ubah profil</li>
                <li class="list-group-item">Hubungi admin</li>
            </ul>

            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>
        </div>
    </div>
</div>
@endsection
