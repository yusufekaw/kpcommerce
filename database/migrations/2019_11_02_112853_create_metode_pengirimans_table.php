<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetodePengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metode_pengirimans', function (Blueprint $table) {
            $table->string('id_metode_pengiriman')->primary();
            $table->string('id_pengiriman');
            $table->string('kurir');
            $table->string('layanan');
            $table->string('berat');
            $table->double('tarif');
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
        Schema::dropIfExists('metode_pengirimans');
    }
}
