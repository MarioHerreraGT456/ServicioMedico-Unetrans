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
    Schema::create('medicos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->integer('cedula')->unique();
        $table->string('correo')->unique();
        $table->enum('cargo', ['jefe', 'asistente']);
        $table->enum('especialidad', ['medicina general', 'odontologia', 'psiquiatria']);
        $table->string('foto');
        $table->string('password');
        $table->string('sesion')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
