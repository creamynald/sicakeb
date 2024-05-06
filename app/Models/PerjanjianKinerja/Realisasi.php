<?php

namespace App\Models\PerjanjianKinerja;

use App\Models\Opd\Kegiatan;
use App\Models\Opd\Program;
use App\Models\Opd\Subkegiatan;
use App\Models\PerjanjianKinerja\Target;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Realisasi extends Model
{
    use HasFactory;
    protected $table = 'realisasis';
    protected $fillable = [
        'target_id',
        'tw1',
        'tw2',
        'tw3',
        'tw4',
        'realisasi_anggaran',
        'penghambat',
        'pendukung',
        'solusi',
    ] ;

    public function program(){
        return $this->belongsTo(Program::class,'master_id','id');
    }

    public function target(){
        return $this->belongsTo(Target::class,'target_id','id');
    }

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class,'master_id','id');
    }

    public function subkegiatan(){
        return $this->belongsTo(Subkegiatan::class,'master_id','id');
    }

    public function getRealisasi($target_id){
        return $this->where('target_id', $target_id)->first();
    }

    public function converTw($tw){
        if($tw == '-' || $tw == ''){
            $convert = 0;
        }else{
            $convert = $tw;
        }
         return $convert;
    }
}
