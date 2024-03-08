<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreJawaban extends Model
{
    use HasFactory;
    protected $table = 'score_jawaban';

    protected $guard = 'id';

    protected $fillable = [
        'aspek_id',
        'indikator_id',
        'jawaban',
        'skor'
    ];

    public function aspek(){
        return $this->belongsTo(Aspek::class, 'aspek_id');
    }

    public function indikator(){
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    // public function arahans()
    // {
    //     return $this->hasMany(MasterArahan::class, 'user_profile_id','id');
    // }
}
