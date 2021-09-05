<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder{

    public function run(){
        $faker = Faker::create('id_ID');
        $admin = [
            'nama' => 'Admin',
            'email' => 'admin@demo.com',
            'telpon' => $faker->e164PhoneNumber(),
            'tanggal_lahir' => $faker->dateTimeBetween(Carbon::now()->subYear(30), Carbon::now()->subYear(18)),
            'tempat_lahir' => $faker->city(),
            'alamat' => $faker->address(),
            'level' => 0,
            'kelamin' => rand(0,1),
            'no_ktp' => '510501'.rand(01,30).'05'.rand(50,98).'0001',
            'email_verified_at' => now(),
            'password' => bcrypt('asdasdasd'), // password
            'remember_token' => Str::random(10),
            // 'photo' => 'blank_user.png',
            // 'active_status' => 1,
        ];

        User::updateOrCreate(['email' => $admin['email']], $admin);
    }
}
