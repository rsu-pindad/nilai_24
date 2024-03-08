<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelasiKaryawan extends Model
{
    use HasFactory;
    protected $table = 'populate_relasi_karyawan';

    protected $guard = 'id';

    protected $fillable = [
        'npp_karyawan',
        'level_jabatan',
        'unit_jabatan',
        'nama_karyawan',
    ];

    public function karyawan_atasan()
    {
        return $this->hasMany(RelasiAtasan::class, 'relasi_karyawan_id','id');
    }
    public function karyawan_selevel()
    {
        return $this->hasMany(RelasiSelevel::class, 'relasi_karyawan_id','id');
    }
    public function karyawan_staff()
    {
        return $this->hasMany(RelasiStaff::class, 'relasi_karyawan_id','id');
    }
}
