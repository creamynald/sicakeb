<?php

namespace App\Models\Opd;

use App\Models\Opd\Tujuan;
use App\Models\Opd\Program;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Sasaran extends Model
{
    use HasFactory, LogsActivity;
    // define table name in database
    protected $table = 'sasarans';

    // begin::define fillable column
    protected $fillable = [
        'tujuan_id',
        'nama'
    ];
    // end::define fillable column

    // log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['tujuan_id', 'nama'])
                ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
                ->useLogName('sasaran');
    } //end log

    // begin::relation to tujuan model
    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }
    // end::relation to tujuan model

    // begin::relation to Program model
    public function program()
    {
        return $this->hasMany(Program::class);
    }
    // end::relation to Program model
}
