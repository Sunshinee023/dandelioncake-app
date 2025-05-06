<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content with Sidebar -->
            <div class="container-fluid mt-4">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 mb-4">
                        <div class="bg-white border rounded p-3 shadow-sm">
                            <h5 class="mb-3">Menu Admin</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/produk') }}">Manajemen Produk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/keranjang') }}">Manajemen Keranjang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/profil') }}">Manajemen Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/transaksi') }}">Manajemen Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/pembayaran') }}">Manajemen Pembayaran</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-9">
                        <main>
                            {{ $slot }}
                        </main>
                    </div>
                </div>
            </div>
        </div>

       
    </body>
</html>
