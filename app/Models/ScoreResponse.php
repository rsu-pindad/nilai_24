<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoreResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_respon_skor';

    protected $guarded = ['id'];
}
