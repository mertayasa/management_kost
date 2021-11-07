<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class KostDataTable{
    static public function set($kost){
        return Datatables::of($kost)
            ->addColumn('jumlah_kamar', function($kost){
                return $kost->jumlah_kamar;
            })
            ->addColumn('jumlah_kosong', function($kost){
                return getKamarKosong($kost);
                // return $kost->jumlah_kosong;
            })
            ->addColumn('action', function ($kost) {
                if(userRole() == 'pegawai' || userRole() == 'manager'){
                    return '<div class="btn-group">' .
                        '<a href="' . route('kost.show', $kost->id) . '" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >View</a>' .
                    '</div>';
                }

                $deleteUrl = "'" . route('kost.destroy', $kost->id) . "', 'kostDatatable', '".$kost->nama."'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('kost.show', $kost->id) . '" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >View</a>' .
                    '<a href="' . route('kost.edit', $kost->id) . '" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
