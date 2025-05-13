<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable = [
        'pelanggan_id', 
        'produk_id', 
        'tanggal_transaksi',
        'total_harga', 
        'status', 
    ];

    // Define the relation to 'product'
    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id'); // Assumes 'produk_id' is the foreign key
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id'); // Menghubungkan dengan tabel pelanggan
    }

    // Mendapatkan nama pelanggan dari tabel users
    public function getPelangganNameAttribute()
    {
        return $this->pelanggan->user->name;  // Mengambil nama dari tabel users
    }

}
