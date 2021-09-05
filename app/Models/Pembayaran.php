<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_jenis_pembayaran',
        'id_penyewa',
        'id_kamar',
        'jumlah',
        'tgl_pembayaran',
        'status_validasi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_jenis_pembayaran' => 'integer',
        'id_penyewa' => 'integer',
        'id_kamar' => 'integer',
        'tgl_pembayaran' => 'date',
        'status_validasi' => 'integer',
    ];


    public function jenisPembayaran()
    {
        return $this->belongsTo(\App\Models\JenisPembayaran::class);
    }

    public function penyewa()
    {
        return $this->belongsTo(\App\Models\Penyewa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(\App\Models\Kamar::class);
    }
}
