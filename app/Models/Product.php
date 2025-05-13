<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = ['gambar', 'nama_kue', 'varian_kue', 'stok', 'harga'];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'produk_id');
    }

}
