<?php

namespace App\Models\Dokumen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\opd;

class file extends Model
{
    use HasFactory;

    // define table name in database
    protected $table = 'files';

    // begin::define fillable column
    protected $fillable = [
        'opd_id',
        'tahun',
        'jenis_file',
        'nama',
        'lokasi_file'
    ];

    // begin::relation to opd model
    public function opd()
    {
        return $this->belongsTo(opd::class);
    }
    // end::relation to opd model
}