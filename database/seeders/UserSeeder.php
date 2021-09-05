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
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            // 'phone' => $faker->phoneNumber(),
            // 'date_of_birth' => $faker->dateTimeBetween(Carbon::now()->subYear(30), Carbon::now()->subYear(18)),
            // 'active_status' => 1,
            // 'address' => $faker->address(),
            'level' => 0,
            // 'gender' => rand(0,1),
            // 'photo' => 'blank_user.png',
            'email_verified_at' => now(),
            'password' => bcrypt('asdasdasd'), // password
            'remember_token' => Str::random(10),
        ];

        User::updateOrCreate(['email' => $admin['email']], $admin);
    }
}
