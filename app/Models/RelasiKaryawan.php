<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function karyawan_atasan(): HasMany
    {
        return $this->hasMany(RelasiAtasan::class, 'relasi_karyawan_id', 'id');
    }

    public function karyawan_selevel(): HasMany
    {
        return $this->hasMany(RelasiSelevel::class, 'relasi_karyawan_id', 'id');
    }

    public function karyawan_staff(): HasMany
    {
        return $this->hasMany(RelasiStaff::class, 'relasi_karyawan_id', 'id');
    }

    public function finalDp3(): HasMany
    {
        return $this->hasMany(RekapDp3::class, 'dinilai_id', 'id');
    }

    public function getSum($value)
    {
        return $this->finalDp3()->where('relasi', '!=', 'staff')->sum($value);
    }

    public function getAvg($value)
    {
        return $this->finalDp3()->where('relasi', '=', 'staff')->average($value);
    }

    public function relasi_atasan(): HasOne
    {
        return $this->hasOne(RelasiAtasan::class, 'relasi_karyawan_id', 'id');
    }
}
