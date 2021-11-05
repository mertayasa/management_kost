<?php

namespace App\Http\Controllers;

use App\DataTables\KostDataTable;
use App\Http\Requests\KostStoreRequest;
use App\Http\Requests\KostUpdateRequest;
use App\Models\Kamar;
use App\Models\Kost;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
    public function datatable()
    {
        $kosts = Kost::with('sewa')->get();

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

    public function show(Kost $kost)
    {
        // dd($kost);
        $url_datatable = route('kamar.datatable', $kost->id);

        return view('kost.show', compact('kost', 'url_datatable'));
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
            $kost = Kost::all();
            foreach($kost as $ko){
                if(Str::slug($ko->alamat) === Str::slug($request->alamat)){
                    return redirect()->back()->withInput()->with('error', 'Alamat sudah dipakai');
                }
            }
            Kost::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan kos baru');
        }

        return redirect()->route('kost.index')->with('success', 'Berhasil menambahkan kos baru');
    }

    /**
     * @param \App\Http\Requests\KostUpdateRequest $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function update(KostUpdateRequest $request, Kost $kost)
    {
        
        try{
            $kost_else = Kost::whereNotIn('id', [$kost->id])->get();
            foreach($kost_else as $ko){
                if(Str::slug($ko->alamat) === Str::slug($request->alamat)){
                    return redirect()->back()->withInput()->with('error', 'Alamat sudah dipakai');
                }
            }
            $kost->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah kos '.$kost->name);
        }

        return redirect()->route('kost.index')->with('success', 'Berhasil mengubah kos '.$kost->name);
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
            return response(['code' => 0, 'message' => 'Gagal menghapus data kos']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data kos']);
    }

    public function getKamar(Kost $kost)
    {
        $kost->load('kamar');
        return response(['code' => 1, 'kamar' => $kost->kamar]);
    }
}
