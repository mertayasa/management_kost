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
        return view('penyewa.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request, $status = null)
    {
        if($status != null){
            $penyewas = Penyewa::where('status_validasi', $status)->get();
        }else{
            $penyewas = Penyewa::all();
        }

        return PenyewaDataTable::set($penyewas, $status);
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
        $referer = request()->headers->get('referer');
        $back_url = strpos($referer, 'validasi') ? route('validasi.index', 'penyewaTab') : route('penyewa.index');
        return view('penyewa.edit', compact('penyewa', 'back_url'));
    }

    public function getNamaKamar(Penyewa $penyewa)
    {
        return response(['code' => 1, 'data' => $penyewa->kamar_kost ?? 'Tidak Ada Data']);
    }

    /**
     * @param \App\Http\Requests\PenyewaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenyewaStoreRequest $request)
    {
        try{
            Penyewa::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan penyewa');
        }
        
        return redirect()->route('penyewa.index')->with('success', 'Berhasil menambahkan penyewa');
    }

    /**
     * @param \App\Http\Requests\PenyewaUpdateRequest $request
     * @param \App\Models\Penyewa $penyewa
     * @return \Illuminate\Http\Response
     */
    public function update(PenyewaUpdateRequest $request, Penyewa $penyewa)
    {
        try{
            $penyewa->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah penyewa');
        }
        
        return redirect()->route('penyewa.index')->with('success', 'Berhasil mengubah penyewa');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Penyewa $penyewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Penyewa $penyewa)
    {
        try {
            if($penyewa->status_sewa > 0){
                return response(['code' => 0, 'message' => 'Penyewa masih memiliki data sewa']);
            }

            // $penyewa->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data penyewa']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data penyewa']);
    }
}
