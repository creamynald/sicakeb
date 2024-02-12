<?php

namespace App\Models\Opd;

use App\Models\opd;
use App\Models\Opd\Sasaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    use HasFactory;

    // define table name in database
    protected $table = 'tujuans';

    // begin::define fillable column
    protected $fillable = [
        'opd_id',
        'nama'
    ];
    // end::define fillable column

    // begin::relation to opd model
    public function opd()
    {
        return $this->belongsTo(opd::class);
    }
    // end::relation to opd model

    // begin::relation to sasaran model
    public function sasaran()
    {
        return $this->hasMany(Sasaran::class);
    }
    // end::relation to sasaran model
}
