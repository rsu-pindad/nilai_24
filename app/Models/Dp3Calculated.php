<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dp3Calculated extends Model
{
    use HasFactory;

    protected $table = 'tbl_hasil_perhitungan_dp3';

    protected $guarded = ['id'];
}
