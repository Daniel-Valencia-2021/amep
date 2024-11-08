<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesembolsosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('desembolsos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('muerto_id');
            $table->unsignedBigInteger('costo_id')->nullable(); // Clave foránea a costos
            $table->string('nombre_reclamante');
            $table->string('apellidos_reclamante');
            $table->string('cedula_reclamante');
            $table->string('telefono_reclamante');
            $table->string('parentesco');
            $table->decimal('valor_desembolso', 10, 2)->nullable();
            $table->date('fecha_desembolso');
            $table->timestamps();
    
            $table->foreign('muerto_id')->references('id')->on('muertos')->onDelete('cascade');
            $table->foreign('costo_id')->references('id')->on('costos')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desembolsos');
    }
}
