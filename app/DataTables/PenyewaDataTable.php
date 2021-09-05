<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PenyewaDataTable
{
    static public function set($penyewa)
    {
        // 
        return Datatables::of($penyewa)

            // ->editColumn('conditions', function ($penyewa) {
            //     return getConditions($penyewa->conditions);
            // })

            // ->editColumn('photo', function ($penyewa) {
            //     return '<img src="' . asset('images/uploaded/' . $penyewa->photo) . '" alt="" width="100px">';
            // })

            ->addColumn('action', function ($penyewa) {
                $deleteUrl = "'" . route('penyewa.destroy', $penyewa->id) . "', 'penyewaDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('penyewa.edit', $penyewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'photo'])->make(true);
    }
}
