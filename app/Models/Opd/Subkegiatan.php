<?php

namespace App\Models\Opd;

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

    // begin::relation to Perjanjian Kinerja model
    // public function subkegiatan()
    // {
    //     return $this->hasMany(Subkegiatan::class);
    // }
    // end::relation to Perjanjian Kinerja model
}