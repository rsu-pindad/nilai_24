<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentIndicator extends Model
{
    use HasFactory;

    protected $table = 'tbl_persen_indikator';

    protected $guarded = ['id'];
}
