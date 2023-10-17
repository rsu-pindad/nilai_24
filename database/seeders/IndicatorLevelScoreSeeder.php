<?php

namespace Database\Seeders;

use App\Models\PercentIndicator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndicatorLevelScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'I A', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'I B', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'I C', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'IA NS', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'I A NS', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'II', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'II NS', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'III', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'III NS', 'nilai' => 0.25],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'IV A', 'nilai' => 0.3],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'IV B', 'nilai' => 0.35],
            ['status' => 'nilai perusahaan & perilaku', 'level' => 'V', 'nilai' => 0.35],

            ['status' => 'kompetensi / leadership', 'level' => 'I A', 'nilai' => 0.5],
            ['status' => 'kompetensi / leadership', 'level' => 'I B', 'nilai' => 0.5],
            ['status' => 'kompetensi / leadership', 'level' => 'I C', 'nilai' => 0.5],
            ['status' => 'kompetensi / leadership', 'level' => 'IA NS', 'nilai' => 0.5],
            ['status' => 'kompetensi / leadership', 'level' => 'I A NS', 'nilai' => 0.5],
            ['status' => 'kompetensi / leadership', 'level' => 'II', 'nilai' => 0.45],
            ['status' => 'kompetensi / leadership', 'level' => 'II NS', 'nilai' => 0.45],
            ['status' => 'kompetensi / leadership', 'level' => 'III', 'nilai' => 0.4],
            ['status' => 'kompetensi / leadership', 'level' => 'III NS', 'nilai' => 0.4],
            ['status' => 'kompetensi / leadership', 'level' => 'IV A', 'nilai' => 0.1],
            ['status' => 'kompetensi / leadership', 'level' => 'IV B', 'nilai' => 0],
            ['status' => 'kompetensi / leadership', 'level' => 'V', 'nilai' => 0],

            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'I A', 'nilai' => 0.25],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'I B', 'nilai' => 0.25],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'I C', 'nilai' => 0.25],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'IA NS', 'nilai' => 0.25],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'I A NS', 'nilai' => 0.25],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'II', 'nilai' => 0.3],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'II NS', 'nilai' => 0.3],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'III', 'nilai' => 0.35],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'III NS', 'nilai' => 0.35],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'IV A', 'nilai' => 0.6],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'IV B', 'nilai' => 0.65],
            ['status' => 'sasaran kinerja & proses pencapaian', 'level' => 'V', 'nilai' => 0.65],

        ];

        PercentIndicator::insert($data);
    }
}
