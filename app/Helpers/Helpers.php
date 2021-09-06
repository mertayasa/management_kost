<?php

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function formatPrice($value){
    return 'Rp '. number_format($value,0,',','.');
}

function userRole(){
    // 3 User
    // $role_name = Auth::user()->level == 0 ? 'role1' : (Auth::user()->level == 1 ? 'role2' : 'role3');

    // 2 user
    $role_name = Auth::user()->level == 0 ? 'role1' : 'role2';

    return $role_name;
}

function authUser(){
    return Auth::user();
}

function indonesianDate($date){
    return Carbon::parse($date)->isoFormat('LL');
}

function getAge($date){
    $birth_date = Carbon::parse($date);
    $now = Carbon::now();

    return $birth_date->diffInYears($now);
}

function getGender($gender){
    return $gender == 0 ? 'Laki-Laki' : 'Perempuan';
}

function getStatus($status){
    return $status == 1 ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>';
}

function uploadFile($base_64_foto){
    try{
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/';
        $safeName = time().$base_64_foto['name'];
        $destinationPath = public_path().'/' . $folderName;
        file_put_contents($destinationPath.$safeName, $foto);
    }catch(Exception $e){
        Log::info($e->getMessage());
        return 0;
    }

    return $safeName;
}

function isActive($param){
    return Request::route()->getPrefix() == '/'.$param ? 'active' : '';
}