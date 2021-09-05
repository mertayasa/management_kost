<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JenisPembayaran;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Penyewa;

class PembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_jenis_pembayaran' => JenisPembayaran::factory(),
            'id_penyewa' => Penyewa::factory(),
            'id_kamar' => Kamar::factory(),
            'jumlah' => $this->faker->numberBetween(-10000, 10000),
            'tgl_pembayaran' => $this->faker->date(),
            'status_validasi' => $this->faker->numberBetween(-8, 8),
        ];
    }
}
