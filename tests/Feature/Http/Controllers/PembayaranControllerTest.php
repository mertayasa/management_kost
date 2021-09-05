<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PembayaranController
 */
class PembayaranControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('pembayaran.index'));

        $response->assertOk();
        $response->assertViewIs('pembayaran.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $pembayarans = Pembayaran::factory()->count(3)->create();

        $response = $this->get(route('pembayaran.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pembayaran.create'));

        $response->assertOk();
        $response->assertViewIs('pembayaran.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pembayaran = Pembayaran::factory()->create();

        $response = $this->get(route('pembayaran.edit', $pembayaran));

        $response->assertOk();
        $response->assertViewIs('pembayaran.edit');
        $response->assertViewHas('pembayaran');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PembayaranController::class,
            'store',
            \App\Http\Requests\PembayaranStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $id_jenis_pembayaran = $this->faker->randomNumber();
        $id_penyewa = $this->faker->randomNumber();
        $id_kamar = $this->faker->randomNumber();
        $jumlah = $this->faker->numberBetween(-10000, 10000);
        $tgl_pembayaran = $this->faker->date();

        $response = $this->post(route('pembayaran.store'), [
            'id_jenis_pembayaran' => $id_jenis_pembayaran,
            'id_penyewa' => $id_penyewa,
            'id_kamar' => $id_kamar,
            'jumlah' => $jumlah,
            'tgl_pembayaran' => $tgl_pembayaran,
        ]);

        $pembayarans = Pembayaran::query()
            ->where('id_jenis_pembayaran', $id_jenis_pembayaran)
            ->where('id_penyewa', $id_penyewa)
            ->where('id_kamar', $id_kamar)
            ->where('jumlah', $jumlah)
            ->where('tgl_pembayaran', $tgl_pembayaran)
            ->get();
        $this->assertCount(1, $pembayarans);
        $pembayaran = $pembayarans->first();

        $response->assertRedirect(route('pembayaran.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PembayaranController::class,
            'update',
            \App\Http\Requests\PembayaranUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pembayaran = Pembayaran::factory()->create();
        $id_jenis_pembayaran = $this->faker->randomNumber();
        $id_penyewa = $this->faker->randomNumber();
        $id_kamar = $this->faker->randomNumber();
        $jumlah = $this->faker->numberBetween(-10000, 10000);
        $tgl_pembayaran = $this->faker->date();

        $response = $this->put(route('pembayaran.update', $pembayaran), [
            'id_jenis_pembayaran' => $id_jenis_pembayaran,
            'id_penyewa' => $id_penyewa,
            'id_kamar' => $id_kamar,
            'jumlah' => $jumlah,
            'tgl_pembayaran' => $tgl_pembayaran,
        ]);

        $pembayaran->refresh();

        $response->assertRedirect(route('pembayaran.index'));

        $this->assertEquals($id_jenis_pembayaran, $pembayaran->id_jenis_pembayaran);
        $this->assertEquals($id_penyewa, $pembayaran->id_penyewa);
        $this->assertEquals($id_kamar, $pembayaran->id_kamar);
        $this->assertEquals($jumlah, $pembayaran->jumlah);
        $this->assertEquals(Carbon::parse($tgl_pembayaran), $pembayaran->tgl_pembayaran);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $pembayaran = Pembayaran::factory()->create();

        $response = $this->delete(route('pembayaran.destroy', $pembayaran));

        $this->assertDeleted($pembayaran);
    }
}
