<?php

namespace Database\Seeders;

use App\Models\JenisPengeluaran;
use Illuminate\Database\Seeder;

class JenisPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_pengeluaran = [
            ['jenis_pengeluaran' => 'Listrik'],
            ['jenis_pengeluaran' => 'Maintenance'],
            ['jenis_pengeluaran' => 'Sampah'],
            ['jenis_pengeluaran' => 'Iuran Banjar'],
            ['jenis_pengeluaran' => 'Air'],
            ['jenis_pengeluaran' => 'Transportasi'],
            ['jenis_pengeluaran' => 'Konsumsi'],
        ];

        foreach($jenis_pengeluaran as $jenis){
            JenisPengeluaran::create($jenis);
        }
    }
}
