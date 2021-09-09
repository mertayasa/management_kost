<?php

namespace App\Http\Controllers;

use App\DataTables\PembayaranDataTable;
use App\Http\Requests\PembayaranStoreRequest;
use App\Http\Requests\PembayaranUpdateRequest;
use App\Models\JenisPembayaran;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pembayaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $pembayarans = Pembayaran::all();

        return PembayaranDataTable::set($pembayarans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $penyewa = Penyewa::get()->where('status_sewa', 1)->pluck('nama', 'id');
        $jenis_pembayaran = JenisPembayaran::pluck('jenis_pembayaran', 'id');
        return view('pembayaran.create', compact('penyewa', 'jenis_pembayaran'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembayaran $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pembayaran $pembayaran)
    {
        $jenis_pembayaran = JenisPembayaran::pluck('jenis_pembayaran', 'id');
        return view('pembayaran.edit', compact('pembayaran', 'jenis_pembayaran'));
    }

    /**
     * @param \App\Http\Requests\PembayaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembayaranStoreRequest $request)
    {
        $data = $request->validated();
        $data['id_kamar'] = Penyewa::find($data['id_penyewa'])->sewa()->whereNull('tgl_keluar')->get()[0]->id_kamar;
        try{
            Pembayaran::create($data);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pembayaran');
        }

        return redirect()->route('pembayaran.index')->with('success', 'Berhasil menambahkan data pembayaran');
    }

    /**
     * @param \App\Http\Requests\PembayaranUpdateRequest $request
     * @param \App\Models\Pembayaran $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(PembayaranUpdateRequest $request, Pembayaran $pembayaran)
    {
        try{
            $pembayaran->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pembayaran');
        }

        return redirect()->route('pembayaran.index')->with('success', 'Berhasil mengubah data pembayaran');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembayaran $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pembayaran $pembayaran)
    {
        try {
            $pembayaran->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data pembayaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data pembayaran']);
    }
}
