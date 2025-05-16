<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
     @stack('styles')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Di layout utama (layouts/app.blade.php misalnya) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        .main-navbar {
            background-color: #FFC6C4;
            padding: 10px 0;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #6C362A;
        }

        .navbar-logo img {
            height: 60px;
        }

        .navbar-center {
            flex: 1;
            margin: 0 30px;
        }

        .navbar-center input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
        }

        .navbar-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .navbar-links a {
            color: #6C362A;
            font-weight: 500;
            text-decoration: none;
            font-size: 14px;
            text-transform: uppercase;
        }

        .navbar-links a:hover {
            text-decoration: underline;
            color: white;
        }

        .cart-icon {
            position: relative;
            color:#6C362A;
        }

        .cart-icon .badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: yellow;
            color: #6C362A;
            font-size: 10px;
            padding: 3px 5px;
            border-radius: 50%;
        }

    .btn-baby-blue {
        background-color:hsl(215, 100.00%, 90.00%); 
        color: #000; 
        border: none;
    }
    .btn-baby-blue:hover {
        background-color:rgb(44, 72, 184); 
        color: white; 
    }

    .btn-pink {
        background-color: #FFC6C4; 
        color: #6C362A; 
        border: none;
    }
    .btn-pink:hover {
        background-color: #e0137a; 
        color: white;
    }

    body {
            font-family: 'Poppins', sans-serif;
        }
        .btn-logout {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            color: #fff;
            border-radius: 5px;
            font-size: 13px;
        }

        .btn-logout:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="main-navbar">
            <div class="navbar-container">
                <!-- Logo -->
                <a href="{{ route('user.dashboard') }}" class="navbar-logo">
                    <img src="{{ asset('storage/logo.png') }}" alt="Dandelion Logo">
                </a>

                <!-- Search Bar -->
                <div class="navbar-center">
                    <form action="{{ route('user.pencarian') }}" method="GET">
                        <input type="text" name="q" placeholder="Cari kue favoritmu...">
                    </form>
                </div>

                <!-- Menu -->
                <div class="navbar-links">
                    <a href="{{ route('user.dashboard') }}">Halaman Utama</a>

                    <a href="{{ route('user.keranjang.index') }}" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge">0</span> 
                    </a>

                    <a href="{{ route('user.profile.index') }}">Profil</a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
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
        <div class="container mt-3">
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
