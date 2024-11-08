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
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('major');
            $table->foreignId('sports_equipment_id') // Foreign key ke tabel sports_equipment
                  ->constrained('sports_equipment') // Mengacu ke kolom id default
                  ->onDelete('cascade');
            $table->integer('quantity');
            $table->dateTime('borrowed_at');
            $table->dateTime('returned_at'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
