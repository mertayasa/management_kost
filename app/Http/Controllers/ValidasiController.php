<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidasiPemasukanRequest;
use App\Http\Requests\ValidasiPengeluaranRequest;
use App\Http\Requests\ValidasiPenyewaRequest;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Penyewa;
use App\Models\Sewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ValidasiController extends Controller
{
    public function index($active_tab = null)
    {
        return view('validasi.index', compact('active_tab'));
    }

    public function validasiSewa(Request $request, Sewa $sewa)
    {
        Log::info($request->all());
        try {
            $sewa->update([
                'status_validasi' => $request->status,
                'pernah_acc' => $request->status == 1 ? 1 : $sewa->pernah_acc,
                'alasan_ditolak' => $request->alasan
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data sewa']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data sewa']);
    }

    public function validasiPemasukan(Request $request, Pemasukan $pemasukan)
    {
        try {
            $pemasukan->update([
                'status_validasi' => $request->status,
                'alasan_ditolak' => $request->alasan
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data pemasukan']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data pemasukan']);
    }

    // public function validasiPengeluaran(Request $request, Pengeluaran $pengeluaran, $status)
    // {
    //     try {
    //         $pengeluaran->update(['status_validasi' => $status]);
    //     } catch (Exception $e) {
    //         Log::info($e->getMessage());
    //         return response(['code' => 0, 'message' => 'Gagal memvalidasi data pengeluaran']);
    //     }

    //     return response(['code' => 1, 'message' => 'Berhasil memvalidasi data pengeluaran']);
    // }
}
