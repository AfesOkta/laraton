<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->bigIncrements('imo_number');
            $table->string('name');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('imo_company');
            $table->string('ship_imo_and_name');
            $table->integer('tonnage');
            $table->string('ship_type');
            $table->string('year_build');
            $table->string('current_flag');
            $table->string('current_class');
            $table->string('detentions_3y_this_company_comp');
            $table->string('detentions_3y_all_company_comp');
            $table->string('acting_as');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleets');
    }
}
