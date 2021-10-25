<?php

namespace Database\Seeders;

use App\Models\JenisPemasukan;
use App\Models\Kamar;
use App\Models\Pemasukan;
use App\Models\Penyewa;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class PenyewaSeeder extends Seeder{

    public function run(){
        $faker = Faker::create('id_ID');

        Penyewa::factory()->count(30)->create()->each(function($penyewa) use($faker) {
            
            $id_kamar = Kamar::doesnthave('sewa')->get()[0]->id ?? null;
            
            if($id_kamar){
                $tanggal = $faker->dateTimeBetween(Carbon::now()->subMonth(10), Carbon::now()->subMonth(4));
    
                $status_validasi = rand(0, 2);

                $sewa = new Sewa;
                $sewa->id_kamar = $id_kamar;
                $sewa->id_penyewa = $penyewa->id;
                $sewa->tgl_masuk = $tanggal;
                $sewa->tgl_keluar = null;
                $sewa->status_validasi = $status_validasi;
                $sewa->alasan_ditolak = $status_validasi == 2 ? $faker->text() : '';
                $sewa->save();
                
                $pemasukan = new Pemasukan;
                $pemasukan->id_jenis_pemasukan = JenisPemasukan::inRandomOrder()->first()->id;
                $pemasukan->id_penyewa = $penyewa->id;
                $pemasukan->id_kamar = $id_kamar;
                $pemasukan->jumlah = $faker->numberBetween(50000, 850000);
                $pemasukan->tgl_pemasukan = $tanggal;
                $pemasukan->status_validasi = $status_validasi;
                $pemasukan->alasan_ditolak = $status_validasi == 2 ? $faker->text() : '';
                $pemasukan->save();
            }
            
        });
        
        // Penyewa::factory()->count(30)->create();
    }

}
