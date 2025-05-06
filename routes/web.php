<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\KeranjangController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

// Redirect setelah login
Route::get('/redirect-dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('redirect.dashboard');

// Admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Produk
    Route::get('/produk', [ProductController::class,'index']);
    Route::get('/produk/create',[ProductController::class, 'create']);
    Route::post('/produk', [ProductController::class, 'store']);
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit']);
    Route::put('produk/{id}', [ProductController::class, 'update']);
    Route::delete('/produk/{id}', [ProductController::class, 'destroy']);

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class,'index']);
    Route::get('/keranjang/create',[KeranjangController::class, 'create']);
    Route::post('/keranjang', [KeranjangController::class, 'store']);
    Route::get('/keranjang/{id}/edit', [KeranjangController::class, 'edit']);
    Route::put('keranjang/{id}', [KeranjangController::class, 'update']);
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy']);

    // Profil
    Route::get('/profil', [ProfilController::class,'index']);
    Route::get('/profil/create',[ProfilController::class, 'create']);
    Route::post('/profil', [ProfilController::class, 'store']);
    Route::get('/profil/{id}/edit', [ProfilController::class, 'edit']);
    Route::put('profil/{id}', [ProfilController::class, 'update']);
    Route::delete('/profil/{id}', [ProfilController::class, 'destroy']);

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class,'index']);
    Route::get('/transaksi/create',[TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class,'index']);
    Route::get('/pembayaran/create',[PembayaranController::class, 'create']);
    Route::post('/pembayaran', [PembayaranController::class, 'store']);
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit']);
    Route::put('pembayaran/{id}', [PembayaranController::class, 'update']);
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__.'/auth.php';
