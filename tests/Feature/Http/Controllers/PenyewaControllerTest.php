<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PenyewaController
 */
class PenyewaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $response = $this->get(route('penyewa.index'));

        $response->assertOk();
        $response->assertViewIs('penyewa.index');
        $response->assertViewHas('penyewa');
    }


    /**
     * @test
     */
    public function datatable_behaves_as_expected()
    {
        $penyewas = Penyewa::factory()->count(3)->create();

        $response = $this->get(route('penyewa.datatable'));
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('penyewa.create'));

        $response->assertOk();
        $response->assertViewIs('penyewa.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $penyewa = Penyewa::factory()->create();

        $response = $this->get(route('penyewa.edit', $penyewa));

        $response->assertOk();
        $response->assertViewIs('penyewa.edit');
        $response->assertViewHas('penyewa');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PenyewaController::class,
            'store',
            \App\Http\Requests\PenyewaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $nama = $this->faker->word;
        $alamat = $this->faker->text;
        $no_ktp = $this->faker->word;
        $telpon = $this->faker->word;
        $pekerjaan = $this->faker->text;
        $status_validasi = $this->faker->numberBetween(-8, 8);

        $response = $this->post(route('penyewa.store'), [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_ktp' => $no_ktp,
            'telpon' => $telpon,
            'pekerjaan' => $pekerjaan,
            'status_validasi' => $status_validasi,
        ]);

        $penyewas = Penyewa::query()
            ->where('nama', $nama)
            ->where('alamat', $alamat)
            ->where('no_ktp', $no_ktp)
            ->where('telpon', $telpon)
            ->where('pekerjaan', $pekerjaan)
            ->where('status_validasi', $status_validasi)
            ->get();
        $this->assertCount(1, $penyewas);
        $penyewa = $penyewas->first();

        $response->assertRedirect(route('penyewa.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PenyewaController::class,
            'update',
            \App\Http\Requests\PenyewaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $penyewa = Penyewa::factory()->create();
        $nama = $this->faker->word;
        $alamat = $this->faker->text;
        $no_ktp = $this->faker->word;
        $telpon = $this->faker->word;
        $pekerjaan = $this->faker->text;
        $status_validasi = $this->faker->numberBetween(-8, 8);

        $response = $this->put(route('penyewa.update', $penyewa), [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_ktp' => $no_ktp,
            'telpon' => $telpon,
            'pekerjaan' => $pekerjaan,
            'status_validasi' => $status_validasi,
        ]);

        $penyewa->refresh();

        $response->assertRedirect(route('penyewa.index'));

        $this->assertEquals($nama, $penyewa->nama);
        $this->assertEquals($alamat, $penyewa->alamat);
        $this->assertEquals($no_ktp, $penyewa->no_ktp);
        $this->assertEquals($telpon, $penyewa->telpon);
        $this->assertEquals($pekerjaan, $penyewa->pekerjaan);
        $this->assertEquals($status_validasi, $penyewa->status_validasi);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $penyewa = Penyewa::factory()->create();

        $response = $this->delete(route('penyewa.destroy', $penyewa));

        $this->assertDeleted($penyewa);
    }
}
