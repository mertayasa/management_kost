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
    public function index()
    {
        return view('validasi.index');
    }

    public function validasiPenyewa(ValidasiPenyewaRequest $request, Penyewa $penyewa)
    {
        try {
            $penyewa->update(['status_validasi' => 1]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data penyewa']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data penyewa']);
    }

    public function validasiPembayaran(ValidasiPembayaranRequest $request, Pembayaran $pembayaran)
    {
        try {
            $pembayaran->update(['status_validasi' => 1]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data pembayaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data pembayaran']);
    }

    public function validasiPengeluaran(ValidasiPengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->update(['status_validasi' => 1]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal memvalidasi data pengeluaran']);
        }

        return response(['code' => 1, 'message' => 'Berhasil memvalidasi data pengeluaran']);
    }
}
