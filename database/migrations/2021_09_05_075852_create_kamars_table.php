<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kost');
            $table->foreign('id_kost')->references('id')->on('kost')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_kamar', 10);
            $table->integer('harga');
            $table->timestamps();
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
        Schema::dropIfExists('kamars');
    }
}
