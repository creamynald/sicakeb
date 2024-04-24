<?php

namespace App\Models\Lhe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\opd;

class Lhe extends Model
{
    use HasFactory;

    // define table name in database
    protected $table = 'lhes';

    // begin::define fillable column
    protected $fillable = [
        'rekomendasi_lhe',
        'tahun',
        'opd_id',
        'tindak_lanjut',
        'target_penyelesaian',
        'progres',
        'bukti_dukung'
    ];

    // begin::relation to opd model
    public function opd()
    {
        return $this->belongsTo(opd::class);
    }
    // end::relation to opd model
}
