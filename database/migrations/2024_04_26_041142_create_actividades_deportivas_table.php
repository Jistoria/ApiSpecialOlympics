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
        Schema::create('actividades_deportivas', function (Blueprint $table) {
            $table->id('actividad_id');
            $table->unsignedInteger('deporte_id');
            $table->string('actividad');
            $table->string('descripcion');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('deporte_id')
                ->references('deporte_id')
                ->on('deportes')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_actividades_deportivas');
    }
};
