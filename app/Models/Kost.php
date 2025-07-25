<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;
    
    protected $table = 'kost';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'alamat',
        // 'jumlah_kamar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_kost');
    }

    public function sewa()
    {
        return $this->hasManyThrough(Sewa::class, Kamar::class, 'id_kost', 'id_kamar');
    }

    public function getJumlahKosongAttribute()
    {
        return $this->sewa->whereNotNull('tgl_keluar')->count();
    }

    public function getJumlahKosong()
    {
        // $kamar = Kamar::where('id_kost', $this->attributes['id'])->get();
        // $raw_tgl_isi = [];
        // foreach($kamar as $kam)
    }

    public function pemasukan()
    {
        return $this->hasManyThrough(Pemasukan::class, Kamar::class, 'id_kost', 'id_kamar');
    }

    public function getJumlahKamarAttribute(){
        return $this->kamar->count();
    }

    public function pengeluaran()
    {
        return $this->hasMany('App\Models\Pengeluaran', 'id_kost');
    }
}
