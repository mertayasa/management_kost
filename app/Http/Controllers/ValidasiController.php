<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidasiPembayaranRequest;
use App\Http\Requests\ValidasiPengeluaranRequest;
use App\Http\Requests\ValidasiPenyewaRequest;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penyewa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ValidasiController extends Controller
{
    public function index($active_tab = null)
    {
        return view('validasi.index', compact('active_tab'));
    }

    public function validasiPenyewa(Request $request, Penyewa $penyewa, $status)
    {
        try {
            $penyewa->update(['status_validasi' => $status]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data penyewa']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data penyewa']);
    }

    public function validasiPembayaran(Request $request, Pembayaran $pembayaran, $status)
    {
        try {
            $pembayaran->update(['status_validasi' => $status]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data pembayaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data pembayaran']);
    }

    public function validasiPengeluaran(Request $request, Pengeluaran $pengeluaran, $status)
    {
        try {
            $pengeluaran->update(['status_validasi' => $status]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data pengeluaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data pengeluaran']);
    }
}
