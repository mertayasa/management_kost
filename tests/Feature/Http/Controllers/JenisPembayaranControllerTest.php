<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\JenisPemasukan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JenisPemasukanController
 */
class JenisPemasukanControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('jenis-pemasukan.index'));

        $response->assertOk();
        $response->assertViewIs('jenis_pemasukan.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $jenisPemasukans = JenisPemasukan::factory()->count(3)->create();

        $response = $this->get(route('jenis-pemasukan.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('jenis-pemasukan.create'));

        $response->assertOk();
        $response->assertViewIs('jenis_pemasukan.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $jenisPemasukan = JenisPemasukan::factory()->create();

        $response = $this->get(route('jenis-pemasukan.edit', $jenisPemasukan));

        $response->assertOk();
        $response->assertViewIs('jenis_pemasukan.edit');
        $response->assertViewHas('jenis_pemasukan');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JenisPemasukanController::class,
            'store',
            \App\Http\Requests\JenisPemasukanStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $jenis_pemasukan = $this->faker->word;

        $response = $this->post(route('jenis-pemasukan.store'), [
            'jenis_pemasukan' => $jenis_pemasukan,
        ]);

        $jenisPemasukans = JenisPemasukan::query()
            ->where('jenis_pemasukan', $jenis_pemasukan)
            ->get();
        $this->assertCount(1, $jenisPemasukans);
        $jenisPemasukan = $jenisPemasukans->first();

        $response->assertRedirect(route('jenis_pemasukan.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JenisPemasukanController::class,
            'update',
            \App\Http\Requests\JenisPemasukanUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $jenisPemasukan = JenisPemasukan::factory()->create();
        $jenis_pemasukan = $this->faker->word;

        $response = $this->put(route('jenis-pemasukan.update', $jenisPemasukan), [
            'jenis_pemasukan' => $jenis_pemasukan,
        ]);

        $jenisPemasukan->refresh();

        $response->assertRedirect(route('jenis_pemasukan.index'));

        $this->assertEquals($jenis_pemasukan, $jenisPemasukan->jenis_pemasukan);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $jenisPemasukan = JenisPemasukan::factory()->create();

        $response = $this->delete(route('jenis-pemasukan.destroy', $jenisPemasukan));

        $this->assertDeleted($jenisPemasukan);
    }
}
