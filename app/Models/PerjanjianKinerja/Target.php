<?php

namespace App\Models\PerjanjianKinerja;

use App\Models\Opd\Kegiatan;
use App\Models\Opd\Pegawai;
use App\Models\opd;
use App\Models\Opd\Program;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $table = 'targets';

    protected $fillable = [
        'pegawai_id',
        'jenis_master',
        'master_id',
        'indikator',
        'sasaran',
        'tahun',
        'tw1',
        'tw2',
        'tw3',
        'tw4',
        'satuan',
        'anggaran'
    ];

    // begin::relation to opd model
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    // end::relation to opd model

    public function program(){
        return $this->hasMany(Program::class);
    }

    public function kegiatan(){
        return $this->hasMany(Kegiatan::class);
    }

    public function subkegiatan(){
        return $this->hasMany(Kegiatan::class);
    }

    public function realisasi(){
        return $this->hasMany(Realisasi::class);
    }
}
