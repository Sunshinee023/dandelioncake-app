<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan'; 

    protected $fillable = ['nama', 'email', 'password', 'alamat', 'telepon', 'role'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}