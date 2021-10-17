<?php

namespace Database\Seeders;

use App\Models\JenisPemasukan;
use Illuminate\Database\Seeder;

class JenisPemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_pemasukan = [
            ['jenis_pemasukan' => 'Listrik'],
            ['jenis_pemasukan' => 'Kamar'],
            ['jenis_pemasukan' => 'Sampah'],
            ['jenis_pemasukan' => 'Air'],
        ];

        foreach($jenis_pemasukan as $jenis){
            JenisPemasukan::create($jenis);
        }
    }
}
