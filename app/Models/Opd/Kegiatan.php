<?php

namespace App\Models\Opd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opd\Program;
use App\Models\Opd\Subkegiatan;

class Kegiatan extends Model
{
    use HasFactory;

    // define table name in database
    protected $table = 'kegiatans';

    // begin::define fillable column
    protected $fillable = [
        'program_id',
        'nama'
    ];
    // end::define fillable column

    // begin::relation to Program model
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    // end::relation to Program model

    // begin::relation to Sub Kegiatan model
    public function subkegiatan()
    {
        return $this->hasMany(Subkegiatan::class);
    }
    // end::relation to Sub Kegiatan model
}
