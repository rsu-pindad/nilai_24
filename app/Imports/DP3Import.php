<?php

namespace App\Imports;

use App\Models\PercentRelation;
use App\Models\Score;
use App\Models\ScoreResponse;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DP3Import implements ToCollection, WithCalculatedFormulas, WithStartRow
{

    public function collection(Collection $rows)
    {
        $level = [
            'I A' => 1,
            'I B' => 1,
            'I C' => 1,
            'I A NS' => 1,
            'II' => 2,
            'II NS' => 2,
            'III' => 3,
            'III NS' => 3,
            'IV A' => 4,
            'IV B' => 4,
            'V' => 5,
        ];

        foreach ($rows as $val) {
            $userLevel = User::where('npp', $val[1])->first()->level ?? '';

            // userlevel = level sendiri | $val[5] level dinilai
            $selfLevel = $level[$userLevel] ?? false;
            $otherLevel = $level[$val[5]] ?? false;

            if ($selfLevel > $otherLevel) {
                $assessed = 'atasan';
            } else if ($selfLevel == $otherLevel) {
                if ($val[1] == $val[3]) {
                    $assessed = 'self';
                } else {
                    $assessed = 'selevel';
                }
            } else if ($selfLevel < $otherLevel) {
                $assessed = 'staff';
            } else {
                $assessed = 'tidak diketahui';
            }

            if ($selfLevel < $otherLevel) {
                $evaluator = 'atasan';
            } else if ($selfLevel == $otherLevel) {
                if ($val[1] == $val[3]) {
                    $evaluator = 'self';
                } else {
                    $evaluator = 'selevel';
                }
            } else if ($selfLevel > $otherLevel) {
                $evaluator = 'staff';
            } else {
                $evaluator = 'tidak diketahui';
            }

            // kepemimpinan
            $scoreKpPlan = $this->score('Kepemimpinan', 'Strategi - Perencanaan', $val[6]);
            $scoreKpSuvi = $this->score('Kepemimpinan', 'Strategi - Pengawasan', $val[7]);
            $scoreKpInov = $this->score('Kepemimpinan', 'Strategi - Inovasi', $val[8]);
            $scoreKpLead = $this->score('Kepemimpinan', 'Kepemimpinan', $val[9]);
            $scoreKpGuide = $this->score('Kepemimpinan', 'Membimbing dan Membangun', $val[10]);
            $scoreKpDema = $this->score('Kepemimpinan', 'Pengambilan Keputusan', $val[11]);

            // Nilai-nilai perusahaan dan perilaku
            $scoreNnppTeam = $this->score('Nilai-nilai perusahaan dan perilaku', 'Kerjasama', $val[12]);
            $scoreNnppComm = $this->score('Nilai-nilai perusahaan dan perilaku', 'Komunikasi', $val[13]);
            $scoreNnppDisc = $this->score('Nilai-nilai perusahaan dan perilaku', 'Disiplin dan Kehadiran / Absensi', $val[14]);
            $scoreNnppDedi = $this->score('Nilai-nilai perusahaan dan perilaku', 'Dedikasi dan Integritas', $val[15]);
            $scoreNnppEthi = $this->score('Nilai-nilai perusahaan dan perilaku', 'Etika', $val[16]);

            // Sasaran Kinerja dan Proses Pencapaian
            $scoreSkppGoal = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Goal - Pencapaian Kinerja', $val[17]);
            $scoreSkppError = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Error - Pencapaian Kinerja', $val[18]);
            $scoreSkppDocu = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Proses - Pencapaian Kinerja ( Dokumen )', $val[19]);
            $scoreSkppInit = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Proses - Pencapaian Kinerja ( Inisiatif )', $val[20]);
            $scoreSkppMind = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Proses - Pencapaian Kinerja ( Pola Pikir )', $val[21]);


            // $recap[] = [
            //     'npp_penilai' => $val[1],
            //     'nama_penilai' => $val[2],
            //     'level_penilai' => $userLevel,
            //     'npp_dinilai' => $val[3],
            //     'nama_dinilai' => $val[4],
            //     'level_dinilai' => $val[5],
            //     'kepemimpinan' => [
            //         'skor_kp_perencanaan' => $scoreKpPlan,
            //         'skor_kp_pengawasan' =>  $scoreKpSuvi,
            //         'skor_kp_inovasi' =>  $scoreKpInov,
            //         'skor_kp_kepemimpinan' =>  $scoreKpLead,
            //         'skor_kp_membimbing' => $scoreKpGuide,
            //         'skor_kp_keputusan' => $scoreKpDema,
            //         'relasi_penilai' => $evaluator,
            //         'relasi_dinilai' => $assessed,
            //     ],
            //     'nilai_perusahaan_prilaku' => [
            //         'skor_nnpp_kerjasama' => $scoreNnppTeam,
            //         'skor_nnpp_komunikasi' => $scoreNnppComm,
            //         'skor_nnpp_disiplin' => $scoreNnppDisc,
            //         'skor_nnpp_dedikasi' => $scoreNnppDedi,
            //         'skor_nnpp_etika' => $scoreNnppEthi,
            //         'relasi_penilai' => $evaluator,
            //         'relasi_dinilai' => $assessed,
            //     ],
            //     'kinerja_pencapaian' => [
            //         'skor_skpp_goal' => $scoreSkppGoal,
            //         'skor_skpp_error' => $scoreSkppError,
            //         'skor_skpp_dokumen' => $scoreSkppDocu,
            //         'skor_skpp_inisiatif' => $scoreSkppInit,
            //         'skor_skpp_pola_pikir' => $scoreSkppMind,
            //         'relasi_penilai' => $evaluator,
            //         'relasi_dinilai' => $assessed,
            //     ],


            // ];

            // ScoreResponse::create(
            $responScore[] = [
                'npp_penilai' => $val[1],
                'nama_penilai' => $val[2],
                'level_penilai' => $userLevel,
                'relasi_penilai' => $evaluator,

                'npp_dinilai' => $val[3],
                'nama_dinilai' => $val[4],
                'level_dinilai' => $val[5],
                'relasi_dinilai' => $assessed,

                'kpmn_perencanaan' => $scoreKpPlan,
                'kpmn_pengawasan' =>  $scoreKpSuvi,
                'kpmn_inovasi' =>  $scoreKpInov,
                'kpmn_kepemimpinan' =>  $scoreKpLead,
                'kpmn_membimbing' => $scoreKpGuide,
                'kpmn_keputusan' => $scoreKpDema,

                'nnpp_kerjasama' => $scoreNnppTeam,
                'nnpp_komunikasi' => $scoreNnppComm,
                'nnpp_disiplin' => $scoreNnppDisc,
                'nnpp_dedikasi' => $scoreNnppDedi,
                'nnpp_etika' => $scoreNnppEthi,

                'skpp_goal' => $scoreSkppGoal,
                'skpp_error' => $scoreSkppError,
                'skpp_dokumen' => $scoreSkppDocu,
                'skpp_inisiatif' => $scoreSkppInit,
                'skpp_pola_pikir' => $scoreSkppMind,
            ];
            // ]);
        }
    }

    function score($aspect, $indicator, $answer)
    {
        return Score::where(['aspek' => $aspect, 'indikator' => $indicator, 'jawaban' => $answer])->first()->skor ?? 0;
    }

    public function startRow(): int
    {
        return 2;
    }
}
