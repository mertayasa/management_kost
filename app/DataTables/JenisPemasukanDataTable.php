<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class JenisPemasukanDataTable
{
    static public function set($jenis_pemasukan){

        return Datatables::of($jenis_pemasukan)
            ->addColumn('action', function ($jenis_pemasukan) {

                if(showFor(['owner', 'pegawai'])){
                    return '-';
                }

                if(showFor(['manager'])){
                    $deleteUrl = "'" . route('jenis_pemasukan.destroy', $jenis_pemasukan->id) . "', 'jenisPemasukanDatatable'";
                    return
                        '<div class="btn-group">' .
                        '<a href="' . route('jenis_pemasukan.edit', $jenis_pemasukan->id) . '" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                        '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                        '</div>';
                }

            })->addIndexColumn()->rawColumns(['action'])->make(true);

    }
}
