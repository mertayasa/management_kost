<?php

namespace App\Http\Controllers;

use App\DataTables\PembayaranDataTable;
use App\Http\Requests\PembayaranStoreRequest;
use App\Http\Requests\PembayaranUpdateRequest;
use App\Models\Pembayaran;
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
        return view('pembayaran.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembayaran $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pembayaran $pembayaran)
    {
        return view('pembayaran.edit', compact('pembayaran'));
    }

    /**
     * @param \App\Http\Requests\PembayaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembayaranStoreRequest $request)
    {
        $pembayaran = Pembayaran::create($request->validated());

        return redirect()->route('pembayaran.index');
    }

    /**
     * @param \App\Http\Requests\PembayaranUpdateRequest $request
     * @param \App\Models\Pembayaran $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(PembayaranUpdateRequest $request, Pembayaran $pembayaran)
    {
        $pembayaran->update($request->validated());

        return redirect()->route('pembayaran.index');
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
