<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolRespon extends Model
{
    use HasFactory;

    protected $table = 'pool_respon';

    protected $guard = 'id';

    protected $fillable = [
        'npp_penilai',
        'npp_dinilai',
        'jabatan_dinilai',
        'strategi_perencanaan',
        'strategi_pengawasan',
        'strategi_inovasi',
        'kepemimpinan',
        'membimbing_membangun',
        'pengambilan_keputusan',
        'kerjasama',
        'komunikasi',
        'absensi',
        'integritas',
        'etika',
        'goal_kinerja',
        'error_kinerja',
        'proses_dokumen',
        'proses_inisiatif',
        'proses_polapikir',
        'sum_nilai',
        'relasi',
    ];

    public function karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class,'npp_penilai');
    }
}
