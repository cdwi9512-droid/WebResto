<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Ini yang dibenerin tanda ! dan spasinya
        if (!Schema::hasTable('galery')) { 
            Schema::create('galery', function (Blueprint $table) {
                $table->id();
                $table->string('gambar');
                $table->text('keterangan'); // ✅ Ini tadi salah ketik, udah dibenerin
                // ✅ Ini dibenerin: tambah huruf s jadi 'restos'
                $table->foreignId('resto_id')->constrained('restos')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('galery');
    }
};