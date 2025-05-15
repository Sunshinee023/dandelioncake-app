<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pelanggan_id',
        'produk_id',
        'transaksi_id',
        'total_harga',
        'metode_pembayaran',
        'alamat_pengiriman',
        'status_pembayaran',
        'tanggal_checkout',
    ];

    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id'); 
    }

    public function getPelangganNameAttribute()
    {
        return $this->pelanggan->user->name;  
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
