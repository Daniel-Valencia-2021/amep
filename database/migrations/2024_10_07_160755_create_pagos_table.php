<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aportante_id');
            $table->decimal('total', 8, 2); // Total pagado
            $table->date('fecha_pago'); // Fecha del pago
            $table->json('muertos_pagados'); // IDs de los muertos que se han pagado
            $table->timestamps();

            // Claves foráneas
            $table->foreign('aportante_id')->references('id')->on('aportantes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
