<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JenisPengeluaran;
use App\Models\Kost;
use App\Models\Pengeluaran;
use Carbon\Carbon;

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
            'id_jenis_pengeluaran' => JenisPengeluaran::inRandomOrder()->first()->id,
            'jumlah' => $this->faker->numberBetween(100000, 535000),
            'tgl_pengeluaran' => $this->faker->dateTimeBetween(Carbon::now()->subMonth(2), Carbon::now()),
            'keterangan' => $this->faker->text,
            'id_kost' => Kost::inRandomOrder()->first()->id,
            // 'status_validasi' => 1,
        ];
    }
}
