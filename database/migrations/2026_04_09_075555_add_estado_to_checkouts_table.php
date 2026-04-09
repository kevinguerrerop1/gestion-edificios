<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoToCheckoutsTable extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('estado')->default('pendiente')->after('fecha_termino');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            //
        });
    }
}
