<?php

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function formatPrice($value){
    return 'Rp '. number_format($value,0,',','.');
}

function userRole($level = null){
    // 3 User
    $role_name = ($level ?? Auth::user()->level) == 0 ? 'owner' : (($level ?? Auth::user()->level) == 1 ? 'manager' : 'pegawai');

    // 2 user
    // $role_name = Auth::user()->level == 0 ? 'role1' : 'role2';

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

function getVerificationBadge($model){
    $badge_text = $model->status_validasi == 1 ? 'Tervalidasi' : ($model->status_validasi == 0 ? 'Belum Tervalidasi' : 'Ditolak');
    $badge_color = $model->status_validasi == 1 ? 'success' : ($model->status_validasi == 0 ? 'warning' : 'danger');
    $badge = '<b> <span class="text-'. $badge_color .'">'. $badge_text .'</span> </b>';

    if($model->status_validasi === 2){
        $alasan = $model->alasan_ditolak ?? 'Tanpa Alasan';
        $badge = $badge.'<br><a href="#" onclick="showAlasan(this)" data-toggle="modal" data-alasan="'. $alasan .'" data-target="#modalAlasan">Lihat alasan</a>';
    }

    return $badge;
}

function showFor($roles)
{
    foreach($roles as $role){
        if(userRole() == $role){
            return true;
        }
    }

    return false;
}

function flatten($data, $result = [])
{
    foreach ($data as $flat) {
        if (is_array($flat)) {
            $result = flatten($flat, $result);
        } else {
            $result[] = $flat;
        }
    }

    return $result;
}

function getKamarKosong($kost)
{
    $kosong = $kost->kamar->count();
    foreach($kost->kamar as $kamar){
        $tgl_isi = $kamar->getTglIsi();
        if(isset($tgl_isi[0])){
            $check = Carbon::now()->between($tgl_isi[0], end($tgl_isi));
            // $check = Carbon::now()->between($tgl_isi[0], $tgl_isi[count($tgl_isi)-1]);
            if($check){
                $kosong = $kosong - 1;
            }
        }
    }

    return $kosong;
}