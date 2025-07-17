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
        Schema::create('barang', function (Blueprint $table) {
        $table->increments('id_barang');
        $table->string('namabarang', 35);
        $table->integer('harga_barang');
        $table->integer('stok');
        $table->string('foto_barang')->nullable(); // tambahan sesuai permintaan
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
