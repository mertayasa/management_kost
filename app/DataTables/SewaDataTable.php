<?php

namespace App\DataTables;
use Yajra\DataTables\DataTables;

class SewaDataTable
{
    static public function set($sewa){
        return Datatables::of($sewa)
            // ->addColumn('thumbnail', function($sewa){
            //     return '<img src="'. asset('images/uploaded/'.$sewa->thumbnail) .'" width="100px">';
            // })

            // ->editColumn('date_time', function ($sewa) {
            //     return indonesianDate($sewa->date_time);
            // })

            ->addColumn('action', function ($sewa) {
                $deleteUrl = "'" . route('sewa.destroy', $sewa->id) . "', 'sewaDatatable', 'artikel'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('sewa.edit', $sewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'thumbnail'])->make(true);
    }
}
