<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PengeluaranDataTable
{
    static public function set($pengeluaran){

        return Datatables::of($pengeluaran)
            ->addColumn('action', function ($pengeluaran) {
                $deleteUrl = "'" . route('pengeluaran.destroy', $pengeluaran->id) . "', 'pengeluaranDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('pengeluaran.edit', $pengeluaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);

    }
}
