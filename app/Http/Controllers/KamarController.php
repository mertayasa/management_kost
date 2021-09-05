<?php

namespace App\Http\Controllers;

use App\DataTables\KamarDataTable;
use App\Http\Requests\KamarStoreRequest;
use App\Http\Requests\KamarUpdateRequest;
use App\Models\Kamar;
use App\Models\Kost;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KamarController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('kamar.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $kamars = Kamar::all();
        return KamarDataTable::set($kamars);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $kost = Kost::pluck('nama', 'id');
        return view('kamar.create', compact('kost'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kamar $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kamar $kamar)
    {
        $kost = Kost::pluck('nama', 'id');
        return view('kamar.edit', compact('kamar', 'kost'));
    }

    /**
     * @param \App\Http\Requests\KamarStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamarStoreRequest $request)
    {   
        try{
            Kamar::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan kamar baru');
        }

        return redirect()->route('kamar.index')->with('success', 'Berhasil menambahkan kamar baru');
    }

    /**
     * @param \App\Http\Requests\KamarUpdateRequest $request
     * @param \App\Models\Kamar $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(KamarUpdateRequest $request, Kamar $kamar)
    {   
        try{
            $kamar->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan kamar baru');
        }

        return redirect()->route('kamar.index')->with('success', 'Berhasil menambahkan kamar baru');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kamar $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kamar $kamar)
    {
        try {
            $kamar->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data kamar']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data kamar']);
    }
}
