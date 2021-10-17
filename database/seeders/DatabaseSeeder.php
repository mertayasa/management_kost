<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(KostSeeder::class);
        $this->call(KamarSeeder::class);
        $this->call(JenisPengeluaranSeeder::class);
        $this->call(JenisPemasukanSeeder::class);
        $this->call(PenyewaSeeder::class);
        $this->call(PengeluaranSeeder::class);
    }
}
