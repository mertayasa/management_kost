<?php

namespace App\Http\Controllers;

use App\DataTables\PemasukanDataTable;
use App\Http\Requests\PemasukanStoreRequest;
use App\Http\Requests\PemasukanUpdateRequest;
use App\Models\JenisPemasukan;
use App\Models\Pemasukan;
use App\Models\Penyewa;
use App\Models\Sewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PemasukanController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $penyewa = Penyewa::find(1);
        // dd($penyewa->sewa);
        return view('pemasukan.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request, $status = null)
    {
        if($status != null){
            $pemasukans = Pemasukan::where('status_validasi', $status)->get();
        }else{
            $pemasukans = Pemasukan::all();
        }

        return PemasukanDataTable::set($pemasukans, $status);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $penyewa = Penyewa::get()->where('status_sewa', 1)->pluck('nama', 'id');
        $jenis_pemasukan = JenisPemasukan::pluck('jenis_pemasukan', 'id');

        return view('pemasukan.create', compact('penyewa', 'jenis_pemasukan'));
    }

    public function getSewaByPenyewa(Penyewa $penyewa)
    {
        $data_sewa = Sewa::where('id_penyewa', $penyewa->id)->get()->pluck('nama_sewa', 'id');
        return response(['code' => 1, 'data_sewa' => $data_sewa]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasukan $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pemasukan $pemasukan)
    {
        $referer = request()->headers->get('referer');
        $back_url = strpos($referer, 'validasi') ? route('validasi.index', 'pemasukanTab') : route('pemasukan.index');

        $jenis_pemasukan = JenisPemasukan::pluck('jenis_pemasukan', 'id');
        return view('pemasukan.edit', compact('pemasukan', 'jenis_pemasukan', 'back_url'));
    }

    /**
     * @param \App\Http\Requests\PemasukanStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemasukanStoreRequest $request)
    {
        $data = $request->validated();
        $data['id_kamar'] = Sewa::find($data['id_sewa'])->id_kamar;
        try{
            Pemasukan::create($data);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pemasukan');
        }

        return redirect()->route('pemasukan.index')->with('success', 'Berhasil menambahkan data pemasukan');
    }

    /**
     * @param \App\Http\Requests\PemasukanUpdateRequest $request
     * @param \App\Models\Pemasukan $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(PemasukanUpdateRequest $request, Pemasukan $pemasukan)
    {
        try{
            $pemasukan->update($request->validated());
            $pemasukan->update(['status_validasi' => 0]);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pemasukan');
        }

        return redirect()->route('pemasukan.index')->with('success', 'Berhasil mengubah data pemasukan');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasukan $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pemasukan $pemasukan)
    {
        try {
            $pemasukan->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data pemasukan']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data pemasukan']);
    }
}
