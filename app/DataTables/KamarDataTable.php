<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class KamarDataTable
{
    static public function set($kamar){

        return Datatables::of($kamar)
            ->addColumn('nama_kost', function($kamar){
                return $kamar->kost->nama;
            })
            ->addColumn('status', function($kamar){
                return $kamar->jumlah_sewa == 0 ? 'Kosong' : 'Isi';
            })
            ->addColumn('action', function ($kamar) {
                if(userRole() == 'pegawai'){
                    return '-';
                }

                $deleteUrl = "'" . route('kamar.destroy', $kamar->id) . "', 'kamarDatatable', '".$kamar->no_kamar."'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('kamar.edit', $kamar->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);

    }
}
