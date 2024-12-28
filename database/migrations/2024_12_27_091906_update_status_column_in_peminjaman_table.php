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
        Schema::table('peminjaman', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->enum('status', ['Dipinjam', 'Diajukan', 'Disetujui'])->default('Dipinjam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            //
            $table->string('status')->nullable();
            $table->dropColumn('status');
        });
    }
};