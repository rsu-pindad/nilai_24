<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelasiStaff extends Model
{
    use HasFactory;
    protected $table = 'populate_relasi_staff';

    protected $guard = 'id';

    protected $fillable = [
        'relasi_karyawan_id',
        'npp_staff'
    ];
    public function relasi_karyawan(){
        return $this->belongsTo(RelasiKaryawan::class, 'relasi_karyawan_id');
    }

    public function parent_staff()
    {
        return $this->hasOne(RelasiKaryawan::class, 'id', 'relasi_karyawan_id');
    }
}
