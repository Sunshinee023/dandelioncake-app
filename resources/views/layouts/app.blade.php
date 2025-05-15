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
    
    <!-- Custom Styling -->
     
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap'); /* font mirip Lulus */

.navbar {
  font-family: 'poppins';
  border-bottom: 1px solid #ddd;
  background-color: #FFC6C4;
  padding: 10px 30px;
}

.navbar-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 10px;

}

.shop-cake {
  font-size: 13px;
  color: #555;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 5px;
}

.reload-icon {
  font-size: 12px;
}

.logo {
  font-family: 'Great Vibes', cursive;
  font-size: 36px;
  color: black;
}

.navbar-icons {
  display: flex;
  align-items: center;
  gap: 10px;
}

.search {
  border: none;
  border-bottom: 1px solid #ccc;
  padding: 5px;
  outline: none;
}

.navbar-bottom {
  display: flex;
  justify-content: center;
  padding-top: 10px;
  border-top: 1px solid #f0f0f0;
}

.navbar-links a {
  margin: 0 15px;
  text-decoration: none;
  color: #6C362A;
  font-weight: 600;
  font-size: 14px;
  transition: color 0.3s ease;
}

.navbar-links a:hover {
  color: #f0f0f0;
}
.btn-logout {
        color: white;
        background-color: #dc3545; /* Bootstrap red */
        border: none;
        padding: 8px 12px;
        font-size: 13px;
        border-radius: 4px;
        cursor: pointer;
        font-family: 'poppins';
    }

.btn-logout:hover {
    background-color: #b02a37; 
} 


    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
<!-- Custom Navbar -->
<!-- Navbar -->
<div class="navbar">
  <div class="navbar-top">
    <a href="#" class="shop-cake"><i class="reload-icon">⟳</i> CAKE SHOP</a>
    <div class="logo">dandelion cake</div>
    <div class="navbar-icons">
      <!-- <input type="text" class="search" placeholder="Search" />
      <i class="icon">🔍</i> -->
      <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </div>
  </div>

  <div class="navbar-bottom">
    <div class="navbar-links">
      <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a href="{{ route('admin.produk.index') }}">Manajemen Produk</a>
      <a href="{{ route('admin.keranjang.index') }}">Manajemen Keranjang</a>
      <a href="{{ route('admin.profil.index') }}">Manajemen Pelanggan</a>
      <a href="{{ route('admin.transaksi.index') }}">Manajemen Transaksi</a>
      <a href="{{ route('admin.pembayaran.index') }}">Manajemen Pembayaran</a>
    </div>

    <!-- Logout -->
        
  </div>
</div>
    </div>
</nav>

                <!-- Main Content -->
                <div class="col-md-9">
                    <main>
                        @yield('content')
                        <table class="table table-dark table-striped text-center" text-align="center">
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
