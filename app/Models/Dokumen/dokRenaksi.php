<?php

namespace App\Models\Dokumen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokRenaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'urutan',
        'link',
        'tahun'
    ];
}
