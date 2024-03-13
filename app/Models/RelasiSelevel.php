<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelasiSelevel extends Model
{
    use HasFactory;
    protected $table = 'populate_relasi_selevel';

    protected $guard = 'id';

    protected $fillable = [
        'relasi_karyawan_id',
        'npp_selevel'
    ];

    public function relasi_karyawan(){
        return $this->belongsTo(RelasiKaryawan::class, 'relasi_karyawan_id');
    }
}
