<?php

namespace App\Http\Controllers;

use App\DataTables\SewaDataTable;
use App\Http\Requests\SewaStoreRequest;
use App\Http\Requests\SewaUpdateRequest;
use App\Models\Kamar;
use App\Models\Kost;
use App\Models\Penyewa;
use App\Models\Sewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SewaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $sewa = Sewa::all();
        // dd($sewa);
        return view('sewa.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $sewas = Sewa::all();

        return SewaDataTable::set($sewas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $penyewa = $this->pluckPenyewa();
        $raw_kamar = $this->pluckKamar();
        $kamar = $raw_kamar['kamar'];

        $kamar_full = $raw_kamar['sum'] < 1 ? 'Tidak ada kamar tersedia' : '';
        $penyewa_full = count($penyewa) < 1 ? 'Semua penyewa sudah memiliki kamar' : '';

        return view('sewa.create', compact('penyewa', 'kamar', 'penyewa_full', 'kamar_full'));
    }

    private function pluckPenyewa()
    {
        $penyewa = Penyewa::get()->where('status_sewa', 0)->pluck('nama', 'id');
        return $penyewa;
    }

    private function pluckKamar()
    {
        $raw_kost = Kost::get();
        $kamar = [];

        $sum = 0;

        foreach($raw_kost as $key => $kost){
            $list = $kost->kamar->where('jumlah_sewa', 0)->pluck('no_kamar', 'id')->toArray();
            $kamar += [$kost->nama => $list];
            $sum = $sum + count($list);
        }

        return ['kamar' => $kamar, 'sum' => $sum];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sewa $sewa)
    {
        return view('sewa.edit', compact('sewa'));
    }

    /**
     * @param \App\Http\Requests\SewaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SewaStoreRequest $request)
    {
        try{
            Sewa::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan data sewa');
        }
        
        return redirect()->route('sewa.index')->with('success', 'Berhasil menambahkan data sewa');
    }

    /**
     * @param \App\Http\Requests\SewaUpdateRequest $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(SewaUpdateRequest $request, Sewa $sewa)
    {
        try{
            $sewa->update($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal mengubah data sewa');
        }
        
        return redirect()->route('sewa.index')->with('success', 'Berhasil mengubah data sewa');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sewa $sewa)
    {
        try {
            $sewa->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data sewa']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data sewa']);
    }
}
