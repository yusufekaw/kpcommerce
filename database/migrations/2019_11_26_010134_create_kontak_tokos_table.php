<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontakTokosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontak_tokos', function (Blueprint $table) {
            $table->string('id_kontak')->primary();
            $table->string('nama_kontak');
            $table->string('jenis_kontak');
            $table->string('kontak_info');
            $table->string('ikon');
            $table->string('link')->nullable();
            $table->integer('urutan');
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
        Schema::dropIfExists('kontak_tokos');
    }
}
