<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SewaController
 */
class SewaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('sewa.index'));

        $response->assertOk();
        $response->assertViewIs('sewa.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $sewas = Sewa::factory()->count(3)->create();

        $response = $this->get(route('sewa.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('sewa.create'));

        $response->assertOk();
        $response->assertViewIs('sewa.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $sewa = Sewa::factory()->create();

        $response = $this->get(route('sewa.edit', $sewa));

        $response->assertOk();
        $response->assertViewIs('sewa.edit');
        $response->assertViewHas('sewa');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SewaController::class,
            'store',
            \App\Http\Requests\SewaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $id_kamar = $this->faker->randomNumber();
        $id_penyewa = $this->faker->randomNumber();
        $tgl_masuk = $this->faker->date();
        $tgl_keluar = $this->faker->date();

        $response = $this->post(route('sewa.store'), [
            'id_kamar' => $id_kamar,
            'id_penyewa' => $id_penyewa,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_keluar,
        ]);

        $sewas = Sewa::query()
            ->where('id_kamar', $id_kamar)
            ->where('id_penyewa', $id_penyewa)
            ->where('tgl_masuk', $tgl_masuk)
            ->where('tgl_keluar', $tgl_keluar)
            ->get();
        $this->assertCount(1, $sewas);
        $sewa = $sewas->first();

        $response->assertRedirect(route('sewa.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SewaController::class,
            'update',
            \App\Http\Requests\SewaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $sewa = Sewa::factory()->create();
        $id_kamar = $this->faker->randomNumber();
        $id_penyewa = $this->faker->randomNumber();
        $tgl_masuk = $this->faker->date();
        $tgl_keluar = $this->faker->date();

        $response = $this->put(route('sewa.update', $sewa), [
            'id_kamar' => $id_kamar,
            'id_penyewa' => $id_penyewa,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_keluar,
        ]);

        $sewa->refresh();

        $response->assertRedirect(route('sewa.index'));

        $this->assertEquals($id_kamar, $sewa->id_kamar);
        $this->assertEquals($id_penyewa, $sewa->id_penyewa);
        $this->assertEquals(Carbon::parse($tgl_masuk), $sewa->tgl_masuk);
        $this->assertEquals(Carbon::parse($tgl_keluar), $sewa->tgl_keluar);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $sewa = Sewa::factory()->create();

        $response = $this->delete(route('sewa.destroy', $sewa));

        $this->assertDeleted($sewa);
    }
}
