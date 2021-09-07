<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PembayaranDataTable
{
    static public function set($pembayaran){

        return Datatables::of($pembayaran)
            ->editColumn('id_jenis_pembayaran', function($pembayaran){
                return $pembayaran->jenis_pembayaran->jenis_pembayaran;
            })
            ->editColumn('id_penyewa', function($pembayaran){
                return $pembayaran->penyewa->nama;
            })
            ->editColumn('id_kamar', function($pembayaran){
                return $pembayaran->kamar->kost->nama .' | '.$pembayaran->kamar->no_kamar;
            })
            ->editColumn('jumlah', function($pembayaran){
                return formatPrice($pembayaran->jumlah);
            })
            ->editColumn('tgl_pembayaran', function($pembayaran){
                return indonesianDate($pembayaran->tgl_pembayaran);
            })
            ->editColumn('status_validasi', function ($pembayaran) {
                return getVerificationBadge($pembayaran);
            })
            ->addColumn('action', function ($pembayaran) {
                $deleteUrl = "'" . route('pembayaran.destroy', $pembayaran->id) . "', 'pembayaranDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('pembayaran.edit', $pembayaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'status_validasi'])->make(true);

    }
}
