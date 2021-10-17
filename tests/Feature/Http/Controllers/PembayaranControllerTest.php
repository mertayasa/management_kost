<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pemasukan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PemasukanController
 */
class PemasukanControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('pemasukan.index'));

        $response->assertOk();
        $response->assertViewIs('pemasukan.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $pemasukans = Pemasukan::factory()->count(3)->create();

        $response = $this->get(route('pemasukan.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pemasukan.create'));

        $response->assertOk();
        $response->assertViewIs('pemasukan.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pemasukan = Pemasukan::factory()->create();

        $response = $this->get(route('pemasukan.edit', $pemasukan));

        $response->assertOk();
        $response->assertViewIs('pemasukan.edit');
        $response->assertViewHas('pemasukan');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PemasukanController::class,
            'store',
            \App\Http\Requests\PemasukanStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $id_jenis_pemasukan = $this->faker->randomNumber();
        $id_penyewa = $this->faker->randomNumber();
        $id_kamar = $this->faker->randomNumber();
        $jumlah = $this->faker->numberBetween(-10000, 10000);
        $tgl_pemasukan = $this->faker->date();

        $response = $this->post(route('pemasukan.store'), [
            'id_jenis_pemasukan' => $id_jenis_pemasukan,
            'id_penyewa' => $id_penyewa,
            'id_kamar' => $id_kamar,
            'jumlah' => $jumlah,
            'tgl_pemasukan' => $tgl_pemasukan,
        ]);

        $pemasukans = Pemasukan::query()
            ->where('id_jenis_pemasukan', $id_jenis_pemasukan)
            ->where('id_penyewa', $id_penyewa)
            ->where('id_kamar', $id_kamar)
            ->where('jumlah', $jumlah)
            ->where('tgl_pemasukan', $tgl_pemasukan)
            ->get();
        $this->assertCount(1, $pemasukans);
        $pemasukan = $pemasukans->first();

        $response->assertRedirect(route('pemasukan.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PemasukanController::class,
            'update',
            \App\Http\Requests\PemasukanUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pemasukan = Pemasukan::factory()->create();
        $id_jenis_pemasukan = $this->faker->randomNumber();
        $id_penyewa = $this->faker->randomNumber();
        $id_kamar = $this->faker->randomNumber();
        $jumlah = $this->faker->numberBetween(-10000, 10000);
        $tgl_pemasukan = $this->faker->date();

        $response = $this->put(route('pemasukan.update', $pemasukan), [
            'id_jenis_pemasukan' => $id_jenis_pemasukan,
            'id_penyewa' => $id_penyewa,
            'id_kamar' => $id_kamar,
            'jumlah' => $jumlah,
            'tgl_pemasukan' => $tgl_pemasukan,
        ]);

        $pemasukan->refresh();

        $response->assertRedirect(route('pemasukan.index'));

        $this->assertEquals($id_jenis_pemasukan, $pemasukan->id_jenis_pemasukan);
        $this->assertEquals($id_penyewa, $pemasukan->id_penyewa);
        $this->assertEquals($id_kamar, $pemasukan->id_kamar);
        $this->assertEquals($jumlah, $pemasukan->jumlah);
        $this->assertEquals(Carbon::parse($tgl_pemasukan), $pemasukan->tgl_pemasukan);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $pemasukan = Pemasukan::factory()->create();

        $response = $this->delete(route('pemasukan.destroy', $pemasukan));

        $this->assertDeleted($pemasukan);
    }
}
