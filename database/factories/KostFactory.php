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
            'nama' => 'Kost '.$this->faker->firstName,
            'alamat' => $this->faker->address,
            'jumlah_kamar' => $this->faker->numberBetween(4, 10),
        ];
    }
}
