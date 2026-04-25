<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToEdificiosTable extends Migration
{
    public function up()
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->string('color', 7)->default('#6c757d'); // gris bootstrap
        });
    }

    public function down()
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
