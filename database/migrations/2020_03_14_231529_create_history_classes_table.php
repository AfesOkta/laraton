<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_classes', function (Blueprint $table) {
            $table->bigIncrements('imo_number');
            $table->string('name');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('class_society');
            $table->string('date_survey');
            $table->string('source');
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
        Schema::dropIfExists('history_classes');
    }
}
