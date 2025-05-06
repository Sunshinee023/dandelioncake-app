<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id', 'pembayaran_id', 'produk_id', 'total_harga', 'status', 'tanggal_transaksi'
    ];

    // Define the relation to 'product'
    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id'); // Assumes 'produk_id' is the foreign key
    }

    // You already have the other relationships:
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

}
