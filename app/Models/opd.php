<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opd\Pegawai;
use App\Models\Opd\Tujuan;

class opd extends Model
{
    use HasFactory;
    // define name of table in database
    protected $table = 'opds';
    
    // begin::define fillable column 
    protected $fillable = [
        'nama',
        'singkatan'
    ];
    // end::define fillable column 

    // begin::relation to pegawai model
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
    // end::relation to pegawai model

    // begin::relation to tujuan model
    public function tujuan()
    {
        return $this->hasMany(Tujuan::class);
    }
    // end::relation to tujuan model
}
