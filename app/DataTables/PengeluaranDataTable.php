<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class PengeluaranDataTable
{
    static public function set($pengeluaran, $req_validasi){

        return Datatables::of($pengeluaran)
            ->editColumn('id_jenis_pengeluaran', function($pengeluaran){
                return $pengeluaran->jenis_pengeluaran->jenis_pengeluaran;
            })
            ->editColumn('jumlah', function($pengeluaran){
                return formatPrice($pengeluaran->jumlah);
            })
            ->editColumn('tgl_pengeluaran', function($pengeluaran){
                return indonesianDate($pengeluaran->tgl_pengeluaran);
            })
            ->editColumn('keterangan', function($pengeluaran){
                return Str::limit($pengeluaran->keterangan, 30);
            })
            ->editColumn('status_validasi', function ($pengeluaran) {
                return getVerificationBadge($pengeluaran);
            })
            ->addColumn('action', function ($pengeluaran) use($req_validasi) {
                if(userRole() != 'admin'){
                    return '-';    
                }
                
                $approve_pengeluaran_url = "`" . route('validasi.pengeluaran', [$pengeluaran->id, 1]) . "`, `Apakah anda yakin menerima data pengeluaran sejumlah ( ". formatPrice($pengeluaran->jumlah) ." )`, `pengeluaranDatatable`";
                // $decline_pengeluaran_url = "`" . route('validasi.pengeluaran', [$pengeluaran->id, 2]) . "`, `Apakah anda yakin menolak data pengeluaran ( ". $pengeluaran->nama ." )`, `pengeluaranDatatable`";
                $deleteUrl = "'" . route('pengeluaran.destroy', $pengeluaran->id) . "', 'pengeluaranDatatable', '".$pengeluaran->nama."'";
                
                if($req_validasi != null){
                    return 
                        '<div class="btn-group">' .
                            '<a href="#" onclick="updateStatus(' . $approve_pengeluaran_url . ')" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Terima" style="margin-right: 5px">Terima</a>'.
                            '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                            '<a href="' . route('pengeluaran.edit', $pengeluaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" title="Rangkuman" data-bs-placement="bottom" title="Detail" >Edit</a>' .
                        '</div>';
                }


                if($pengeluaran->status_validasi != 1){
                    $deleteUrl = "'" . route('pengeluaran.destroy', $pengeluaran->id) . "', 'pengeluaranDatatable', 'pengeluaran sejumlah ". formatPrice($pengeluaran->jumlah)."'";
                    return
                        '<div class="btn-group">' .
                        '<a href="' . route('pengeluaran.edit', $pengeluaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                        '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                        '</div>';
                }
            })->addIndexColumn()->rawColumns(['action', 'status_validasi'])->make(true);

    }
}
