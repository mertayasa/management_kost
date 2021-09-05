<?php

namespace App\Http\Controllers;

use App\DataTables\JenisPembayaranDataTable;
use App\Http\Requests\JenisPembayaranStoreRequest;
use App\Http\Requests\JenisPembayaranUpdateRequest;
use App\Models\JenisPembayaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisPembayaranController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('jenis_pembayaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $jenisPembayarans = JenisPembayaran::all();

        return JenisPembayaranDataTable::set($jenisPembayarans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('jenis_pembayaran.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPembayaran $jenisPembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, JenisPembayaran $jenisPembayaran)
    {
        return view('jenis_pembayaran.edit', compact('jenis_pembayaran'));
    }

    /**
     * @param \App\Http\Requests\JenisPembayaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPembayaranStoreRequest $request)
    {
        $jenisPembayaran = JenisPembayaran::create($request->validated());

        return redirect()->route('jenis_pembayaran.index');
    }

    /**
     * @param \App\Http\Requests\JenisPembayaranUpdateRequest $request
     * @param \App\Models\JenisPembayaran $jenisPembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPembayaranUpdateRequest $request, JenisPembayaran $jenisPembayaran)
    {
        $jenisPembayaran->update($request->validated());

        return redirect()->route('jenis_pembayaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPembayaran $jenisPembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JenisPembayaran $jenisPembayaran)
    {
        
        try {
            $jenisPembayaran->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data jenis pembayaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data jenis pembayaran']);
    }
}
