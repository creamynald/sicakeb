<?php

namespace App\Models\Dokumen;

use App\Models\opd;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokRenaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd_id',
        'urutan',
        'link',
        'tahun'
    ];

    // relasi ke opd
    public function opd()
    {
        return $this->belongsTo(opd::class);
    }
}
