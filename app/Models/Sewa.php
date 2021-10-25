<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $table = 'sewa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kamar',
        'id_penyewa',
        'tgl_masuk',
        'status_validasi',
        'alasan_ditolak',
        'tgl_keluar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_kamar' => 'integer',
        'id_penyewa' => 'integer',
        // 'tgl_masuk' => 'date',
        // 'tgl_keluar' => 'date',
    ];


    public function kamar(){
        return $this->belongsTo(\App\Models\Kamar::class, 'id_kamar');
    }

    public function penyewa(){
        return $this->belongsTo(\App\Models\Penyewa::class, 'id_penyewa');
    }

}
