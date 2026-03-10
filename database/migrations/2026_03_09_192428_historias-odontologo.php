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

    
        Schema::create('historias-odontologo', function (Blueprint $table) {
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
       $table->enum('examen', ['labios', 'lengua', 'piso_bucal', 'encias', 'atm', 'oclusion']);
       $table->enum('diente', ['18', '17', '16', '15', '14', '13', '12', '11', '21', '22', '23', '24', '25', '26', '27', '28', '48', '47', '46', '45', '44','43', '42','41', '31', '32', '33', '34', '35', '36', '37', '38']);
       $table->string('odontograma')->nullable();

     
    
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
        Schema::dropIfExists('historias-odontologo');
    }
};
