<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixRekrutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fix_rekruts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kandidat_id')->unsigned();
            $table->foreign('kandidat_id')->references('id')->on('kandidats');
            $table->bigInteger('perusahaan_id')->unsigned();
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans');
            $table->integer('status');
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
        Schema::dropIfExists('fix_rekruts');
    }
}
