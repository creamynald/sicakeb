<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opd\Pegawai;

class opd extends Model
{
    use HasFactory;
    // define name of table in database
    protected $table = 'opds';
    
    // begin::define column that fillable
    protected $fillable = [
        'nama',
        'singkatan'
    ];
    // end::define column that fillable

    // begin::relation to pegawai model
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
    // end::relation to pegawai model
}
