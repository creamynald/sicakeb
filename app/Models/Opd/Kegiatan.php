<?php

namespace App\Models\Opd;

use App\Models\PerjanjianKinerja\Target;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opd\Program;
use App\Models\Opd\Subkegiatan;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Kegiatan extends Model
{
    use HasFactory, LogsActivity;

    // define table name in database
    protected $table = 'kegiatans';

    // begin::define fillable column
    protected $fillable = [
        'program_id',
        'nama'
    ];
    // end::define fillable column

    // log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['program_id', 'nama'])
                ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
                ->useLogName('kegiatan');
    } // end log

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

    // begin::relation to Target model
    public function target()
    {
        return $this->hasMany(Target::class);
    }
    // end::relation to Target model

    public function scopeTujuan(){
        return $this->withWhereHas('program.sasaran.tujuan', function($q){
            $q->where('opd_id', auth()->user()->opd_id);
        });
    }
}
