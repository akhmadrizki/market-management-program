<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontraks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_penyewa');
            $table->unsignedInteger('id_jenis_toko');
            $table->string('jenis_kontrak');
            $table->date('tanggal');
            $table->integer('biaya_sewa');
            $table->integer('tunggakan')->nullable()->default(0);
            $table->string('no_toko');
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
        Schema::dropIfExists('kontraks');
    }
};
