<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKandidatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default('$2y$10$y7jYad90S6ixdI5UyHR5FOCdlPoUkKpZMaKC8mwuL1k70wpFPdrLu');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('negara');
            $table->string('tgl_lahir');
            $table->string('tmp_lahir');
            $table->string('avatar')->default('user.jpg');
            $table->bigInteger('sekolah_id')->unsigned()->nullable();
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onDelete('cascade');
            $table->string('skills')->nullable();
            $table->string('pendidikan');
            $table->rememberToken();
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
        Schema::dropIfExists('kandidat');
    }
}
