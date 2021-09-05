<?php

namespace Database\Seeders;

use App\Models\Kost;
use Illuminate\Database\Seeder;

class KostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kost::factory()->count(3)->create();
    }
}
