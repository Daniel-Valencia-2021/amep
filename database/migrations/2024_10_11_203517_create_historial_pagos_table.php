<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPagosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_aportante'); // Guardar nombre completo del aportante
            $table->string('cedula_aportante'); // Guardar la cédula del aportante
            $table->decimal('total', 10, 2); // Total pagado
            $table->date('fecha_pago'); // Fecha del pago
            $table->json('muertos_pagados')->nullable(); // IDs de los muertos pagados, en formato JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_pagos');
    }
}
