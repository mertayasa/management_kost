<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_pemasukan');
            $table->unsignedBigInteger('id_penyewa');
            $table->unsignedBigInteger('id_kamar');
            $table->integer('jumlah');
            $table->date('tgl_pemasukan');
            $table->tinyInteger('status_validasi')->default(0);
            $table->timestamps();


            $table->foreign('id_kamar')->references('id')->on('kamar')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_penyewa')->references('id')->on('penyewa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_pemasukan')->references('id')->on('jenis_pemasukan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukan');
    }
}
