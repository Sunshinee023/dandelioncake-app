<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('pembayaran_id')->constrained('pembayaran')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('product')->onDelete('cascade'); // ✅ tambahkan relasi ke produk
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->decimal('total_harga', 15, 2);
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
