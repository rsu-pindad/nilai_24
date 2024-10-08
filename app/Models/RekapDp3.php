<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class RekapDp3 extends Model
{
    use HasFactory;

    protected $table = 'rekap_dp3';

    protected $fillable = [
        'rekap_penilai_id',
        'penilai_id',
        'dinilai_id',
        'strategi_perencanaan_konversi_aspek',
        'strategi_pengawasan_konversi_aspek',
        'strategi_inovasi_konversi_aspek',
        'kepemimpinan_konversi_aspek',
        'membimbing_membangun_konversi_aspek',
        'pengambilan_keputusan_konversi_aspek',
        'kerjasama_konversi_aspek',
        'komunikasi_konversi_aspek',
        'absensi_konversi_aspek',
        'integritas_konversi_aspek',
        'etika_konversi_aspek',
        'goal_kinerja_konversi_aspek',
        'error_kinerja_konversi_aspek',
        'proses_dokumen_konversi_aspek',
        'proses_inisiatif_konversi_aspek',
        'proses_polapikir_konversi_aspek',
        'sum_nilai_k_konversi_aspek',
        'sum_nilai_s_konversi_aspek',
        'sum_nilai_p_konversi_aspek',
        'sum_nilai_dp3',
        'relasi'
    ];

    public function identitas_penilai(): HasOne
    {
        return $this->hasOne(RelasiKaryawan::class, 'id', 'penilai_id');
    }

    public function identitas_dinilai(): HasOne
    {
        return $this->hasOne(RelasiKaryawan::class, 'id', 'dinilai_id');
    }

    public function belongsDinilaiRelasiKaryawan(): BelongsTo
    {
        return $this->belongsTo(RelasiKaryawan::class, 'dinilai_id', 'id');
    }
}
