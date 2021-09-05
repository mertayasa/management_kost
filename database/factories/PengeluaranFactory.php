<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JenisPengeluaran;
use App\Models\Pengeluaran;

class PengeluaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengeluaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_jenis_pengeluaran' => JenisPengeluaran::factory(),
            'jumlah' => $this->faker->numberBetween(-10000, 10000),
            'tgl_pengeluaran' => $this->faker->date(),
            'keterangan' => $this->faker->text,
            'status_validasi' => $this->faker->numberBetween(-8, 8),
        ];
    }
}
