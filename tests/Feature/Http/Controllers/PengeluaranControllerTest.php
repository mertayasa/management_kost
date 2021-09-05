<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PengeluaranController
 */
class PengeluaranControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('pengeluaran.index'));

        $response->assertOk();
        $response->assertViewIs('pengeluaran.index');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $pengeluarans = Pengeluaran::factory()->count(3)->create();

        $response = $this->get(route('pengeluaran.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pengeluaran.create'));

        $response->assertOk();
        $response->assertViewIs('pengeluaran.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pengeluaran = Pengeluaran::factory()->create();

        $response = $this->get(route('pengeluaran.edit', $pengeluaran));

        $response->assertOk();
        $response->assertViewIs('pengeluaran.edit');
        $response->assertViewHas('pengeluaran');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PengeluaranController::class,
            'store',
            \App\Http\Requests\PengeluaranStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $id_jenis_pengeluaran = $this->faker->randomNumber();
        $tgl_pengeluaran = $this->faker->date();
        $keterangan = $this->faker->text;
        $jumlah = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('pengeluaran.store'), [
            'id_jenis_pengeluaran' => $id_jenis_pengeluaran,
            'tgl_pengeluaran' => $tgl_pengeluaran,
            'keterangan' => $keterangan,
            'jumlah' => $jumlah,
        ]);

        $pengeluarans = Pengeluaran::query()
            ->where('id_jenis_pengeluaran', $id_jenis_pengeluaran)
            ->where('tgl_pengeluaran', $tgl_pengeluaran)
            ->where('keterangan', $keterangan)
            ->where('jumlah', $jumlah)
            ->get();
        $this->assertCount(1, $pengeluarans);
        $pengeluaran = $pengeluarans->first();

        $response->assertRedirect(route('pengeluaran.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PengeluaranController::class,
            'update',
            \App\Http\Requests\PengeluaranUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pengeluaran = Pengeluaran::factory()->create();
        $id_jenis_pengeluaran = $this->faker->randomNumber();
        $tgl_pengeluaran = $this->faker->date();
        $keterangan = $this->faker->text;
        $jumlah = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('pengeluaran.update', $pengeluaran), [
            'id_jenis_pengeluaran' => $id_jenis_pengeluaran,
            'tgl_pengeluaran' => $tgl_pengeluaran,
            'keterangan' => $keterangan,
            'jumlah' => $jumlah,
        ]);

        $pengeluaran->refresh();

        $response->assertRedirect(route('pengeluaran.index'));

        $this->assertEquals($id_jenis_pengeluaran, $pengeluaran->id_jenis_pengeluaran);
        $this->assertEquals(Carbon::parse($tgl_pengeluaran), $pengeluaran->tgl_pengeluaran);
        $this->assertEquals($keterangan, $pengeluaran->keterangan);
        $this->assertEquals($jumlah, $pengeluaran->jumlah);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $pengeluaran = Pengeluaran::factory()->create();

        $response = $this->delete(route('pengeluaran.destroy', $pengeluaran));

        $this->assertDeleted($pengeluaran);
    }
}
