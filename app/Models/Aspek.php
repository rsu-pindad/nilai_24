<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;

    protected $table = 'aspek';
    protected $guard = 'id';

    protected $fillable = [
        'nama_aspek'
    ];
}
