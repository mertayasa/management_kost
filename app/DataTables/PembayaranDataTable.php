<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PembayaranDataTable
{
    static public function set($pembayaran, $req_validasi){

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
            ->addColumn('action', function ($pembayaran) use($req_validasi) {
                if(userRole() != 'admin'){
                    return '-';    
                }

                $approve_pembayaran_url = "`" . route('validasi.pembayaran', [$pembayaran->id, 1]) . "`, `Apakah anda yakin menerima data pembayaran sejumlah ( ". formatPrice($pembayaran->jumlah) ." )`, `pembayaranDatatable`";
                // $decline_pembayaran_url = "`" . route('validasi.pembayaran', [$pembayaran->id, 2]) . "`, `Apakah anda yakin menolak data pembayaran ( ". $pembayaran->nama ." )`, `pembayaranDatatable`";
                $deleteUrl = "'" . route('pembayaran.destroy', $pembayaran->id) . "', 'pembayaranDatatable', '".$pembayaran->nama."'";
                
                if($req_validasi != null){
                    return 
                        '<div class="btn-group">' .
                            '<a href="#" onclick="updateStatus(' . $approve_pembayaran_url . ')" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Terima" style="margin-right: 5px">Terima</a>'.
                            '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                            '<a href="' . route('pembayaran.edit', $pembayaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" title="Rangkuman" data-bs-placement="bottom" title="Detail" >Edit</a>' .
                        '</div>';
                }

                if($pembayaran->status_validasi != 1){
                    $deleteUrl = "'" . route('pembayaran.destroy', $pembayaran->id) . "', 'pembayaranDatatable'";
                    return
                        '<div class="btn-group">' .
                        '<a href="' . route('pembayaran.edit', $pembayaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                        '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                        '</div>';
                }
            })->addIndexColumn()->rawColumns(['action', 'status_validasi'])->make(true);

    }
}
