<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalDp3 extends Model
{
    use HasFactory;

    protected $table = 'final_dp3';

    protected $guarded = 'id';

    protected $fillable = 
    [
        'npp_dinilai_id',
        'avg_dp3',
        'relasi',
    ];

    public function relasi_karyawan()
    {
        return $this->belongsTo(RelasiKaryawan::class, 'npp_dinilai_id', 'id');
    }
}
