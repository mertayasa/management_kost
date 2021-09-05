<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class JenisPembayaranDataTable
{
    static public function set($jenis_pembayaran){

        return Datatables::of($jenis_pembayaran)
            ->addColumn('action', function ($jenis_pembayaran) {
                $deleteUrl = "'" . route('jenis_pembayaran.destroy', $jenis_pembayaran->id) . "', 'jenis_pembayaranDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('jenis_pembayaran.edit', $jenis_pembayaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);

    }
}
