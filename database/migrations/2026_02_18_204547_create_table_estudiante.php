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
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cedula');
            $table->enum('carrera', ['administracion', 'contaduria', 'civil', 'electricidad', 'electronica', 'instrumentos', 'informatica', 'industrial', 'automotriz', 'pq', 'calidad', 'quimica', 'materiales','medico'])->nullable();
            $table->timestamps();
            $table->foreign('cedula')->references('cedula')->on('pacientes')->onDelete('cascade');
          
        });

        /*referencia a la tabla pacientes,*/ 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_estudiante');
    }
};
