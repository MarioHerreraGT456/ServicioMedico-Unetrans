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
             $table->id(); // Opcional, pero útil como PK interna
        $table->integer('cedula')->unique();
        $table->string('nombre');
        $table->string('apellido');
        $table->enum('tipo', ['V', 'E']);
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
        $table->string('password');  // Solo aquí
        $table->string('sesion')->nullable(); // Solo aquí
        $table->rememberToken();
        $table->timestamps();

        $table->index('cedula'); // Mejora rendimiento en joins
            
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
