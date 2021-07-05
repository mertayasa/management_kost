<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class UserDataTable{

    static public function set($package){
        return DataTables::of($package)
            // ->editColumn('type', function($package){
            //     if($package->type == 0){
            //         return 'Kiloan';
            //     }

            //     return 'Satuan';
            // })
            ->addColumn('action', function($package){
                // $deleteUrl = "'".route('package.destroy', $package->id)."', 'packageDatatable'";
                $deleteUrl = "asdasd";

                // return  '<div class="btn-group">'.
                //     '<a href="'.route('package.edit',$package->id).'" class="btn btn-warning" ><i class="menu-icon fa fa-pencil-alt"></i></a>'.
                //     '<a href="#" onclick="deleteModel('.$deleteUrl.',)" class="btn btn-danger" ><i class="menu-icon fa fa-trash"></i></a>'.
                // '</div>';

                return  '<div class="btn-group">'.
                    '<a href="" class="btn btn-warning" ><i class="menu-icon fa fa-pencil-alt"></i></a>'.
                    '<a href="#" onclick="deleteModel('.$deleteUrl.')" class="btn btn-danger" ><i class="menu-icon fa fa-trash"></i></a>'.
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }

}
