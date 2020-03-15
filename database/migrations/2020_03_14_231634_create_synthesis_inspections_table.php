<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSynthesisInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synthesis_inspections', function (Blueprint $table) {
            $table->bigIncrements('imo_number');
            $table->string('name');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('imo_company');
            $table->string('role');
            $table->string('nb_ships');
            $table->string('last_3y_this_company_insp');
            $table->string('last_3y_this_company_date');
            $table->string('last_3y_all_company_insp');
            $table->string('last_3y_all_company_date');
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
        Schema::dropIfExists('synthesis_inspections');
    }
}
