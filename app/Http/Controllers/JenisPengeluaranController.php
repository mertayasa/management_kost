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
        $jenis_pengeluarans = JenisPengeluaran::all();
        return JenisPengeluaranDataTable::set($jenis_pengeluarans);
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
     * @param \App\Models\JenisPengeluaran $jenis_pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, JenisPengeluaran $jenis_pengeluaran)
    {
        return view('jenis_pengeluaran.edit', compact('jenis_pengeluaran'));
    }

    /**
     * @param \App\Http\Requests\JenisPengeluaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPengeluaranStoreRequest $request)
    {
        try{
            JenisPengeluaran::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan jenis pengeluaran');
        }
        
        return redirect()->route('jenis_pengeluaran.index')->with('success', 'Berhasil menambahkan jenis pengeluaran');
    }

    /**
     * @param \App\Http\Requests\JenisPengeluaranUpdateRequest $request
     * @param \App\Models\JenisPengeluaran $jenis_pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPengeluaranUpdateRequest $request, JenisPengeluaran $jenis_pengeluaran)
    {
        try{
            $jenis_pengeluaran->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah jenis pengeluaran');
        }
        
        return redirect()->route('jenis_pengeluaran.index')->with('success', 'Berhasil mengubah jenis pengeluaran');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPengeluaran $jenis_pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JenisPengeluaran $jenis_pengeluaran)
    {
        try {
            if($jenis_pengeluaran->jumlah_pengeluaran > 0){
                return response(['code' => 0, 'message' => 'Jenis pengeluaran masih aktif digunakan']);
            }

            $jenis_pengeluaran->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data jenis pengeluaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data jenis pengeluaran']);
    }
}
