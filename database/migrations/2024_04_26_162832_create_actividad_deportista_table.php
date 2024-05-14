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
        Schema::create('actividad_deportista', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deportista_id');
            $table->unsignedBigInteger('actividad_id');
            $table->string('descripcion')->default('Sin descripción');
            $table->text('resultados')->default('Resultados no disponibles');

            $table->foreign('deportista_id')
                ->references('id')
                ->on('deportistas')
                ->onDelete('cascade');
            $table->foreign('actividad_id')
                ->references('actividad_id')
                ->on('actividades_deportivas')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividad_deportista');
    }
};
