<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutCotizacionsTable extends Migration
{
    public function up()
    {
        Schema::create('checkout_cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkout_id')->constrained('checkouts')->onDelete('cascade');
            $table->string('numero_cotizacion', 100);
            $table->date('fecha')->nullable();
            $table->string('cliente_nombre')->nullable();
            $table->string('contacto')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('departamento')->nullable();
            $table->integer('subtotal')->default(0);
            $table->integer('iva')->default(0);
            $table->integer('total')->default(0);
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'autorizada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkout_cotizaciones');
    }
}
