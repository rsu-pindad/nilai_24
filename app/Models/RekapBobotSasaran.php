<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBobotSasaran extends Model
{
    use HasFactory;

    protected $table = 'rekap_bobot_sasaran';

    protected $guard = 'id';

    protected $fillable = [
        'tnb_sasaran_id',
        'npp_dinilai_id',
        'sb_1_self',
        'sb_1_atasan',
        'sb_1_rekan',
        'sb_1_staff',
        
        'sb_2_self',
        'sb_2_atasan',
        'sb_2_rekan',
        'sb_2_staff',

        'sb_3_self',
        'sb_3_atasan',
        'sb_3_rekan',
        'sb_3_staff',

        'sb_4_self',
        'sb_4_atasan',
        'sb_4_rekan',
        'sb_4_staff',

        'sb_5_self',
        'sb_5_atasan',
        'sb_5_rekan',
        'sb_5_staff',

        'sum_sb_1_staff',
        'sum_sb_1_atasan',
        'sum_sb_1_rekan',
        'sum_sb_1_self',

    ];

    public function relasi_non_bobot()
    {
        return $this->belongsTo(RekapNonBobotSasaran::class, 'tnb_sasaran_id');
    }

    public function relasi_karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_dinilai_id');
    }
}
