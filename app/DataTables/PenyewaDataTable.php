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

            ->addColumn('status', function($penyewa){
                return $penyewa->status_sewa == 0 ? 'Tidak Menyewa' : 'Menyewa';
            })

            ->addColumn('action', function ($penyewa) use($req_validasi) {

                // if(userRole() == 'pegawai'){
                //     return '<div class="btn-group">' .
                //     '<a href="' . route('penyewa.edit', $penyewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" title="Rangkuman" data-bs-placement="bottom" title="Detail" >Edit</a>' .
                // '</div>';
                // }

                if(showFor(['manager'])){
                    return '<div class="btn-group">' .
                        '<a href="' . route('penyewa.show', $penyewa->id) . '" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >View</a>' .
                    '</div>';
                }

                $deleteUrl = "'" . route('penyewa.destroy', $penyewa->id) . "', 'penyewaDatatable', '".$penyewa->nama."'";

                return
                    '<div class="btn-group">' .
                    '<a href="' . route('penyewa.edit', $penyewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                    '<a href="' . route('penyewa.show', $penyewa->id) . '" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >View</a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'photo', 'status_validasi'])->make(true);
    }
}
