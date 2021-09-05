<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KostController
 */
class KostControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $kosts = Kost::factory()->count(3)->create();

        $response = $this->get(route('kost.index'));

        $response->assertOk();
        $response->assertViewIs('kost.index');
        $response->assertViewHas('kost');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $kosts = Kost::factory()->count(3)->create();

        $response = $this->get(route('kost.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('kost.create'));

        $response->assertOk();
        $response->assertViewIs('kost.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $kost = Kost::factory()->create();

        $response = $this->get(route('kost.edit', $kost));

        $response->assertOk();
        $response->assertViewIs('kost.edit');
        $response->assertViewHas('kost');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KostController::class,
            'store',
            \App\Http\Requests\KostStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $nama = $this->faker->word;
        $alamat = $this->faker->text;
        $jumlah_kamar = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('kost.store'), [
            'nama' => $nama,
            'alamat' => $alamat,
            'jumlah_kamar' => $jumlah_kamar,
        ]);

        $kosts = Kost::query()
            ->where('nama', $nama)
            ->where('alamat', $alamat)
            ->where('jumlah_kamar', $jumlah_kamar)
            ->get();
        $this->assertCount(1, $kosts);
        $kost = $kosts->first();

        $response->assertRedirect(route('kost.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KostController::class,
            'update',
            \App\Http\Requests\KostUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $kost = Kost::factory()->create();
        $nama = $this->faker->word;
        $alamat = $this->faker->text;
        $jumlah_kamar = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('kost.update', $kost), [
            'nama' => $nama,
            'alamat' => $alamat,
            'jumlah_kamar' => $jumlah_kamar,
        ]);

        $kost->refresh();

        $response->assertRedirect(route('kost.index'));

        $this->assertEquals($nama, $kost->nama);
        $this->assertEquals($alamat, $kost->alamat);
        $this->assertEquals($jumlah_kamar, $kost->jumlah_kamar);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $kost = Kost::factory()->create();

        $response = $this->delete(route('kost.destroy', $kost));

        $this->assertDeleted($kost);
    }
}
