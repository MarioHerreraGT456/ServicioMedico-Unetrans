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
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->integer('cedula')->unique(); // referencia a tabla personas
            $table->integer('cedula2')->unique(); // referencia a tabla pacientes
            $table->enum('tipo_personal', ['administrativo', 'obrero', 'docente']);
            $table->timestamps();
            // FK: la nueva cédula referencia a personas (donde se crea el usuario)
        $table->foreign('cedula')->references('cedula')->on('personas')->onDelete('cascade');
        // FK: la cédula del titular referencia a pacientes
        $table->foreign('cedula2')->references('cedula')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_personal');
    }
};
