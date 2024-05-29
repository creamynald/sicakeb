<?php

namespace App\Models\Opd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opd\Sasaran;
use App\Models\Opd\Kegiatan;
use App\Models\PerjanjianKinerja\Target;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Program extends Model
{
    use HasFactory, LogsActivity;

    // define table name in database
    protected $table = 'programs';

    // begin::define fillable column
    protected $fillable = [
        'sasaran_id',
        'nama'
    ];
    // end::define fillable column

    // log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['sasaran_id', 'nama'])
                ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
                ->useLogName('program');
    } //end log

    // begin::relation to Sasaran model
    public function sasaran()
    {
        return $this->belongsTo(Sasaran::class);
    }
    // end::relation to Sasaran model

    // begin::relation to Kegiatan model
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
    // end::relation to Kegiatan model

    // begin::relation to Kegiatan model
    public function target()
    {
        return $this->hasMany(Target::class);
    }
    // end::relation to Kegiatan model
}
