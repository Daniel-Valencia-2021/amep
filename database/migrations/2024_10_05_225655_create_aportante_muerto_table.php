<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAportanteMuertoTable extends Migration
{
    public function up()
    {
        Schema::create('aportante_muerto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aportante_id');
            $table->unsignedBigInteger('muerto_id');
            $table->timestamps();

            $table->foreign('aportante_id')->references('id')->on('aportantes')->onDelete('cascade');
            $table->foreign('muerto_id')->references('id')->on('muertos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('aportante_muerto');
    }
}
