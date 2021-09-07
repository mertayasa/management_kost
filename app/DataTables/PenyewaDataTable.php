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
        return Datatables::of($penyewa)
            ->editColumn('status_validasi', function ($penyewa) {
                $badge_color = $penyewa->status_validasi == 1 ? 'success' : 'danger';
                $badge_text = $penyewa->status_validasi == 1 ? 'Terverifikasi' : 'Belum Terverifikasi';
                return '<span class="badge badge-'.$badge_color.'">'. $badge_text .'</span>';
            })

            ->addColumn('action', function ($penyewa) {
                $deleteUrl = "'" . route('penyewa.destroy', $penyewa->id) . "', 'penyewaDatatable', '".$penyewa->nama."'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('penyewa.edit', $penyewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'photo', 'status_validasi'])->make(true);
    }
}
