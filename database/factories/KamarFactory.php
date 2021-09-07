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
        $id_kost = Kost::inRandomOrder()->first()->id;
        $price_list = ['500000', '650000', '800000', '400000'];

        return [
            'id_kost' => $id_kost,
            'no_kamar' => 'A '.rand(50, 500),
            'harga' => $price_list[rand(0, 3)],
        ];
    }
}
