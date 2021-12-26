<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('pro_nombre');
            $table->integer('pro_stockactual')->default('0');
            $table->integer('pro_stockmin')->default('0');
            $table->decimal('pro_precioventa')->default('0');
            $table->decimal('pro_preciocompra')->default('0');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->unsignedBigInteger('unidad_id');
            $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas');
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
        Schema::dropIfExists('productos');
    }
}
