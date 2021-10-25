<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_jenis_pemasukan',
        'id_penyewa',
        'id_kamar',
        'jumlah',
        'tgl_pemasukan',
        'alasan_ditolak',
        'status_validasi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_jenis_pemasukan' => 'integer',
        'id_penyewa' => 'integer',
        'id_kamar' => 'integer',
        'tgl_pemasukan' => 'date',
        'status_validasi' => 'integer',
    ];


    public function jenis_pemasukan()
    {
        return $this->belongsTo(\App\Models\JenisPemasukan::class, 'id_jenis_pemasukan');
    }

    public function penyewa()
    {
        return $this->belongsTo(\App\Models\Penyewa::class, 'id_penyewa');
    }

    public function kamar()
    {
        return $this->belongsTo(\App\Models\Kamar::class, 'id_kamar');
    }

    public function getNamaKostAttribute()
    {
        return $this->kamar->kost->nama. ', Kamar '.$this->kamar->no_kamar;
    }
}
