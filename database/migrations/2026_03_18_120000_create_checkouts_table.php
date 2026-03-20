<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('edificio_id')
                ->constrained('edificios')
                ->cascadeOnDelete();

            $table->foreignId('tecnico_id')
                ->nullable()
                ->constrained('tecnicos')
                ->nullOnDelete();

            $table->string('bloque')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_termino')->nullable();

            $table->string('pdf_solicitud')->nullable();
            $table->string('pdf_entrega')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
