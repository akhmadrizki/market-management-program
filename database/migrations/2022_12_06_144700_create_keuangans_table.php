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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('keterangan');
            $table->unsignedInteger('user_id');
            $table->integer('pemasukan')->nullable()->default(0);
            $table->integer('pengeluaran')->nullable()->default(0);
            $table->unsignedInteger('pemasukan_id')->nullable();
            $table->unsignedInteger('pengeluaran_id')->nullable();
            $table->unsignedInteger('pembayaran_id')->nullable();
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
        Schema::dropIfExists('keuangans');
    }
};
