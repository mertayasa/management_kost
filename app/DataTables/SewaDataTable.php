<?php

namespace App\DataTables;
use Yajra\DataTables\DataTables;

class SewaDataTable
{
    static public function set($sewa){
        return Datatables::of($sewa)
            ->addColumn('nama_kost', function($sewa){
                return $sewa->kamar->kost->nama;
            })
            ->addColumn('no_kamar', function($sewa){
                return $sewa->kamar->no_kamar;
            })
            ->addColumn('penyewa', function($sewa){
                return $sewa->penyewa->nama;
            })
            ->editColumn('tgl_masuk', function ($sewa) {
                return indonesianDate($sewa->tgl_masuk);
            })
            ->editColumn('tgl_keluar', function ($sewa) {
                return $sewa->tgl_keluar != null ? indonesianDate($sewa->tgl_keluar) : '-';
            })

            ->addColumn('action', function ($sewa) {
                if(userRole() == 'pegawai'){
                    return
                        '<div class="btn-group">' .
                        '<a href="' . route('sewa.edit', $sewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                        // '<a href="' . route('sewa.keluar', $sewa->id) . '" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Atur tanggal keluar" style="margin-right: 5px" ><i class="fas fa-sign-out-alt"></i></a>' .
                        '</div>';
                }

                $deleteUrl = "'" . route('sewa.destroy', $sewa->id) . "', 'sewaDatatable', 'sewa'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('sewa.edit', $sewa->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    // '<a href="' . route('sewa.keluar', $sewa->id) . '" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Atur tanggal keluar" style="margin-right: 5px" ><i class="fas fa-sign-out-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action', 'thumbnail'])->make(true);
    }
}
