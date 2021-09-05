<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kost;

class KostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'alamat' => $this->faker->text,
            'jumlah_kamar' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
