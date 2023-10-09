<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreResponse extends Model
{
    use HasFactory;

    protected $table = 'tbl_respon_skor';

    protected $guarded = ['id'];
}
