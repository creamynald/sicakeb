<?php

namespace App\Models\Lhe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\opd;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Lhe extends Model
{
    use HasFactory, LogsActivity;

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

    // log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['rekomendasi_lhe',
                'tahun',
                'opd_id',
                'tindak_lanjut',
                'target_penyelesaian',
                'progres',
                'bukti_dukung'])
                ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
                ->useLogName('lhe');
    } //end log

    // begin::relation to opd model
    public function opd()
    {
        return $this->belongsTo(opd::class);
    }
    // end::relation to opd model
}
