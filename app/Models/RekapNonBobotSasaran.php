<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapNonBobotSasaran extends Model
{
    use HasFactory;
    protected $table = 'rekap_non_bobot_sasaran';

    protected $guard = 'id';

    protected $fillable = [
        'npp_karyawan_id',
        'pool_respon_id',
        'jabatan_dinilai',
        's_1_self',
        's_1_atasan',
        's_1_rekan',
        's_1_staff',
        
        's_2_self',
        's_2_atasan',
        's_2_rekan',
        's_2_staff',

        's_3_self',
        's_3_atasan',
        's_3_rekan',
        's_3_staff',

        's_4_self',
        's_4_atasan',
        's_4_rekan',
        's_4_staff',

        's_5_self',
        's_5_atasan',
        's_5_rekan',
        's_5_staff',
    ];

    public function relasi_karyawan(){
        return $this->belongsTo(RelasiKaryawan::class, 'npp_karyawan_id');
    }

    public function relasi_respon(){
        return $this->belongsTo(PoolRespon::class, 'pool_respon_id');
    }
}
