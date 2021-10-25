<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Penyewa;

class PenyewaFactory extends Factory
{
    protected $model = Penyewa::class;

    public function definition(){
        return [
            'nama' => $this->faker->name(),
            'no_ktp' => '510501'.rand(01,30).'05'.rand(50,98).'0001',
            'telpon' => $this->faker->e164PhoneNumber(),
            'alamat' => $this->faker->address,
            'pekerjaan' => $this->faker->jobTitle,
            // 'status_validasi' => 1,
        ];
    }
}
