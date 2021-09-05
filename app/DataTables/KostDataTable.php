<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class KostDataTable
{
    static public function set($kost)
    {
        // 
        return Datatables::of($kost)
            ->addColumn('action', function ($kost) {
                $deleteUrl = "'" . route('kost.destroy', $kost->id) . "', 'kostDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('kost.edit', $kost->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
