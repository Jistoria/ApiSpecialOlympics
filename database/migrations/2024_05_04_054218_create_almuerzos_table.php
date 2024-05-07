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
        Schema::create('almuerzos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deportista_id')->nullable();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('completado')->default(false);
            $table->unsignedBigInteger('invitado_id')->nullable();
            $table->timestamps();

            $table->foreign('invitado_id')
                ->references('invitado_id')
                ->on('invitados')
                ->onDelete('cascade');
            $table->foreign('deportista_id')
                ->references('id')
                ->on('deportistas')
                ->onDelete('cascade');
            $table->unique(['deportista_id', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almuerzos');
    }
};
