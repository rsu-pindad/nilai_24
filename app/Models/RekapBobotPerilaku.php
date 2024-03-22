<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBobotPerilaku extends Model
{
    use HasFactory;
    protected $table = 'rekap_bobot_perilaku';

    protected $guard = 'id';

    protected $fillable = [
        'tnb_perilaku_id',
        'npp_dinilai_id',
        'pb_1_self',
        'pb_1_atasan',
        'pb_1_rekan',
        'pb_1_staff',
        
        'pb_2_self',
        'pb_2_atasan',
        'pb_2_rekan',
        'pb_2_staff',

        'pb_3_self',
        'pb_3_atasan',
        'pb_3_rekan',
        'pb_3_staff',

        'pb_4_self',
        'pb_4_atasan',
        'pb_4_rekan',
        'pb_4_staff',

        'pb_5_self',
        'pb_5_atasan',
        'pb_5_rekan',
        'pb_5_staff',

        'sum_pb_1_staff',
        'sum_pb_1_atasan',
        'sum_pb_1_rekan',
        'sum_pb_1_self',

    ];

    public function relasi_non_bobot()
    {
        return $this->belongsTo(RekapNonBobotPerilaku::class, 'tnb_perilaku_id');
    }

    public function relasi_karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_dinilai_id');
    }
}
