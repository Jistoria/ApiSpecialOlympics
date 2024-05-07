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
        Schema::create('deportistas', function (Blueprint $table) {
            $table->id();
            $table->text('cedula')->unique();
            $table->unsignedBigInteger('numero_deportista')->unique()->nullable();
            $table->unsignedInteger('provincia_id');
            $table->foreign('provincia_id')
                ->references('provincia_id')
                ->on('provincias')
                ->onDelete('restrict');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->enum('genero',['M','F']);
            $table->date('fecha_nacimiento');
            $table->string('url_imagen');
            $table->boolean('activo')->default(true);
            $table->string('lugar_hospedaje')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_deportistas');
    }
};
