<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostosTable extends Migration
{
    public function up()
    {
        Schema::create('costos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_afiliacion', 10, 2)->default(0); // Valor de afiliación
            $table->decimal('valor_muerto', 10, 2)->default(0);     // Valor por fallecido
            $table->decimal('valor_desembolso', 10, 2)->default(0); // Valor por desembolso
            $table->decimal('valor_mensual', 10, 2)->default(0);   // Valor mensual
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('costos');
    }
}
