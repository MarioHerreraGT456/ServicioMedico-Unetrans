<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especiales', function (Blueprint $table) {

            $table->id();

            // 🔹 IDENTIDAD (como personas, pero sin unique)
            $table->bigInteger('cedula');

            $table->string('nombre');
            $table->string('nombre2');
            $table->string('apellido');
            $table->string('apellido2');

            $table->enum('tipo', ['V', 'E']);
            $table->enum('sexo', ['masculino', 'femenino']);
            $table->date('fecha_nacimiento');

            $table->enum('estado_civil', [
                'Casado(a)',
                'Soltero(a)',
                'Divorciado(a)',
                'Viudo(a)'
            ]);

            $table->string('correo'); // SIN unique (puede repetirse con personas)

            $table->string('direccion');

            $table->enum('codigo', ['0414', '0424', '0412', '0416', '0426']);
            $table->string('telefono', 7);

            // 🔐 LOGIN SEPARADO
            $table->string('password');

            // 🔹 DATOS MÉDICOS
            $table->enum('cargo', ['jefe', 'medico', 'asistente']);
            $table->enum('rol', ['especial']);
            $table->enum('especialidad', [
                'general',
                'odontologia',
                'psiquiatria',
                'fisiatria',
                'traumatologia'
            ]);
            
            // 🔹 ESTADO
            $table->boolean('estado')->default(true);

            // 🔹 OTROS
            $table->string('foto')->nullable();

            $table->timestamps();

            // índice para búsquedas
            $table->index('cedula');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especiales');
    }
};