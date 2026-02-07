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
    Schema::create('pacientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->integer('cedula')->unique();
        $table->string('estado_civil');
        $table->string('correo')->unique();
        $table->string('direccion');
        $table->string('telefono', 11); // Longitud fija de 11
        $table->string('foto')->nullable();
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
        Schema::dropIfExists('pacientes');
    }
};
