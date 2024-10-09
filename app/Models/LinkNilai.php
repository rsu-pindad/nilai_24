<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkNilai extends Model
{
    use HasFactory;

    protected $table   = 'link_nilai';
    protected $guarded = 'id';

    protected $fillable = [
        'form_start',
        'form_1',
        'form_2',
        'form_3',
        'form_4',
        'form_5',
        'active',
    ];
}
