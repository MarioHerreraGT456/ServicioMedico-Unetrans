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
        $table->string('apellido'); // Nuevo campo
        $table->enum('tipo', ['V', 'E']);
       $table->integer('cedula')->unique();
       $table->date('fecha_nacimiento'); // Nuevo campo
       $table->enum('sexo', ['Masculino', 'Femenino']); // Nuevo campo (solo esos valores)
       $table->enum('estado_civil', ['Casado(a)', 'Soltero(a)', 'Divorciado(a)', 'Viudo(a)']);
       $table->enum('categoria', ['estudiante', 'personal']);
       $table->string('correo')->unique();
       $table->string('direccion');
       $table->string('telefono', 11);
       $table->string('foto')->nullable();
       $table->string('password');
       $table->string('sesion')->nullable();
       $table->timestamps();

       $table->foreign('cedula')->references('cedula')->on('personas')->onDelete('cascade');
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
