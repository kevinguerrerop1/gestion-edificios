<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRutTelefonoToTecnicosTable extends Migration
{

    public function up()
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->string('rut')->unique()->after('email');
            $table->string('telefono')->nullable()->after('rut');
        });
    }

    public function down()
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->dropColumn(['rut', 'telefono']);
        });
    }
}
