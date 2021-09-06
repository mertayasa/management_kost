<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    use HasFactory;

    protected $table="jenis_pembayaran";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_pembayaran',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function pembayaran()
    {
        return $this->hasMany(\App\Models\Pembayaran::class, 'id_jenis_pembayaran');
    }

    public function getJumlahPembayaranAttribute(){
        return $this->pembayaran->count();
    }
}
