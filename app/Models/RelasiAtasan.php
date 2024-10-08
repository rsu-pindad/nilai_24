<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class RelasiAtasan extends Model
{
    use HasFactory;

    protected $table = 'populate_relasi_atasan';
    protected $guard = 'id';

    protected $fillable = [
        'relasi_karyawan_id',
        'npp_atasan'
    ];

    public function relasi_karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'relasi_karyawan_id');
    }

    public function relasi_baru_karyawan(): BelongsTo
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_atasan', 'npp_karyawan');
    }

    public function parent_atasan()
    {
        return $this->hasOne(RelasiKaryawan::class, 'id', 'relasi_karyawan_id');
    }
}
