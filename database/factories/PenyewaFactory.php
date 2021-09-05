<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Penyewa;

class PenyewaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penyewa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'no_ktp' => $this->faker->regexify('[A-Za-z0-9]{16}'),
            'telpon' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'alamat' => $this->faker->text,
            'pekerjaan' => $this->faker->text,
            'status_validasi' => $this->faker->numberBetween(-8, 8),
        ];
    }
}
