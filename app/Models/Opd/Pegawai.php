<?php

namespace App\Models\Opd;

use App\Models\opd;
use App\Models\PerjanjianKinerja\Target;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    // define name of table in database
    protected $table = 'pegawais';

    // begin::define column that fillable
    protected $fillable = [
        'opd_id',
        'nama',
        'nip',
        'jabatan',
        'golongan',
        'eselon'
    ];
    // end::define column that fillable

    // begin::relation to opd model
    public function opd()
    {
        return $this->belongsTo(opd::class);
    }
    // end::relation to opd model

    // begin::relation to opd model
    public function target()
    {
        return $this->hasMany(Target::class);
    }
    // end::relation to opd model


}
