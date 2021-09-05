<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KamarController
 */
class KamarControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('kamar.index'));

        $response->assertOk();
        $response->assertViewIs('kamar.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $kamars = Kamar::factory()->count(3)->create();

        $response = $this->get(route('kamar.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('kamar.create'));

        $response->assertOk();
        $response->assertViewIs('kamar.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $kamar = Kamar::factory()->create();

        $response = $this->get(route('kamar.edit', $kamar));

        $response->assertOk();
        $response->assertViewIs('kamar.edit');
        $response->assertViewHas('kamar');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KamarController::class,
            'store',
            \App\Http\Requests\KamarStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $id_kost = $this->faker->randomNumber();
        $no_kamar = $this->faker->word;
        $harga = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('kamar.store'), [
            'id_kost' => $id_kost,
            'no_kamar' => $no_kamar,
            'harga' => $harga,
        ]);

        $kamars = Kamar::query()
            ->where('id_kost', $id_kost)
            ->where('no_kamar', $no_kamar)
            ->where('harga', $harga)
            ->get();
        $this->assertCount(1, $kamars);
        $kamar = $kamars->first();

        $response->assertRedirect(route('kamar.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KamarController::class,
            'update',
            \App\Http\Requests\KamarUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $kamar = Kamar::factory()->create();
        $id_kost = $this->faker->randomNumber();
        $no_kamar = $this->faker->word;
        $harga = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('kamar.update', $kamar), [
            'id_kost' => $id_kost,
            'no_kamar' => $no_kamar,
            'harga' => $harga,
        ]);

        $kamar->refresh();

        $response->assertRedirect(route('kamar.index'));

        $this->assertEquals($id_kost, $kamar->id_kost);
        $this->assertEquals($no_kamar, $kamar->no_kamar);
        $this->assertEquals($harga, $kamar->harga);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $kamar = Kamar::factory()->create();

        $response = $this->delete(route('kamar.destroy', $kamar));

        $this->assertDeleted($kamar);
    }
}
