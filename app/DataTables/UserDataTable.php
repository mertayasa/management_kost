<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class UserDataTable
{

    static public function set($user)
    {
        return DataTables::of($user)
            ->editColumn('level', function ($user) {
                if(userRole($user->level) == 'owner'){
                    return 'Eksekutif';
                }
                
                return ucfirst(userRole($user->level));
            })
            ->addColumn('action', function ($user) {
                $deleteUrl = "'" . route('user.destroy', $user->id) . "', 'userDatatable', 'user " . $user->nama . " '";
                $delete_button = userRole($user->level) != 'owner' ? '<a href="#" onclick="deleteModel(' . $deleteUrl . ')" class="btn btn-danger" >Hapus</a>' : '';

                return  '<div class="btn-group">' .
                    '<a href="' . route('user.edit', $user) . '" class="btn btn-warning" >Edit</a>' . $delete_button .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
