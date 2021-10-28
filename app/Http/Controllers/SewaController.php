<?php

namespace App\Http\Controllers;

use App\DataTables\SewaDataTable;
use App\Http\Requests\SewaStoreRequest;
use App\Http\Requests\SewaUpdateRequest;
use App\Models\Kamar;
use App\Models\Kost;
use App\Models\Penyewa;
use App\Models\Sewa;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
    public function datatable($status = null)
    {
        if($status != null){
            $sewa = Sewa::where('status_validasi', 0)->get();
        }else{
            $sewa = Sewa::all();
        }


        return SewaDataTable::set($sewa, $status);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Penyewa $penyewa = null)
    {
        // $penyewa = $this->pluckPenyewa();
        // $raw_kamar = $this->pluckKamar();
        // $kamar = $raw_kamar['kamar'];

        // $kamar_full = $raw_kamar['sum'] < 1 ? 'Tidak ada kamar tersedia' : '';
        // $penyewa_full = count($penyewa) < 1 ? 'Semua penyewa sudah memiliki kamar' : '';

        // return view('sewa.create', compact('penyewa', 'kamar', 'penyewa_full', 'kamar_full'));

        // dd($penyewa);

        $kost = Kost::pluck('nama', 'id');
        if($penyewa != null){
            $penyewa = [$penyewa->id => $penyewa->nama];
        }else{
            $penyewa = Penyewa::pluck('nama', 'id');
        }

        return view('sewa.create', compact('penyewa', 'kost'));
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
        $range_sewa = $this->checkAvailablity($request);

        $new_sewa_range = CarbonPeriod::create($request->tgl_masuk, $request->tgl_keluar ?? Carbon::now()->addYears(3)->format('Y-m-d'))->toArray();

        foreach($new_sewa_range as $range){
            if(array_search($range->format('Y-m-d'), $range_sewa)){
                return redirect()->back()->withInput()->with('error', 'Kamar tidak tersedia untuk tanggal yang dipilih');
            }
        }

        try{
            Sewa::create($request->all());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('success', 'Gagal menambahkan data sewa');
        }
        
        return redirect()->route('sewa.index')->with('success', 'Berhasil menambahkan data sewa');
    }

    public function checkAvailablity($request, $ignore_id = null)
    {
        $raw_sewa = Sewa::where('id_kamar', $request->id_kamar);
        if($ignore_id != null){
            $data_sewa = $raw_sewa->where('id', '!=', $ignore_id)->get();
        }else{
            $data_sewa = $raw_sewa->get();
        }

        $new_range = [];
        foreach($data_sewa as $sewa){
            array_push($new_range, $sewa->getDateRange());
        }

        return $this->flatten($new_range);
    }

    function flatten($data, $result = [])
    {
        foreach ($data as $flat) {
            if (is_array($flat)) {
                $result = $this->flatten($flat, $result);
            } else {
                $result[] = $flat;
            }
        }
    
        return $result;
    }

    /**
     * @param \App\Http\Requests\SewaUpdateRequest $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(SewaUpdateRequest $request, Sewa $sewa)
    {
        $range_sewa = $this->checkAvailablity($request, $sewa->id);

        $new_sewa_range = CarbonPeriod::create($request->tgl_masuk, $request->tgl_keluar ?? Carbon::now()->addYears(3)->format('Y-m-d'))->toArray();

        foreach($new_sewa_range as $range){
            if(array_search($range->format('Y-m-d'), $range_sewa)){
                return redirect()->back()->withInput()->with('error', 'Kamar tidak tersedia untuk tanggal yang dipilih');
            }
        }
        
        try{
            $sewa->update($request->all());
            $sewa->update(['status_validasi' => 0]);
        }catch(Exception $e){
            Log::info($e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data sewa');
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
