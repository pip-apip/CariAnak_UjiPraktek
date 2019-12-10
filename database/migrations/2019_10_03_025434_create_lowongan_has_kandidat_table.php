<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLowonganHasKandidatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan_has_kandidat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lowongan_id')->unsigned();
            $table->foreign('lowongan_id')->references('id')->on('lowongan')->onDelete('cascade');
            $table->bigInteger('kandidat_id')->unsigned();
            $table->foreign('kandidat_id')->references('id')->on('kandidats')->onDelete('cascade');
            $table->bigInteger('sekolah_id')->unsigned();
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onDelete('cascade');
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
        Schema::dropIfExists('lowongan_has_kandidat');
    }
}
