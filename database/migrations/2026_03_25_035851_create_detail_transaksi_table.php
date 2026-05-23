<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            // 🔗 Kunci Asing ke Tabel Transaksi
            $table->foreignId('transaksi_id')
                  ->constrained('transaksi')
                  ->onDelete('cascade'); // Kalau Transaksi dihapus, rinciannya ikut terhapus
            
            // 🔗 Kunci Asing ke Tabel Menu
            $table->foreignId('menu_id')
                  ->constrained('menu')
                  ->onDelete('cascade'); // Kalau Menu dihapus, rinciannya ikut terhapus
            
            // 📦 Data Tambahan
            $table->integer('jumlah');       // Isi: Berapa porsi yang dipesan
            $table->integer('sub_total');    // ⚠️ INI YANG DITAMBAHKAN: Harga x Jumlah
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};