<?php

namespace App\Http\Controllers;

use App\DataTables\JenisPengeluaranDataTable;
use App\Http\Requests\JenisPengeluaranStoreRequest;
use App\Http\Requests\JenisPengeluaranUpdateRequest;
use App\Models\JenisPengeluaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisPengeluaranController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('jenis_pengeluaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $jenisPengeluarans = JenisPengeluaran::all();
        return JenisPengeluaranDataTable::set($jenisPengeluarans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('jenis_pengeluaran.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPengeluaran $jenisPengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, JenisPengeluaran $jenisPengeluaran)
    {
        return view('jenis_pengeluaran.edit', compact('jenis_pengeluaran'));
    }

    /**
     * @param \App\Http\Requests\JenisPengeluaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPengeluaranStoreRequest $request)
    {
        $jenisPengeluaran = JenisPengeluaran::create($request->validated());

        return redirect()->route('jenis_pengeluaran.index');
    }

    /**
     * @param \App\Http\Requests\JenisPengeluaranUpdateRequest $request
     * @param \App\Models\JenisPengeluaran $jenisPengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPengeluaranUpdateRequest $request, JenisPengeluaran $jenisPengeluaran)
    {
        $jenisPengeluaran->update($request->validated());

        return redirect()->route('jenis_pengeluaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPengeluaran $jenisPengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JenisPengeluaran $jenisPengeluaran)
    {
        try {
            $jenisPengeluaran->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data jenis pengeluaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data jenis pengeluaran']);
    }
}
