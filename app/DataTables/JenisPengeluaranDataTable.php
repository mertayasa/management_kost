<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class JenisPengeluaranDataTable
{
    static public function set($jenis_pengeluaran)
    {

        return Datatables::of($jenis_pengeluaran)
            ->addColumn('action', function ($jenis_pengeluaran) {
                if (showFor(['owner', 'pegawai'])) {
                    return '-';
                }

                $deleteUrl = "'" . route('jenis_pengeluaran.destroy', $jenis_pengeluaran->id) . "', 'jenisPengeluaranDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('jenis_pengeluaran.edit', $jenis_pengeluaran->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit</a>' .
                    // '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
