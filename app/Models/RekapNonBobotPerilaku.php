<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapNonBobotPerilaku extends Model
{
    use HasFactory;
    protected $table = 'rekap_non_bobot_perilaku';

    protected $guard = 'id';

    protected $fillable = [
        'npp_karyawan_id',
        'pool_respon_id',
        'jabatan_dinilai',
        'p_1_self',
        'p_1_atasan',
        'p_1_rekan',
        'p_1_staff',
        
        'p_2_self',
        'p_2_atasan',
        'p_2_rekan',
        'p_2_staff',

        'p_3_self',
        'p_3_atasan',
        'p_3_rekan',
        'p_3_staff',

        'p_4_self',
        'p_4_atasan',
        'p_4_rekan',
        'p_4_staff',

        'p_5_self',
        'p_5_atasan',
        'p_5_rekan',
        'p_5_staff',
    ];

    public function relasi_karyawan(){
        return $this->belongsTo(RelasiKaryawan::class, 'npp_karyawan_id');
    }
    public function relasi_respon(){
        return $this->belongsTo(PoolRespon::class, 'pool_respon_id');
    }
}
