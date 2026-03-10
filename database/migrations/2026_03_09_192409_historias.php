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
        Schema::create('historias', function (Blueprint $table) {
        $table->id(); // Opcional, pero útil como PK interna
        $table->bigInteger('cedula');
        $table->string('nombre');
        $table->string('apellido');
        $table->enum('tipo', ['V', 'E']);
        $table->enum('sexo', ['masculino', 'femenino']);
        $table->date('fecha_nacimiento');
        $table->integer('edad');
         
     
        $table->string('direccion');
        $table->string('telefono', 11);
       $table->string('motivo_consulta');
       $table->string('enfermedad');
       $table->string('antecedentes_familiares');
       $table->enum('antecedentes_personales', ['hemorragia', 'cardiovascular', 'respiratorio', 'alergias', 'diabetes', 'epilepsia', 'tratamiento_medico', 'medicacion']);
       $table->string('radiodiagnóstico');
       $table->string('tratamiento');
     
    
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
        Schema::dropIfExists('historias');
    }
};
