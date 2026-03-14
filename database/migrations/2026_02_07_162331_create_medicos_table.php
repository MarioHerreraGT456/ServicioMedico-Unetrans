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
        $table->bigInteger('cedula')->unique(); // Relación con personas
        $table->enum('cargo', ['jefe', 'medico', 'asistente']);
        $table->enum('especialidad', ['general', 'odontologia', 'psiquiatria', 'fisiatria', 'traumatologia']);
        $table->timestamps();

        // Clave foránea
        $table->foreign('cedula')
              ->references('cedula')
              ->on('personas')
              ->onDelete('cascade');
        
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
