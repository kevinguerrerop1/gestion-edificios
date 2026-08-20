<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutCotizacionDetallesTable extends Migration
{
    public function up()
    {
        Schema::create('checkout_cotizacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkout_cotizacion_id')->constrained('checkout_cotizaciones')->onDelete('cascade');
            $table->text('detalle_servicio');
            $table->integer('valor_unitario')->default(0);
            $table->integer('unidades')->default(1);
            $table->integer('total_linea')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkout_cotizacion_detalles');
    }
}
