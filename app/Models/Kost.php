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
        return $this->hasMany(\App\Models\Kamar::class, 'id_kost');
    }

    public function getJumlahKamarAttribute(){
        return $this->kamar->count();
    }
}
