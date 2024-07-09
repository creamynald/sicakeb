<?php

namespace App\Models\PerjanjianKinerja;

use App\Models\Opd\Kegiatan;
use App\Models\Opd\Pegawai;
use App\Models\opd;
use App\Models\Opd\Program;
use App\Models\Opd\Subkegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Target extends Model
{
    use HasFactory, LogsActivity;

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
        'anggaran',
        'target_kinerja_tahunan',
        'has_child',
        'parent_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['pegawai_id',
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
                'anggaran',
                'target_kinerja_tahunan',
                'has_child',
                'parent_id'])
                ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
                ->useLogName('target');
    }

    // begin::relation to opd model
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    // end::relation to opd model

    public function program(){
        return $this->belongsTo(Program::class, 'master_id', 'id');
    }

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class, 'master_id', 'id');
    }

    public function subkegiatan(){
        return $this->belongsTo(Subkegiatan::class, 'master_id', 'id');
    }

    public function realisasi(){
        return $this->hasMany(Realisasi::class);
    }
}
