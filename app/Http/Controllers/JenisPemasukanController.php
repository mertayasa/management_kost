<?php

namespace App\Http\Controllers;

use App\DataTables\JenisPemasukanDataTable;
use App\Http\Requests\JenisPemasukanStoreRequest;
use App\Http\Requests\JenisPemasukanUpdateRequest;
use App\Models\JenisPemasukan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisPemasukanController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('jenis_pemasukan.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $jenisPemasukans = JenisPemasukan::all();

        return JenisPemasukanDataTable::set($jenisPemasukans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('jenis_pemasukan.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPemasukan $jenisPemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, JenisPemasukan $jenis_pemasukan)
    {
        return view('jenis_pemasukan.edit', compact('jenis_pemasukan'));
    }

    /**
     * @param \App\Http\Requests\JenisPemasukanStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPemasukanStoreRequest $request)
    {
        try{
            JenisPemasukan::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan jenis pemasukan baru');
        }
        
        return redirect()->route('jenis_pemasukan.index')->with('success', 'Berhasil menambahkan jenis pemasukan baru');
    }

    /**
     * @param \App\Http\Requests\JenisPemasukanUpdateRequest $request
     * @param \App\Models\JenisPemasukan $jenisPemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPemasukanUpdateRequest $request, JenisPemasukan $jenis_pemasukan)
    {   
        try{
            $jenis_pemasukan->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah jenis pemasukan');
        }
        
        return redirect()->route('jenis_pemasukan.index')->with('success', 'Berhasil mengubah jenis pemasukan');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPemasukan $jenisPemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JenisPemasukan $jenis_pemasukan)
    {
        
        try {
            if($jenis_pemasukan->jumlah_pemasukan > 0){
                return response(['code' => 0, 'message' => 'Jenis pemasukan masih aktif digunakan']);
            }

            $jenis_pemasukan->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data jenis pemasukan']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data jenis pemasukan']);
    }
}
