<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kost',
        'no_kamar',
        'harga',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_kost' => 'integer',
    ];


    public function kost()
    {
        return $this->belongsTo(\App\Models\Kost::class, 'id_kost');
    }

    public function sewa()
    {
        return $this->hasMany(\App\Models\Sewa::class, 'id_kamar');
    }

    public function pemasukan()
    {
        return $this->hasMany(\App\Models\Pemasukan::class);
    }

    public function getJumlahSewaAttribute()
    {
        // return $this->sewa != null ? $this->sewa()->count() : 0;

        $status_sewa = 0;
        if($this->sewa()->whereNull('tgl_keluar')->count() > 0){
            $status_sewa = 1;
        }

        return $status_sewa;
    }

    public function getTglIsi()
    {
        $raw_sewa = Sewa::where('id_kamar', $this->attributes['id'])->orderBy('tgl_masuk', 'ASC')->get();
        $date_range = [];
        foreach($raw_sewa as $sewa){
            array_push($date_range, $sewa->getDateRange());   
        }

        return flatten($date_range);
    }
}
