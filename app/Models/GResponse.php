<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'google_form';

    protected $guard = 'id';

    protected $fillable = [
        'timestamp',
        'npp_penilai',
        'nama_penilai',
        'npp_dinilai',
        'nama_dinilai',
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
    ];

    public function relasi_penilai()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_penilai', 'npp_karyawan');
    }

    public function relasi_dinilai()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_dinilai', 'npp_karyawan');
    }
}
