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
        Schema::create('invitados', function (Blueprint $table) {
            $table->id('invitado_id');
            $table->text('cedula')->unique();
            $table->unsignedBigInteger('deporte_id')->nullable();
            $table->foreign('deporte_id')
                ->references('deporte_id')
                ->on('deportes')
                ->onDelete('restrict');
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->unsignedBigInteger('tipo_invitado_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad')->nullable();
            $table->string('url_imagen')->nullable();
            $table->enum('genero',['M','F']);
            $table->date('fecha_nacimiento')->nullable();
            $table->boolean('activo')->default(true);
            $table->foreign('provincia_id')
                ->references('provincia_id')
                ->on('provincias')
                ->onDelete('restrict');
            $table->foreign('tipo_invitado_id')
                ->references('tipo_invitado_id')
                ->on('tipos_invitados')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inivitados');
    }
};
