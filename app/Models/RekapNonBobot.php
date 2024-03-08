<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapNonBobot extends Model
{
    use HasFactory;

    protected $table = 'rekap_non_bobot_kepemimpinan';

    protected $guard = 'id';

    protected $fillable = [
        'npp_karyawan_id',
        'pool_respon_id',
        'jabatan_dinilai',
        'k_1_self',
        'k_1_atasan',
        'k_1_rekan',
        'k_1_staff',
        
        'k_2_self',
        'k_2_atasan',
        'k_2_rekan',
        'k_2_staff',

        'k_3_self',
        'k_3_atasan',
        'k_3_rekan',
        'k_3_staff',

        'k_4_self',
        'k_4_atasan',
        'k_4_rekan',
        'k_4_staff',

        'k_5_self',
        'k_5_atasan',
        'k_5_rekan',
        'k_5_staff',

        'k_6_self',
        'k_6_atasan',
        'k_6_rekan',
        'k_6_staff',
    ];

    public function relasi_karyawan(){
        return $this->belongsTo(RelasiKaryawan::class, 'npp_karyawan_id');
    }

    public function relasi_respon(){
        return $this->belongsTo(PoolRespon::class, 'pool_respon_id');
    }

}
