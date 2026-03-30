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
        Schema::create('admin', function (Blueprint $table) {
        $table->id(); // Opcional, pero útil como PK interna
        $table->bigInteger('cedula')->unique();
        $table->string('usuario');
        $table->enum('rol', ['medico', 'paciente', 'especial']);
        $table->string('password');  // Solo aquí
        $table->string('sesion')->nullable(); // Solo aquí
        $table->rememberToken();
        $table->timestamps();
            
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
