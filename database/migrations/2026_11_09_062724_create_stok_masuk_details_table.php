<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_masuk_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->restrictOnDelete();

            $table->foreignId('transaksi_id')
                ->constrained('transaksis')
                ->restrictOnDelete();

            $table->unsignedInteger('jumlah_masuk');
            $table->unsignedInteger('sisa_stok');

            $table->decimal('harga_beli', 15, 2)->default(0);

            $table->date('tanggal_masuk');

            $table->timestamps();

            $table->index(['barang_id', 'tanggal_masuk', 'id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_masuk_details');
    }
};