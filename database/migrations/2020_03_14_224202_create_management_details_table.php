<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_details', function (Blueprint $table) {
            $table->bigIncrements('imo_number_ship');
            $table->string('name_ship');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('imo_company');
            $table->string('role');
            $table->string('name_company');
            $table->string('address');
            $table->string('date_effect');
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
        Schema::dropIfExists('management_details');
    }
}
