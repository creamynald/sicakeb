<?php

namespace App\Models\Opd;

use App\Models\opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sasaran extends Model
{
    use HasFactory;
    // define table name in database
    protected $table = 'sasarans';

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
}
