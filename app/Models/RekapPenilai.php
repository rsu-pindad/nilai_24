<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RekapPenilai extends Model
{
    use HasFactory, SoftDeletes;

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
        'npp_penilai_dinilai'
    ];

    public function relasi_karyawan(): BelongsTo
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_penilai', 'id');
    }

    public function relasi_respon(): BelongsTo
    {
        return $this->belongsTo(PoolRespon::class, 'pool_respon_id', 'id');
    }

    public function identitas_dinilai(): HasOne
    {
        return $this->hasOne(RelasiKaryawan::class, 'npp_karyawan', 'npp_dinilai');
    }

    public function identitas_penilai(): HasOne
    {
        return $this->hasOne(RelasiKaryawan::class, 'id', 'npp_penilai');
    }

    // public function google(): HasOne
    // {
    //     return $this->hasOne(GResponse::class, 'npp_dinilai', 'npp_dinilai');
    // }

    // public function google_response($npp_penilai, $npp_dinilai)
    // {
    //     return $this->google()
    //     ->where('npp_penilai', $npp_penilai)
    //     ->where('npp_dinilai', $npp_dinilai)
    //     // ->addSelect(
    //     //     DB::raw("distinch google_form.id")
    //     // )
    //     ->latest();
    // }
}
