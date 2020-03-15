<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_names', function (Blueprint $table) {
            $table->bigIncrements('imo_number');
            $table->string('name');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('former_name');
            $table->string('date_effect');
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
        Schema::dropIfExists('history_names');
    }
}
