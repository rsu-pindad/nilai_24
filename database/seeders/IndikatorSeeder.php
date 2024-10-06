<?php

namespace Database\Seeders;

use App\Models\Indikator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // 1
            ['aspek_id' => 1, 'nama_indikator' => 'Strategi - Perencanaan'],
            ['aspek_id' => 1, 'nama_indikator' => 'Strategi - Pengawasan'],
            ['aspek_id' => 1, 'nama_indikator' => 'Strategi - Inovasi'],
            ['aspek_id' => 1, 'nama_indikator' => 'Kepemimpinan'],
            ['aspek_id' => 1, 'nama_indikator' => 'Membimbing dan Membangun'],
            ['aspek_id' => 1, 'nama_indikator' => 'Pengambilan Keputusan'],
            // 2
            ['aspek_id' => 2, 'nama_indikator' => 'Kerjasama'],
            ['aspek_id' => 2, 'nama_indikator' => 'Komunikasi'],
            ['aspek_id' => 2, 'nama_indikator' => 'Disiplin dan Kehadiran / Absensi'],
            ['aspek_id' => 2, 'nama_indikator' => 'Dedikasi dan Integritas'],
            ['aspek_id' => 2, 'nama_indikator' => 'Etika'],
            // 3
            ['aspek_id' => 3, 'nama_indikator' => 'Goal - Pencapaian Kinerja'],
            ['aspek_id' => 3, 'nama_indikator' => 'Error - Pencapaian kinerja'],
            ['aspek_id' => 3, 'nama_indikator' => 'Proses - Pencapaian Kinerja ( Dokumen )'],
            ['aspek_id' => 3, 'nama_indikator' => 'Proses - Pencapaian Kinerja ( Inisiatif )'],
            ['aspek_id' => 3, 'nama_indikator' => 'Proses - Pencapaian Kinerja ( Pola Pikir )'],
        ];

        Indikator::insert($data);
    }
}
