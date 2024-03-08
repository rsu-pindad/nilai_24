<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'indikator';

    protected $guard = 'id';

    protected $fillable = [
        'aspek_id',
        'nama_indikator'
    ];
}
