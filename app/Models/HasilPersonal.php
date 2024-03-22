<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPersonal extends Model
{
    use HasFactory;

    protected $table = 'hasil_personal';

    protected $guard = 'id';

    protected $fillable = [
        'npp_dinilai_id',
        'npp_penilai_id',

        // Kepemimpinan
        'k_avg_1',
        'k_avg_2',
        'k_avg_3',
        'k_avg_4',
        'k_avg_5',
        'k_avg_6',
        
        'mutator_k_avg_1',
        'mutator_k_avg_2',
        'mutator_k_avg_3',
        'mutator_k_avg_4',
        'mutator_k_avg_5',
        'mutator_k_avg_6',
        
        'p_avg_1',
        'p_avg_2',
        'p_avg_3',
        'p_avg_4',
        'p_avg_5',

        'mutator_p_avg_1',
        'mutator_p_avg_2',
        'mutator_p_avg_3',
        'mutator_p_avg_4',
        'mutator_p_avg_5',

        's_avg_1',
        's_avg_2',
        's_avg_3',
        's_avg_4',
        's_avg_5',

        'mutator_s_avg_1',
        'mutator_s_avg_2',
        'mutator_s_avg_3',
        'mutator_s_avg_4',
        'mutator_s_avg_5',

        'sum_rekap_self',
        'sum_rekap_atasan',
        'sum_rekap_rekan',
        'sum_rekap_staff',
        
        'keterangan_nilai',
    ];
    
    // public function karyawan_atasan()
    // {
    //     return $this->hasManyThrough(
    //         RelasiAtasan::class, 
    //         RelasiKaryawan::class,
    //         'id', // Foreign key di relasi karyawan
    //         'relasi_karyawan_id', // Foreign key di relasi atasan
    //         'npp_dinilai_id', // local key di hasil personal
    //         'id', // local key di relasi karyawan 
    //     );
    // }

    public function identitas_dinilai()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_dinilai_id', 'id');
    }

    public function identitas_penilai()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_penilai_id', 'id');
    }

    public function karyawan_atasan()
    {
        return $this->hasManyThrough(
            RelasiAtasan::class,
            RelasiKaryawan::class, 
            'id',
            'relasi_karyawan_id',
            'npp_dinilai_id',
            'id'
        );
    }

    public function karyawan_selevel()
    {
        return $this->hasManyThrough(
            RelasiSelevel::class,
            RelasiKaryawan::class, 
            'id',
            'relasi_karyawan_id',
            'npp_dinilai_id',
            'id'
        );
    }

    // public function karyawan_selevel($npp_atasan)
    // {
    //     return RelasiAtasan::where('npp_atasan', $npp_atasan)->get();
    // }

    public function karyawan_staff()
    {
        return $this->hasManyThrough(
            RelasiStaff::class,
            RelasiKaryawan::class, 
            'id',
            'relasi_karyawan_id',
            'npp_dinilai_id',
            'id'
        );
    }

}
