<?php

namespace App\Http\Controllers;

use App\DataTables\PenyewaDataTable;
use App\Http\Requests\PenyewaStoreRequest;
use App\Http\Requests\PenyewaUpdateRequest;
use App\Models\Penyewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenyewaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('penyewa.index', compact('penyewa'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $penyewas = Penyewa::all();

        return PenyewaDataTable::set($penyewas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('penyewa.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Penyewa $penyewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Penyewa $penyewa)
    {
        return view('penyewa.edit', compact('penyewa'));
    }

    /**
     * @param \App\Http\Requests\PenyewaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenyewaStoreRequest $request)
    {
        $penyewa = Penyewa::create($request->validated());

        return redirect()->route('penyewa.index');
    }

    /**
     * @param \App\Http\Requests\PenyewaUpdateRequest $request
     * @param \App\Models\Penyewa $penyewa
     * @return \Illuminate\Http\Response
     */
    public function update(PenyewaUpdateRequest $request, Penyewa $penyewa)
    {
        $penyewa->update($request->validated());

        return redirect()->route('penyewa.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Penyewa $penyewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Penyewa $penyewa)
    {
        try {
            $penyewa->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data penyewa']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data penyewa']);
    }
}
