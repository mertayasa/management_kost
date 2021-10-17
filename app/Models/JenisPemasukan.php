<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPemasukan extends Model
{
    use HasFactory;

    protected $table="jenis_pemasukan";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_pemasukan',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function pemasukan()
    {
        return $this->hasMany(\App\Models\Pemasukan::class, 'id_jenis_pemasukan');
    }

    public function getJumlahPemasukanAttribute(){
        return $this->pemasukan->count();
    }
}
