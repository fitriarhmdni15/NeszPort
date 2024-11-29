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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->string('nama_peminjam')->nullable();
            $table->string('kelas_jurusan')->nullable();
            $table->integer('jumlah_peminjaman');
            $table->timestamp('tanggal_peminjaman');
            $table->enum('status', ['Dipinjam', 'Dikembalikan'])->default('Dipinjam'); // Status peminjaman
            $table->string('bukti_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
