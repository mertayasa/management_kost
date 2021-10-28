<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $table = 'sewa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kamar',
        'id_penyewa',
        'tgl_masuk',
        'status_validasi',
        'alasan_ditolak',
        'tgl_keluar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_kamar' => 'integer',
        'id_penyewa' => 'integer',
        // 'tgl_masuk' => 'date',
        // 'tgl_keluar' => 'date',
    ];

    protected $appends = [
        'custom_tgl_keluar',
        'nama_sewa'
    ];

    public function getCustomTglKeluarAttribute(){
        if($this->attributes['tgl_keluar'] == null){
            return Carbon::now()->addYears(3)->format('Y-m-d');
        }

        return $this->attributes['tgl_keluar'];
    }

    public function getNamaSewaAttribute()
    {
        $tgl_keluar = $this->attributes['tgl_keluar'] ?? '∞';
        return $this->kamar->kost->nama.' | '.$this->kamar->no_kamar.' | '.$this->attributes['tgl_masuk'].' - '. $tgl_keluar;
    }

    // public function getDateRangeAttribute()
    public function getDateRange()
    {
        // if(!$this->attributes['tgl_akhir_sewa'] <= Carbon::now()->format('Y-m-d')){
        //     return [];
        // }

        $period = CarbonPeriod::create($this->attributes['tgl_masuk'], $this->attributes['tgl_keluar'] ?? $this->getCustomTglKeluarAttribute())->toArray();
        $new_period = [];
        
        foreach($period as $per){
            array_push($new_period, $per->format('Y-m-d'));
        }

        return $new_period;
    }


    public function kamar(){
        return $this->belongsTo(\App\Models\Kamar::class, 'id_kamar');
    }

    public function penyewa(){
        return $this->belongsTo(\App\Models\Penyewa::class, 'id_penyewa');
    }

}
