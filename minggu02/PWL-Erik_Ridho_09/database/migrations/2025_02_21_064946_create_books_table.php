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
        Schema::create('books', function (Blueprint $table) { //pada percobaan ini, kode ini digunakan untuk membuat table bernama book.
            $table->id(); //id digunakan untuk memberikan nomer secara otomatis
            $table->string('judul'); //kolom ini digunakan memberikan judul pada objek
            $table->string('penerbit'); //kolom ini digunakan untuk memberikan keterangan dari buku
            $table->integer('jumlah_halaman'); //kolom ini digunakan untuk memberikan jumlah halaman dari buku
            $table->timestamps(); //digunakan untuk memberikan 2 kolom yang berisikan waktu yang berbeda
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
