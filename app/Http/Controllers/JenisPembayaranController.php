<?php

namespace App\Http\Controllers;

use App\DataTables\JenisPembayaranDataTable;
use App\Http\Requests\JenisPembayaranStoreRequest;
use App\Http\Requests\JenisPembayaranUpdateRequest;
use App\Models\JenisPembayaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisPembayaranController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('jenis_pembayaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $jenisPembayarans = JenisPembayaran::all();

        return JenisPembayaranDataTable::set($jenisPembayarans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('jenis_pembayaran.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPembayaran $jenisPembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, JenisPembayaran $jenis_pembayaran)
    {
        return view('jenis_pembayaran.edit', compact('jenis_pembayaran'));
    }

    /**
     * @param \App\Http\Requests\JenisPembayaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPembayaranStoreRequest $request)
    {
        try{
            JenisPembayaran::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan jenis pembayaran baru');
        }
        
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Berhasil menambahkan jenis pembayaran baru');
    }

    /**
     * @param \App\Http\Requests\JenisPembayaranUpdateRequest $request
     * @param \App\Models\JenisPembayaran $jenisPembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPembayaranUpdateRequest $request, JenisPembayaran $jenis_pembayaran)
    {   
        try{
            $jenis_pembayaran->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah jenis pembayaran');
        }
        
        return redirect()->route('jenis_pembayaran.index')->with('success', 'Berhasil mengubah jenis pembayaran');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JenisPembayaran $jenisPembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JenisPembayaran $jenis_pembayaran)
    {
        
        try {
            if($jenis_pembayaran->jumlah_pembayaran > 0){
                return response(['code' => 0, 'message' => 'Jenis pembayaran masih aktif digunakan']);
            }

            $jenis_pembayaran->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data jenis pembayaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data jenis pembayaran']);
    }
}
