<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kamar;
use App\Models\Kost;

class KamarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kamar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_kost' => Kost::factory(),
            'no_kamar' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'harga' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
