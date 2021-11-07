<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PemasukanDataTable
{
    static public function set($pemasukan, $status){

        return Datatables::of($pemasukan)
            ->editColumn('id_jenis_pemasukan', function($pemasukan){
                return $pemasukan->jenis_pemasukan->jenis_pemasukan;
            })
            ->editColumn('id_penyewa', function($pemasukan){
                return $pemasukan->penyewa->nama;
            })
            ->editColumn('id_kamar', function($pemasukan){
                return $pemasukan->kamar->kost->nama .' | '.$pemasukan->kamar->no_kamar;
            })
            ->editColumn('jumlah', function($pemasukan){
                return formatPrice($pemasukan->jumlah);
            })
            ->editColumn('tgl_pemasukan', function($pemasukan){
                return indonesianDate($pemasukan->tgl_pemasukan);
            })
            ->editColumn('status_validasi', function ($pemasukan) {
                return getVerificationBadge($pemasukan);
            })
            ->addColumn('action', function ($pemasukan) use($status) {
                if(showFor(['owner'])){
                    return '-';
                }

                if(showFor(['pegawai'])){
                    if($pemasukan->status_validasi == 1){
                        return '-';
                    }

                    $deleteUrl = "'" . route('pemasukan.destroy', $pemasukan->id) . "', 'pemasukanDatatable'";
                    return
                        '<div class="btn-group">' .
                        '<a href="' . route('pemasukan.edit', $pemasukan->id) . '" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                        '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                        '</div>';
                };

                $approve_pemasukan_url = "`" . route('validasi.pemasukan', [$pemasukan->id, 1]) . "`, `Apakah anda yakin menerima data pemasukan sejumlah ( ". formatPrice($pemasukan->jumlah) ." )`, `pemasukanDatatable`";
                $decline_pemasukan_url = "`" . route('validasi.pemasukan', [$pemasukan->id, 2]) . "`, `Tulis alasahn bahwa data pemasukan sebesar ( ". formatPrice($pemasukan->jumlah) ." ) ditolak`, `pemasukanDatatable`";
                // $decline_pemasukan_url = "`" . route('validasi.pemasukan', [$pemasukan->id, 2]) . "`, `Apakah anda yakin menolak data pemasukan ( ". $pemasukan->nama ." )`, `pemasukanDatatable`";
                $deleteUrl = "'" . route('pemasukan.destroy', $pemasukan->id) . "', 'pemasukanDatatable', '".$pemasukan->nama."'";
                
                if($status != null && $status == 0){
                    return 
                        '<div class="btn-group">' .
                            '<a href="#" onclick="updateStatus(' . $approve_pemasukan_url . ')" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Terima" style="margin-right: 5px">Terima</a>'.
                            '<a href="#" onclick="declineData(' . $decline_pemasukan_url . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Tolak</a>' .
                            // '<a href="' . route('pemasukan.edit', $pemasukan->id) . '" class="btn btn-secondary" data-bs-toggle="tooltip" title="Rangkuman" data-bs-placement="bottom" title="Detail" >Edit</a>' .
                        '</div>';
                }

                // if($pemasukan->status_validasi != 1){
                //     $deleteUrl = "'" . route('pemasukan.destroy', $pemasukan->id) . "', 'pemasukanDatatable'";
                //     return
                //         '<div class="btn-group">' .
                //         '<a href="' . route('pemasukan.edit', $pemasukan->id) . '" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                //         '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                //         '</div>';
                // }

            })->addIndexColumn()->rawColumns(['action', 'status_validasi'])->make(true);

    }
}
