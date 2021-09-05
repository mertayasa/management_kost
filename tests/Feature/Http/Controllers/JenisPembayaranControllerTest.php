<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\JenisPembayaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JenisPembayaranController
 */
class JenisPembayaranControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('jenis-pembayaran.index'));

        $response->assertOk();
        $response->assertViewIs('jenis_pembayaran.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $jenisPembayarans = JenisPembayaran::factory()->count(3)->create();

        $response = $this->get(route('jenis-pembayaran.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('jenis-pembayaran.create'));

        $response->assertOk();
        $response->assertViewIs('jenis_pembayaran.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $response = $this->get(route('jenis-pembayaran.edit', $jenisPembayaran));

        $response->assertOk();
        $response->assertViewIs('jenis_pembayaran.edit');
        $response->assertViewHas('jenis_pembayaran');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JenisPembayaranController::class,
            'store',
            \App\Http\Requests\JenisPembayaranStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $jenis_pembayaran = $this->faker->word;

        $response = $this->post(route('jenis-pembayaran.store'), [
            'jenis_pembayaran' => $jenis_pembayaran,
        ]);

        $jenisPembayarans = JenisPembayaran::query()
            ->where('jenis_pembayaran', $jenis_pembayaran)
            ->get();
        $this->assertCount(1, $jenisPembayarans);
        $jenisPembayaran = $jenisPembayarans->first();

        $response->assertRedirect(route('jenis_pembayaran.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JenisPembayaranController::class,
            'update',
            \App\Http\Requests\JenisPembayaranUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();
        $jenis_pembayaran = $this->faker->word;

        $response = $this->put(route('jenis-pembayaran.update', $jenisPembayaran), [
            'jenis_pembayaran' => $jenis_pembayaran,
        ]);

        $jenisPembayaran->refresh();

        $response->assertRedirect(route('jenis_pembayaran.index'));

        $this->assertEquals($jenis_pembayaran, $jenisPembayaran->jenis_pembayaran);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $response = $this->delete(route('jenis-pembayaran.destroy', $jenisPembayaran));

        $this->assertDeleted($jenisPembayaran);
    }
}
