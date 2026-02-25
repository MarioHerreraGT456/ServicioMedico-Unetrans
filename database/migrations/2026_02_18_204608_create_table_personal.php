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
        Schema::create('table_personal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido'); // Nuevo campo
            $table->enum('tipo', ['V', 'E']);
            $table->integer('cedula')->unique(); /*referencia a tabla pacientes*/ 
            $table->integer('cedula2');
            $table->date('fecha_nacimiento'); // Nuevo campo
            $table->enum('sexo', ['Masculino', 'Femenino']); // Nuevo campo (solo esos valores)
            $table->enum('estado_civil', ['Casado(a)', 'Soltero(a)', 'Divorciado(a)', 'Viudo(a)']);
            $table->string('correo')->unique();
            $table->string('direccion');
            $table->string('telefono', 11);
            $table->string('foto')->nullable();
            $table->string('password');
            $table->string('sesion')->nullable();
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
