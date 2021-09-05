<?php

namespace Database\Seeders;

use App\Models\JenisPembayaran;
use Illuminate\Database\Seeder;

class JenisPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_pembayaran = [
            ['jenis_pembayaran' => 'Listrik'],
            ['jenis_pembayaran' => 'Kamar'],
            ['jenis_pembayaran' => 'Sampah'],
            ['jenis_pembayaran' => 'Air'],
        ];

        foreach($jenis_pembayaran as $jenis){
            JenisPembayaran::create($jenis);
        }
    }
}
