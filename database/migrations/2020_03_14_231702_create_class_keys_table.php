<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_keys', function (Blueprint $table) {
            $table->bigIncrements('imo_number');
            $table->string('name');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('imo_company');
            $table->string('abbr');
            $table->string('name_of_society');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_keys');
    }
}
