<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('foto');
            $table->text('description');
            $table->bigInteger('kategori')->unsigned();
            $table->foreign('kategori')->references('id')->on('category')->onDelete('cascade');
            $table->bigInteger('id_perusahaan')->unsigned()->nullable();
            $table->foreign('id_perusahaan')->references('id')->on('perusahaans')->onDelete('cascade');
            $table->bigInteger('id_kandidat')->unsigned()->nullable();
            $table->foreign('id_kandidat')->references('id')->on('kandidats')->onDelete('cascade');
            $table->string('author');
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
        Schema::dropIfExists('artikel');
    }
}
