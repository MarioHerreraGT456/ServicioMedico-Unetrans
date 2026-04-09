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
        Schema::create('table_consultas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nombre2');
            $table->string('apellido');
            $table->string('apellido2');
            $table->enum('tipo', ['V', 'E']);
            $table->bigInteger('cedula'); /*referencia a tabla pacientes*/ 
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->date('fecha_nacimiento'); 
            $table->date('fecha_consulta'); 
            $table->string('nombre_doctor');
            $table->string('especialidad');
            $table->integer('TA');
            $table->string('motivo');
            $table->string('tratamiento');
            $table->enum('estado', ['pendiente', 'completada'])
            ->default('pendiente');
            $table->enum('visitante', ['si', 'no'])->default('no');
            $table->enum('tipo_consulta', ['niños', 'parto', 'pesquisa', 'vital', 'otros'])->nullable();
            $table->timestamps();
            // $table->foreign('cedula')->references('cedula')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_consultas');
    }
};
