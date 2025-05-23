<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductuserController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\User\ProfileuserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\PencarianController;
use App\Http\Controllers\Admin\KeranjangController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\User\TransaksiuserController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\User\PembayaranuserController;
use App\Http\Controllers\User\HalamanUtamaController;
use App\Http\Controllers\User\KeranjanguserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;


Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('auth.login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login.submit');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('auth.register');

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register.submit');

Route::post('/logout', function () {
    Session::flush();
    return redirect('/login')->with('success', 'Berhasil logout');
})->name('logout');

Route::get('/redirect-dashboard', function () {
    if (!Session::has('user_id')) {
        return redirect()->route('login');
    }

    $role = Session::get('user_role');

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'customer') {
        return redirect()->route('user.dashboard');
    }

    return redirect('/');
})->name('redirect.dashboard');


// Admin routes
Route::middleware(['isAdmin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::get('/produk', [ProductController::class,'index'])->name('produk.index');
    Route::get('/produk/create',[ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class,'index'])->name('keranjang.index');
    Route::get('/keranjang/create',[KeranjangController::class, 'create'])->name('keranjang.create');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::get('/keranjang/{id}/edit', [KeranjangController::class, 'edit'])->name('keranjang.edit');
    Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/create', [ProfilController::class, 'create'])->name('profil.create');
    Route::post('/profil', [ProfilController::class, 'store'])->name('profil.store');
    Route::get('/profil/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/{id}', [ProfilController::class, 'destroy'])->name('profil.destroy');


    // Transaksi
    Route::get('/transaksi', [TransaksiController::class,'index'])->name('transaksi.index');
    Route::get('/transaksi/create',[TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class,'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create',[PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

});

// User routes
Route::middleware(['isCustomer'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/pencarian', [UserDashboardController::class, 'index'])->name('pencarian');

    Route::get('/keranjang', [KeranjanguserController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/store', [KeranjanguserController::class, 'store'])->name('keranjang.store');
    Route::delete('/keranjang/hapusterpilih', [KeranjanguserController::class, 'hapusTerpilih'])->name('keranjang.hapusTerpilih');

    Route::get('/profile', [ProfileuserController::class, 'index'])->name('profile.index');
    Route::get('user/profile/edit', [ProfileuserController::class, 'edit'])->name('profile.edit');
    Route::put('user/profile/update/{id}', [ProfileuserController::class, 'update'])->name('profile.update');

    Route::get('/transaksi', [TransaksiuserController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiuserController::class, 'store'])->name('transaksi.store');
    Route::post('/beli', [TransaksiuserController::class, 'beli'])->name('transaksi.beli');


    // Pembayaran
    Route::get('pembayaran', [PembayaranuserController::class, 'index'])->name('pembayaran.index');
    Route::post('pembayaran/{id}/bayar', [PembayaranuserController::class, 'bayar'])->name('pembayaran.bayar');
    Route::get('/riwayat', [PembayaranuserController::class, 'riwayat'])->name('riwayat.index');



});

