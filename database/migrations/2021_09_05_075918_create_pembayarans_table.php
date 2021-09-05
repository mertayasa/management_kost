<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_pembayaran');
            $table->unsignedBigInteger('id_penyewa');
            $table->unsignedBigInteger('id_kamar');
            $table->integer('jumlah');
            $table->date('tgl_pembayaran');
            $table->tinyInteger('status_validasi')->default(0);
            $table->timestamps();


            $table->foreign('id_kamar')->references('id')->on('kamar')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_penyewa')->references('id')->on('penyewa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_pembayaran')->references('id')->on('jenis_pembayaran')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
