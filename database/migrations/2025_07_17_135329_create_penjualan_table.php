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
        Schema::create('penjualan', function (Blueprint $table) {
        $table->increments('id_transaksi');
        $table->unsignedInteger('id_pelanggan')->nullable();
        $table->date('tgl_transaksi');
        $table->integer('total_harga');
        $table->timestamps();

        $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
