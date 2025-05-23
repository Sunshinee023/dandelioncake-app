<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-logo img {
            text-align: center;
            height: 100px;
            padding: 5px 0;
        }
        .btn-pink {
            background-color: #FFC6C4 !important;
            color: #6C362A !important;
            border: none !important;
        }

        .btn-pink:hover {
            background-color: #d81b60 !important;
            color: #ffffff !important;
        }

    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <a class="navbar-logo text-center">
                    <img src="{{ asset('storage/logo.png') }}" alt="Logo">
                </a>
                <div class="card-header text-center">
                    <h4>Selamat Datang!</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" name="email" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <div class="mt-3 text-center">
                            <p>Belum punya akun? <a href="{{ route('auth.register') }}">Daftar di sini</a></p>
                        </div>

                        <button type="submit" class="btn btn-pink w-100">Masuk</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <small>&copy; {{ date('Y') }} Toko Kue</small>
            </div>
        </div>
    </div>
</div>

</body>
</html>
