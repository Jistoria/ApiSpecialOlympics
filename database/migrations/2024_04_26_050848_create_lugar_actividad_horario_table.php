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
        Schema::create('lugar_actividad_horario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lugar_id');
            $table->unsignedBigInteger('actividad_id');
            $table->time('hora_inicio');
            $table->time('hora_fin')->nullable();
            $table->date('fecha');
            $table->timestamps();

            // Definición de las claves foráneas
            $table->foreign('lugar_id')->references('lugar_id')->on('lugares')->onDelete('cascade');
            $table->foreign('actividad_id')->references('actividad_id')->on('actividades_deportivas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugar_actividad');
    }
};
