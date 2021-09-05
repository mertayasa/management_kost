<?php

namespace App\Http\Controllers;

use App\DataTables\KostDataTable;
use App\Http\Requests\KostStoreRequest;
use App\Http\Requests\KostUpdateRequest;
use App\Models\Kost;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('kost.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $kosts = Kost::all();

        return KostDataTable::set($kosts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('kost.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kost $kost)
    {
        return view('kost.edit', compact('kost'));
    }

    /**
     * @param \App\Http\Requests\KostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KostStoreRequest $request)
    {
        try{
            Kost::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan kost baru');
        }

        return redirect()->route('kost.index')->with('success', 'Berhasil menambahkan kost baru');
    }

    /**
     * @param \App\Http\Requests\KostUpdateRequest $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function update(KostUpdateRequest $request, Kost $kost)
    {
        
        try{
            $kost->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah kost '.$kost->name);
        }

        return redirect()->route('kost.index')->with('success', 'Berhasil mengubah kost '.$kost->name);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kost $kost)
    {
        try {
            $kost->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data kost']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data kost']);
    }
}
