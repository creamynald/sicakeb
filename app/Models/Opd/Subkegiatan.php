<?php

namespace App\Models\Opd;

use App\Models\PerjanjianKinerja\Target;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opd\Kegiatan;

class Subkegiatan extends Model
{
    use HasFactory;

    // define table name in database
    protected $table = 'subkegiatans';

    // begin::define fillable column
    protected $fillable = [
        'kegiatan_id',
        'nama'
    ];
    // end::define fillable column

    // begin::relation to Kegiatan model
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
    // end::relation to Kegiatan model

    // begin::relation to Target model
    public function target()
    {
        return $this->hasMany(Target::class);
    }
    // end::relation to Target model

    public function scopeTujuan(){
        return $this->withWhereHas('kegiatan.program.sasaran.tujuan', function($q){
            $q->where('opd_id', auth()->user()->opd_id);
        });
    }
}
