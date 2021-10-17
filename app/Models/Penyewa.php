<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'no_ktp',
        'telpon',
        'alamat',
        'pekerjaan',
        'status_validasi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status_validasi' => 'integer',
    ];


    public function sewa()
    {
        return $this->hasOne(\App\Models\Sewa::class, 'id_penyewa');
    }

    public function pemasukan()
    {
        return $this->hasMany(\App\Models\Pemasukan::class, 'id_penyewa');
    }

    public function getKamarKostAttribute()
    {
        $sewa = $this->sewa()->whereNull('tgl_keluar')->get()[0];
        return $sewa->kamar->kost->nama.', Kamar '.$sewa->kamar->no_kamar;
    }

    public function getStatusSewaAttribute()
    {
        $status_sewa = 0;

        if($this->sewa()->whereNull('tgl_keluar')->count() > 0){
            $status_sewa = 1;
        }

        return $status_sewa;
    }
}
