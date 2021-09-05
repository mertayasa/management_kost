<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\JenisPengeluaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JenisPengeluaranController
 */
class JenisPengeluaranControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('jenis-pengeluaran.index'));

        $response->assertOk();
        $response->assertViewIs('jenis_pengeluaran.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $jenisPengeluarans = JenisPengeluaran::factory()->count(3)->create();

        $response = $this->get(route('jenis-pengeluaran.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('jenis-pengeluaran.create'));

        $response->assertOk();
        $response->assertViewIs('jenis_pengeluaran.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $jenisPengeluaran = JenisPengeluaran::factory()->create();

        $response = $this->get(route('jenis-pengeluaran.edit', $jenisPengeluaran));

        $response->assertOk();
        $response->assertViewIs('jenis_pengeluaran.edit');
        $response->assertViewHas('jenis_pengeluaran');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JenisPengeluaranController::class,
            'store',
            \App\Http\Requests\JenisPengeluaranStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $jenis_pengeluaran = $this->faker->word;

        $response = $this->post(route('jenis-pengeluaran.store'), [
            'jenis_pengeluaran' => $jenis_pengeluaran,
        ]);

        $jenisPengeluarans = JenisPengeluaran::query()
            ->where('jenis_pengeluaran', $jenis_pengeluaran)
            ->get();
        $this->assertCount(1, $jenisPengeluarans);
        $jenisPengeluaran = $jenisPengeluarans->first();

        $response->assertRedirect(route('jenis_pengeluaran.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JenisPengeluaranController::class,
            'update',
            \App\Http\Requests\JenisPengeluaranUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $jenisPengeluaran = JenisPengeluaran::factory()->create();
        $jenis_pengeluaran = $this->faker->word;

        $response = $this->put(route('jenis-pengeluaran.update', $jenisPengeluaran), [
            'jenis_pengeluaran' => $jenis_pengeluaran,
        ]);

        $jenisPengeluaran->refresh();

        $response->assertRedirect(route('jenis_pengeluaran.index'));

        $this->assertEquals($jenis_pengeluaran, $jenisPengeluaran->jenis_pengeluaran);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $jenisPengeluaran = JenisPengeluaran::factory()->create();

        $response = $this->delete(route('jenis-pengeluaran.destroy', $jenisPengeluaran));

        $this->assertDeleted($jenisPengeluaran);
    }
}
