<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlasanDitolakToSewaAndPemasukan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sewa', function (Blueprint $table) {
            $table->text('alasan_ditolak')->nullable();
        });

        Schema::table('pemasukan', function (Blueprint $table) {
            $table->text('alasan_ditolak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sewa', function (Blueprint $table) {
            $table->dropColumn('alasan_ditolak');
        });

        Schema::table('pemasukan', function (Blueprint $table) {
            $table->dropColumn('alasan_ditolak');
        });
    }
}
