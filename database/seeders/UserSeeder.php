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
        $users = [
            [
                'nama' => 'owner',
                'email' => 'owner@demo.com',
                'telpon' => $faker->e164PhoneNumber(),
                'tanggal_lahir' => $faker->dateTimeBetween(Carbon::now()->subYear(30), Carbon::now()->subYear(18)),
                'tempat_lahir' => $faker->city(),
                'alamat' => $faker->address(),
                'level' => 0,
                'kelamin' => rand(0,1),
                'no_ktp' => '510501'.rand(01,30).'05'.rand(10,98).'0001',
                'email_verified_at' => now(),
                'password' => bcrypt('asdasdasd'), // password
                'remember_token' => Str::random(10),
                // 'photo' => 'blank_user.png',
                // 'active_status' => 1,
            ],
            [
                'nama' => 'Manager',
                'email' => 'manager@demo.com',
                'telpon' => $faker->e164PhoneNumber(),
                'tanggal_lahir' => $faker->dateTimeBetween(Carbon::now()->subYear(30), Carbon::now()->subYear(18)),
                'tempat_lahir' => $faker->city(),
                'alamat' => $faker->address(),
                'level' => 1,
                'kelamin' => rand(0,1),
                'no_ktp' => '510501'.rand(01,30).'05'.rand(10,98).'0001',
                'email_verified_at' => now(),
                'password' => bcrypt('asdasdasd'), // password
                'remember_token' => Str::random(10),
                // 'photo' => 'blank_user.png',
                // 'active_status' => 1,
            ],
            [
                'nama' => 'Pegawai',
                'email' => 'pegawai@demo.com',
                'telpon' => $faker->e164PhoneNumber(),
                'tanggal_lahir' => $faker->dateTimeBetween(Carbon::now()->subYear(30), Carbon::now()->subYear(18)),
                'tempat_lahir' => $faker->city(),
                'alamat' => $faker->address(),
                'level' => 2,
                'kelamin' => rand(0,1),
                'no_ktp' => '510501'.rand(01,30).'05'.rand(10,98).'0001',
                'email_verified_at' => now(),
                'password' => bcrypt('asdasdasd'), // password
                'remember_token' => Str::random(10),
                // 'photo' => 'blank_user.png',
                // 'active_status' => 1,
            ],
        ];

        foreach ($users as  $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
