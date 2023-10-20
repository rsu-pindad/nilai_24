<?php

namespace App\Imports;

use App\Models\Employee;
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
            '0' => 0,
            'I A' => 1,
            'I B' => 1,
            'I C' => 1,
            'I A NS' => 1,
            'IA NS' => 1,
            'II' => 2,
            'II NS' => 2,
            'III' => 3,
            'III NS' => 3,
            'IV A' => 4,
            'I V A' => 4,
            'IV B' => 5,
            'I V B' => 5,
            'V' => 5,
        ];
        // dd($rows[5]);

        foreach ($rows as $val) {
            $nppEvaluator = $val[1];
            $nppAssessed = $val[3];
            $userEvaluatorLevel = Employee::where('npp', $nppEvaluator)->first()->level ?? false;
            $userAssessedLevel = Employee::where('npp', $nppAssessed)->first()->level ?? false;
            $evaluator = '';
            $assessed = '';

            // // relasi selevel
            if ($level[$userEvaluatorLevel] == $level[$userAssessedLevel]) {
                $evaluator = 'selevel';
                $assessed = 'selevel';

                // relasi self
                if ($nppEvaluator == $nppAssessed) {
                    $evaluator = 'self';
                    $assessed = 'self';
                }
            }

            // relasi atasan
            if ($level[$userEvaluatorLevel] < $level[$userAssessedLevel]) {
                $evaluator = 'atasan';
                $assessed = 'staff';
            }
            // relasi staff
            if ($level[$userEvaluatorLevel] > $level[$userAssessedLevel]) {
                $evaluator = 'staff';
                $assessed = 'atasan';
            }

            // kepemimpinan
            $scoreKpPlan = $this->score('Kepemimpinan', 'Strategi - Perencanaan', $val[6]);
            $scoreKpSuvi = $this->score('Kepemimpinan', 'Strategi - Pengawasan', $val[7]);
            $scoreKpInov = $this->score('Kepemimpinan', 'Strategi - Inovasi', $val[8]);
            $scoreKpLead = $this->score('Kepemimpinan', 'Kepemimpinan', $val[9]);
            $scoreKpGuide = $this->score('Kepemimpinan', 'Membimbing dan Membangun', $val[10]);
            $scoreKpDema = $this->score('Kepemimpinan', 'Pengambilan Keputusan', $val[11]);

            // Nilai-nilai perusahaan dan perilaku
            $scoreNnppTeam = $this->score('Nilai-nilai Perusahaan dan Perilaku', 'Kerjasama', $val[12]);
            $scoreNnppComm = $this->score('Nilai-nilai Perusahaan dan Perilaku', 'Komunikasi', $val[13]);
            $scoreNnppDisc = $this->score('Nilai-nilai Perusahaan dan Perilaku', 'Disiplin dan Kehadiran / Absensi', $val[14]);
            $scoreNnppDedi = $this->score('Nilai-nilai Perusahaan dan Perilaku', 'Dedikasi dan Integritas', $val[15]);
            $scoreNnppEthi = $this->score('Nilai-nilai Perusahaan dan Perilaku', 'Etika', $val[16]);

            // Sasaran Kinerja dan Proses Pencapaian
            $scoreSkppGoal = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Goal - Pencapaian Kinerja', $val[17]);
            $scoreSkppError = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Error - Pencapaian Kinerja', $val[18]);
            $scoreSkppDocu = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Proses - Pencapaian Kinerja ( Dokumen )', $val[19]);
            $scoreSkppInit = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Proses - Pencapaian Kinerja ( Inisiatif )', $val[20]);
            $scoreSkppMind = $this->score('Sasaran Kinerja dan Proses Pencapaian', 'Proses - Pencapaian Kinerja ( Pola Pikir )', $val[21]);



            ScoreResponse::updateOrCreate(
                ['npp_penilai' => $nppEvaluator, 'npp_dinilai' => $nppAssessed],
                [
                    'npp_penilai' => $nppEvaluator,
                    'nama_penilai' => $val[2],
                    'level_penilai' => $userEvaluatorLevel,
                    'relasi_penilai' => $evaluator,

                    'npp_dinilai' => $nppAssessed,
                    'nama_dinilai' => $val[4],
                    'level_dinilai' => $userAssessedLevel,
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
                ]
            );
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
