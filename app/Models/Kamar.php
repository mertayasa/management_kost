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
        return $this->hasMany(\App\Models\Sewa::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(\App\Models\Pembayaran::class);
    }
}
