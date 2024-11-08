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
            $table->unsignedBigInteger('costo_id')->nullable(); // Clave foránea a costos
            //$table->decimal('valor_afiliacion', 10, 2);
            $table->decimal('valor_mensual_pagado', 10, 2)->nullable();
            $table->integer('meses_pagados')->nullable();
            $table->decimal('total', 10, 2);
            $table->date('fecha_pago');
            $table->string('concepto');
            $table->timestamps();
    
            $table->foreign('aportante_id')->references('id')->on('aportantes')->onDelete('cascade');
            $table->foreign('costo_id')->references('id')->on('costos')->onDelete('set null');
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
