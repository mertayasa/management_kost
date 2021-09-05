<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Sewa;

class SewaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sewa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_kamar' => Kamar::factory(),
            'id_penyewa' => Penyewa::factory(),
            'tgl_masuk' => $this->faker->date(),
            'tgl_keluar' => $this->faker->date(),
        ];
    }
}
