<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_jenis_pengeluaran',
        'jumlah',
        'tgl_pengeluaran',
        'keterangan',
        'id_kost',
        // 'status_validasi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_jenis_pengeluaran' => 'integer',
        // 'tgl_pengeluaran' => 'date',
        'status_validasi' => 'integer',
    ];


    public function jenis_pengeluaran()
    {
        return $this->belongsTo(\App\Models\JenisPengeluaran::class, 'id_jenis_pengeluaran');
    }

    public function kost()
    {
        return $this->belongsTo('App\Models\Kost', 'id_kost');
    }
}
