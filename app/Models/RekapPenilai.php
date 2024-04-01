<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPenilai extends Model
{
    use HasFactory;

    protected $table = 'rekap_penilai';

    protected $guard = 'id';

    protected $fillable = [
        'pool_respon_id',
        'npp_penilai',
        'npp_dinilai',
        'jabatan_penilai',
        'jabatan_dinilai',
        'strategi_perencanaan_bobot_aspek',
        // 'strategi_perencanaan_bobot_penilai',
        'strategi_pengawasan_bobot_aspek',
        // 'strategi_pengawasan_bobot_penilai',
        'strategi_inovasi_bobot_aspek',
        // 'strategi_inovasi_bobot_penilai',
        'kepemimpinan_bobot_aspek',
        // 'kepemimpinan_bobot_penilai',
        'membimbing_membangun_bobot_aspek',
        // 'membimbing_membangun_bobot_penilai',
        'pengambilan_keputusan_bobot_aspek',
        // 'pengambilan_keputusan_bobot_penilai',
        'kerjasama_bobot_aspek',
        // 'kerjasama_bobot_penilai',
        'komunikasi_bobot_aspek',
        // 'komunikasi_bobot_penilai',
        'absensi_bobot_aspek',
        // 'absensi_bobot_penilai',
        'integritas_bobot_aspek',
        // 'integritas_bobot_penilai',
        'etika_bobot_aspek',
        // 'etika_bobot_penilai',
        'goal_kinerja_bobot_aspek',
        // 'goal_kinerja_bobot_penilai',
        'error_kinerja_bobot_aspek',
        // 'error_kinerja_bobot_penilai',
        'proses_dokumen_bobot_aspek',
        // 'proses_dokumen_bobot_penilai',
        'proses_inisiatif_bobot_aspek',
        // 'proses_inisiatif_bobot_penilai',
        'proses_polapikir_bobot_aspek',
        // 'proses_polapikir_bobot_penilai',
        'sum_nilai_k_bobot_aspek',
        // 'sum_nilai_k_bobot_penilai',
        'sum_nilai_s_bobot_aspek',
        // 'sum_nilai_s_bobot_penilai',
        'sum_nilai_p_bobot_aspek',
        // 'sum_nilai_p_bobot_penilai',
        'sum_nilai_dp3',
        'relasi',
    ];

    public function relasi_karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_penilai', 'id');
    }

    public function relasi_respon()
    {
        return $this->belongsTo(PoolRespon::class, 'pool_respon_id', 'id');
    }

    public function identitas_dinilai()
    {
        return $this->hasOne(RelasiKaryawan::class, 'npp_karyawan', 'npp_dinilai');
    }

}
