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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        .main-navbar {
            background-color: #F9A7C2; /* Pink Coquette */
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo img {
            height: 100px;
        }

        .navbar-links {
            display: flex;
            gap: 25px;
            justify-content: center;
            flex: 1;
        }

        .navbar-links a {
            text-decoration: none;
            color: #fff; /* White for better contrast on pink */
            font-size: 14px;
            font-weight: 400;
            text-transform: uppercase;
        }

        .navbar-links a:hover {
            color: #1e1e1e;
            font-weight: 500;
        }

        .btn-logout {
            color: white;
            background-color: #dc3545; /* Bootstrap red */
            border: none;
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #b02a37; /* darker red */
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="main-navbar">
            <div class="navbar-container">
                <!-- Logo -->
                <a class="navbar-logo">
                    <img src="{{ asset('storage/logo.png') }}" alt="Logo">
                </a>

                <!-- Menu -->
                <div class="navbar-links">
                    <a href="{{ route('user.home') }}">Halaman Utama</a>
                    <a href="{{ route('user.keranjang') }}">Keranjang</a>
                    <a href="{{ route('user.pencarian') }}">Pencarian</a>
                    <a href="{{ route('user.profile') }}">Profil</a>
                </div>

                <!-- Logout -->
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Optional Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <div class="container">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
