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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->integer('ronda');
            $table->foreignId('jugador1_id')->constrained('jugadores');
            $table->foreignId('jugador2_id')->constrained('jugadores');
            $table->foreignId('ganador_id')->nullable()->constrained('jugadores');
            $table->enum('estado', ['pendiente', 'jugado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
