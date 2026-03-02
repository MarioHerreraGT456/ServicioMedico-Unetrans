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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('tipo', ['V', 'E']);
            $table->integer('cedula')->unique();
            $table->enum('sexo', ['masculino', 'femenino']);
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->enum('estado_civil', ['Casado(a)', 'Soltero(a)', 'Divorciado(a)', 'Viudo(a)']);
            $table->string('correo')->unique();
            $table->string('direccion');
            $table->string('telefono', 11);
            $table->enum('rol', ['medico', 'paciente']);
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('password');
            $table->string('sesion')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
