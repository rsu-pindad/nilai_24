<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBobotKepemimpinan extends Model
{
    use HasFactory;
    protected $table = 'rekap_bobot_kepemimpinan';

    protected $guard = 'id';

    protected $fillable = [
        'tnb_kepemimpinan_id',
        'npp_dinilai_id',
        'kb_1_self',
        'kb_1_atasan',
        'kb_1_rekan',
        'kb_1_staff',
        
        'kb_2_self',
        'kb_2_atasan',
        'kb_2_rekan',
        'kb_2_staff',

        'kb_3_self',
        'kb_3_atasan',
        'kb_3_rekan',
        'kb_3_staff',

        'kb_4_self',
        'kb_4_atasan',
        'kb_4_rekan',
        'kb_4_staff',

        'kb_5_self',
        'kb_5_atasan',
        'kb_5_rekan',
        'kb_5_staff',

        'kb_6_self',
        'kb_6_atasan',
        'kb_6_rekan',
        'kb_6_staff',

        'sum_kb_1_staff',
        'sum_kb_1_atasan',
        'sum_kb_1_rekan',
        'sum_kb_1_self',
    ];

    public function relasi_non_bobot()
    {
        return $this->belongsTo(RekapNonBobot::class, 'tnb_kepemimpinan_id');
    }

    public function relasi_karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_dinilai_id');
    }

}
