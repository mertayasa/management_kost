<?php

namespace Database\Seeders;

use App\Models\JenisPembayaran;
use App\Models\Kamar;
use App\Models\Pembayaran;
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
    
                $sewa = new Sewa;
                $sewa->id_kamar = $id_kamar;
                $sewa->id_penyewa = $penyewa->id;
                $sewa->tgl_masuk = $tanggal;
                $sewa->tgl_keluar = null;
                $sewa->save();
                
                $pembayaran = new Pembayaran;
                $pembayaran->id_jenis_pembayaran = JenisPembayaran::inRandomOrder()->first()->id;
                $pembayaran->id_penyewa = $penyewa->id;
                $pembayaran->id_kamar = $id_kamar;
                $pembayaran->jumlah = $faker->numberBetween(50000, 850000);
                $pembayaran->tgl_pembayaran = $tanggal;
                $pembayaran->status_validasi = 1;
                $pembayaran->save();
            }
            
        });
        
        // Penyewa::factory()->count(30)->create();
    }

}
