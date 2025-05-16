@extends('layouts.user')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endpush
<div class="profile-page">

    <div class="profile-card">
        <div class="profile-left">
            <div class="card">
                @if($user->pelanggan && $user->pelanggan->gambar)
                <img src="{{ asset('images/profil/' . $user->pelanggan->gambar) }}" class="profile-img" alt="Foto Profil">
            @else
                <div class="profile-img default-img"></div>
            @endif
                <h2>{{ $user->name ?? 'Tidak ditemukan' }}</h2>
                {{-- Jika kamu punya role di user --}}
                <p class="role">{{ ucfirst($user->role ?? 'user') }}</p>
                <div class="social-icons">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-linkedin-in"></i>
                    <i class="fab fa-instagram"></i>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <h1>HALO<span>!!</span></h1>
            <h5>Pencinta kue dan rebahan profesional</h5>
            <div class="btn-group">
                <a href="{{ route('user.profile.update', $user->id) }}" class="btn-resume">Edit</a>
               
            </div>
            <p>{{ $user->pelanggan->alamat ?? '-' }}</p>
            <p>{{ $user->pelanggan->telepon ?? '-' }}</p>
        </div>
    </div>

</div>
@endsection
