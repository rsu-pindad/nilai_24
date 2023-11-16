<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dp3Calculated extends Model
{
    use HasFactory;

    protected $table = 'tbl_hasil_perhitungan_dp3';

    protected $guarded = ['id'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'npp_dinilai', 'npp');
    }
}
