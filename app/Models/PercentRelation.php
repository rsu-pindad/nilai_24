<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentRelation extends Model
{
    use HasFactory;

    protected $table = 'tbl_persen_relasi';

    protected $guarded = ['id'];
}
