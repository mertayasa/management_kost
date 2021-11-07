<?php

namespace App\Models;

use Carbon\Carbon;
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
        // 'status_validasi',
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
        return $this->hasMany(\App\Models\Sewa::class, 'id_penyewa');
    }

    public function pemasukan()
    {
        return $this->hasMany(\App\Models\Pemasukan::class, 'id_penyewa');
    }

    public function getKamarKostAttribute()
    {
        $sewa = $this->sewa()->latest()->first();
        // $sewa = $this->sewa()->whereNull('tgl_keluar')->get()[0];
        return $sewa->kamar->kost->nama.', Kamar '.$sewa->kamar->no_kamar;
    }

    // public function getDataSewaAttribute()
    // {
    //     $tgl_keluar = $this->attributes['tgl_keluar'] ?? '∞';
    //     return $this->sewa->nama.'|'.$this->kamar->kost->nama.'|'.$this->kamar->no_kamar.'|'.$this->attributes['tgl_masuk'].' - '. $tgl_keluar;
    // }

    public function getStatusSewaAttribute()
    {
        $status_sewa = 0;

        // if($this->sewa()->whereNull('tgl_keluar')->count() > 0){
        //     $status_sewa = 1;
        // }

        $tgl_keluar = Sewa::where('status_validasi', 1)->where('id_penyewa', $this->attributes['id'])->get()->pluck('custom_tgl_keluar');

        foreach($tgl_keluar as $keluar){
            if($keluar > Carbon::now()->format('Y-m-d')){
                $status_sewa = 1;
            }
        }

        return $status_sewa;
        return end($tgl_keluar);
    }
}
