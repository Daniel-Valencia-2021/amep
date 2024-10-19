<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariosTable extends Migration
{
    public function up()
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('identificacion')->unique(); // TI o RC
            $table->string('direccion');
            $table->string('parentesco');
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('aportante_id');
            $table->enum('tipo_identificacion', ['TI', 'RC']); // Tipo de identificación (TI o RC)
            $table->boolean('afiliacion_pagada')->default(false); // Nueva columna
            $table->timestamps();

            // Relación con la tabla de aportantes
            $table->foreign('aportante_id')->references('id')->on('aportantes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('beneficiarios');
    }
}
