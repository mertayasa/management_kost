<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PenyewaDataTable
{
    static public function set($penyewa, $req_validasi = null)
    { 
        return Datatables::of($penyewa)
            ->editColumn('status_validasi', function ($penyewa) {
                return getVerificationBadge($penyewa);
            })

            ->addColumn('action', function ($penyewa) use($req_validasi) {
                $approve_penyewa_url = "`" . route('validasi.penyewa', [$penyewa->id, 1]) . "`, `Apakah anda yakin menerima data penyewa ( ". $penyewa->nama ." )`, `penyewaDatatable`";
                // $decline_penyewa_url = "`" . route('validasi.penyewa', [$penyewa->id, 2]) . "`, `Apakah anda yakin menolak data penyewa ( ". $penyewa->nama ." )`, `penyewaDatatable`";
                $deleteUrl = "'" . route('penyewa.destroy', $penyewa->id) . "', 'penyewaDatatable', '".$penyewa->nama."'";
                
                if($req_validasi != null){
                    return 
                        '<div class="btn-group">' .
                            '<a href="#" onclick="updateStatus(' . $approve_penyewa_url . ')" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Terima" style="margin-right: 5px">Terima</a>'.
                            '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                            '<a href="' . route('penyewa.edit', $penyewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" title="Rangkuman" data-bs-placement="bottom" title="Detail" >Edit</a>' .
                        '</div>';
                }

                return
                    '<div class="btn-group">' .
                    '<a href="' . route('penyewa.edit', $penyewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'photo', 'status_validasi'])->make(true);
    }
}
