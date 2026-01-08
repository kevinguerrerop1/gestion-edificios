<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaHoraVisitaToGestionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('gestiones', function (Blueprint $table) {
        $table->date('fecha_visita_estimada')->nullable()->after('descripcion');
        $table->string('hora_visita_estimada', 5)->nullable()->after('fecha_visita_estimada');
    });
}

public function down()
{
    Schema::table('gestiones', function (Blueprint $table) {
        $table->dropColumn(['fecha_visita_estimada', 'hora_visita_estimada']);
    });
}

}
