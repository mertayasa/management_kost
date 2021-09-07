<?php

namespace App\Http\Controllers;

use App\DataTables\PengeluaranDataTable;
use App\Http\Requests\PengeluaranStoreRequest;
use App\Http\Requests\PengeluaranUpdateRequest;
use App\Models\JenisPengeluaran;
use App\Models\Pengeluaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengeluaranController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pengeluaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $pengeluarans = Pengeluaran::all();

        return PengeluaranDataTable::set($pengeluarans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $jenis_pengeluaran = JenisPengeluaran::pluck('jenis_pengeluaran', 'id');
        return view('pengeluaran.create', compact('jenis_pengeluaran'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * @param \App\Http\Requests\PengeluaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengeluaranStoreRequest $request)
    {
        try{
            Pengeluaran::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan pengeluaran');
        }
        
        return redirect()->route('pengeluaran.index')->with('success', 'Berhasil menambahkan pengeluaran');
    }

    /**
     * @param \App\Http\Requests\PengeluaranUpdateRequest $request
     * @param \App\Models\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(PengeluaranUpdateRequest $request, Pengeluaran $pengeluaran)
    {
        try{
            $pengeluaran->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah pengeluaran');
        }
        
        return redirect()->route('pengeluaran.index')->with('success', 'Berhasil mengubah pengeluaran');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data pengeluaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data pengeluaran']);
    }
}
