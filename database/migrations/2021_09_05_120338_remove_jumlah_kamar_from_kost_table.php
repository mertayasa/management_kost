<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveJumlahKamarFromKostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kost', function (Blueprint $table) {
            $table->dropColumn('jumlah_kamar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kost', function (Blueprint $table) {
            $table->integer('jumlah_kamar')->default(0);
        });
    }
}
