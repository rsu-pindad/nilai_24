<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturJadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal_penilaian';
    protected $guard = 'id';

    protected $fillable = [
        'jadwal',
        'akhir_jadwa',
        'lihat_dokumen',
        'lihat_skor',
    ];
}
