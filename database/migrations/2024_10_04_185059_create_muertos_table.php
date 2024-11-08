<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuertosTable extends Migration
{
    public function up()
    {
        Schema::create('muertos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion'); // Puede ser cédula o TI/RC
            $table->enum('tipo_identificacion', ['TI', 'RC', 'Cedula']);
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_fallecimiento');
            $table->unsignedBigInteger('causa_muerte_id')->nullable(false);
            $table->boolean('pagado')->default(false); // Campo para indicar si el fallecido ha sido pagado
            $table->timestamps();

            // Relación con la tabla causas_de_muerte
            $table->foreign('causa_muerte_id')->references('id')->on('causas_de_muerte')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('muertos');
    }
}
