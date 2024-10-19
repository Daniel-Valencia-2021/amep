<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfiliacionPagosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('afiliacion_pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aportante_id');
            $table->decimal('valor_afiliacion', 10, 2);
            $table->decimal('valor_mensual_pagado', 10, 2)->nullable();
            $table->integer('meses_pagados')->nullable();
            $table->decimal('total', 10, 2);
            $table->date('fecha_pago');
            $table->string('concepto'); // "afiliación de aportante" o "afiliación de beneficiarios"
            $table->timestamps();

            // Clave foránea
            $table->foreign('aportante_id')->references('id')->on('aportantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afiliacion_pagos');
    }
}
