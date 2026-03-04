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
        $table->bigInteger('cedula')->unique();
        $table->enum('categoria', ['estudiante', 'personal']);
        $table->timestamps();

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
        Schema::dropIfExists('pacientes');
    }
};
