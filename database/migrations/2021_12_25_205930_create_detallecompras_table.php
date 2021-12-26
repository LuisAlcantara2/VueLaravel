<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallecomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallecompras', function (Blueprint $table) {
            $table->id();
            $table->integer('dcp_cantidad');
            $table->decimal('dcp_precio');
            $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('id')->on('compras');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallecompras');
    }
}
