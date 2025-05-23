<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('product')->onDelete('cascade'); 
            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');
            $table->decimal('total_harga', 15, 2);
            $table->string('metode_pembayaran'); 
            $table->string('alamat_pengiriman');
            $table->enum('status_pembayaran', ['pending','sudah dibayar', 'belum dibayar'])->default('pending');
            $table->timestamp('tanggal_checkout')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }

};
