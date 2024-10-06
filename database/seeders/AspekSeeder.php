<?php

namespace Database\Seeders;

use App\Models\Aspek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AspekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_aspek' => 'Kepemimpinan',                          'created_at' => Carbon::now()],
            ['nama_aspek' => 'Nilai-nilai Perusahaan dan Perilaku',   'created_at' => Carbon::now()],
            ['nama_aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'created_at' => Carbon::now()]
        ];

        Aspek::insert($data);
    }
}
