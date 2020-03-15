<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_compliances', function (Blueprint $table) {
            $table->bigIncrements('imo_number');
            $table->string('name');
            $table->integer('mmsi');
            $table->string('call_sign');
            $table->string('imo_company');
            $table->string('flag');
            $table->string('ship_type');
            $table->string('class_society');
            $table->string('status');
            $table->string('date_of_status');
            $table->string('reason');
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
        Schema::dropIfExists('doc_compliances');
    }
}
