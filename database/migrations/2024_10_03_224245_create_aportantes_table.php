<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aportantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cedula')->unique();
            $table->string('telefono')->nullable(); // Agregar el campo de teléfono
            $table->string('direccion');
            $table->date('fecha_nacimiento');
            $table->boolean('afiliacion_pagada')->default(false); // Nueva columna
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aportantes');
    }
};
