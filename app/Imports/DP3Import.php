<?php

namespace App\Imports;

use App\Models\PercentRelation;
use App\Models\Score;
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

            if (!$selfLevel > $otherLevel) {
                $evaluator = 'atasan';
            } else if ($selfLevel == $otherLevel) {
                if ($val[1] == $val[3]) {
                    $evaluator = 'self';
                } else {
                    $evaluator = 'selevel';
                }
            } else if (!$selfLevel < $otherLevel) {
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


            $recap[] = [
                'npp_penilai' => $val[1],
                'nama_penilai' => $val[2],
                'level_penilai' => $userLevel,
                'npp_dinilai' => $val[3],
                'nama_dinilai' => $val[4],
                'level_dinilai' => $val[5],
                'kepemimpinan' => [
                    'skor_kp_perencanaan' => $scoreKpPlan,
                    'skor_kp_pengawasan' =>  $scoreKpSuvi,
                    'skor_kp_inovasi' =>  $scoreKpInov,
                    'skor_kp_kepemimpinan' =>  $scoreKpLead,
                    'skor_kp_membimbing' => $scoreKpGuide,
                    'skor_kp_keputusan' => $scoreKpDema,
                    'relasi_penilai' => $evaluator,
                    'relasi_dinilai' => $assessed,
                ],
                'nilai_perusahaan_prilaku' => [
                    'skor_nnpp_kerjasama' => $scoreNnppTeam,
                    'skor_nnpp_komunikasi' => $scoreNnppComm,
                    'skor_nnpp_disiplin' => $scoreNnppDisc,
                    'skor_nnpp_dedikasi' => $scoreNnppDedi,
                    'skor_nnpp_etika' => $scoreNnppEthi,
                    'relasi_penilai' => $evaluator,
                    'relasi_dinilai' => $assessed,
                ],
                'kinerja_pencapaian' => [
                    'skor_skpp_goal' => $scoreSkppGoal,
                    'skor_skpp_error' => $scoreSkppError,
                    'skor_skpp_dokumen' => $scoreSkppDocu,
                    'skor_skpp_inisiatif' => $scoreSkppInit,
                    'skor_skpp_pola_pikir' => $scoreSkppMind,
                    'relasi_penilai' => $evaluator,
                    'relasi_dinilai' => $assessed,
                ],


            ];
            // die;
        }
        // dd($recap);
        $filterRecap = collect($recap)->filter(function ($rc) {
            return $rc['npp_dinilai'] == 11029;
        });
        // dd($filterRecap);
        // foreach ($recap as $rKey => $rVal) {
        //     // 
        //     $prBossVal = PercentRelation::where(['status' => 'atasan', 'level' => $rVal['level_dinilai']])->first()->nilai;
        //     $prSelfVal = PercentRelation::where(['status' => 'self', 'level' => $rVal['level_dinilai']])->first()->nilai;
        //     $prLevelVal = PercentRelation::where(['status' => 'rekan kerja', 'level' => $rVal['level_dinilai']])->first()->nilai;
        //     $prStaffVal = PercentRelation::where(['status' => 'staff', 'level' => $rVal['level_dinilai']])->first()->nilai;


        //     if ($recap[$rKey]['npp_dinilai'] == $rVal['npp_dinilai']) {
        //         $weighting[$rVal['npp_dinilai']] = [
        //             'npp_dinilai' => $rVal['npp_dinilai'],
        //             'nama_dinilai' => $rVal['nama_dinilai'],
        //             'level_dinilai' => $rVal['level_dinilai'],
        //         ];
        //         // atasan
        //         if ($rVal['relasi_dinilai'] == 'atasan') {
        //             echo $rVal['kepemimpinan']['skor_kp_perencanaan'] . '<br>';
        //             // hitung kepemimpinan
        //             $calcBossKpPlan = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prBossVal;
        //             $calcBossKpSuvi = $rVal['kepemimpinan']['skor_kp_pengawasan'] * $prBossVal;
        //             $calcBossKpInov = $rVal['kepemimpinan']['skor_kp_inovasi'] * $prBossVal;
        //             $calcBossKpLead = $rVal['kepemimpinan']['skor_kp_kepemimpinan'] * $prBossVal;
        //             $calcBossKpGuide = $rVal['kepemimpinan']['skor_kp_membimbing'] * $prBossVal;
        //             $calcBossKpDema = $rVal['kepemimpinan']['skor_kp_keputusan'] * $prBossVal;
        //             $sumPrKpBoss = $calcBossKpPlan + $calcBossKpSuvi + $calcBossKpInov + $calcBossKpLead + $calcBossKpGuide + $calcBossKpDema;

        //             $weighting[$rVal['npp_dinilai']]['kepemimpinan']['atasan'] = [
        //                 'hitung_kp_perencanaan' => $calcBossKpPlan,
        //                 'hitung_kp_pengawasan' => $calcBossKpSuvi,
        //                 'hitung_kp_inovasi' => $calcBossKpInov,
        //                 'hitung_kp_kepemimpinan' => $calcBossKpLead,
        //                 'hitung_kp_membimbing' => $calcBossKpGuide,
        //                 'hitung_kp_keputusan' => $calcBossKpDema,
        //                 'total_kp' => $sumPrKpBoss

        //             ];

        //             // hitung nilai perusahaan & prilaku
        //             $calcBossNnppTeam = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_kerjasama'] * $prBossVal;
        //             $calcBossNnppComm = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_komunikasi'] * $prBossVal;
        //             $calcBossNnppDisc = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_disiplin'] * $prBossVal;
        //             $calcBossNnppDedi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_dedikasi'] * $prBossVal;
        //             $calcBossNnppEthi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_etika'] * $prBossVal;
        //             $sumPrNnppBoss = $calcBossNnppTeam + $calcBossNnppComm + $calcBossNnppDisc + $calcBossNnppDedi + $calcBossNnppEthi;

        //             $weighting[$rVal['npp_dinilai']]['nilai_perusahaan_prilaku']['atasan'] = [
        //                 'hitung_nnpp_kerjasama' => $calcBossNnppTeam,
        //                 'hitung_nnpp_komunikasi' => $calcBossNnppComm,
        //                 'hitung_nnpp_disiplin' => $calcBossNnppDisc,
        //                 'hitung_nnpp_dedikasi' => $calcBossNnppDedi,
        //                 'hitung_nnpp_etika' => $calcBossNnppEthi,
        //                 'total_nnpp' => $sumPrNnppBoss
        //             ];

        //             // // hitung kinerja & pencapaian
        //             $calcBossSkppGoal = $rVal['kinerja_pencapaian']['skor_skpp_goal'] * $prBossVal;
        //             $calcBossSkppError = $rVal['kinerja_pencapaian']['skor_skpp_error'] * $prBossVal;
        //             $calcBossSkppDocu = $rVal['kinerja_pencapaian']['skor_skpp_dokumen'] * $prBossVal;
        //             $calcBossSkppInit = $rVal['kinerja_pencapaian']['skor_skpp_inisiatif'] * $prBossVal;
        //             $calcBossSkppMind = $rVal['kinerja_pencapaian']['skor_skpp_pola_pikir'] * $prBossVal;
        //             $sumPrSkppBoss = $calcBossSkppGoal + $calcBossSkppError + $calcBossSkppDocu + $calcBossSkppInit + $calcBossSkppMind;

        //             $weighting[$rVal['npp_dinilai']]['kinerja_pencapaian']['atasan'] = [
        //                 'hitung_skpp_goal' => $calcBossSkppGoal,
        //                 'hitung_skpp_error' => $calcBossSkppError,
        //                 'hitung_skpp_dokumen' => $calcBossSkppDocu,
        //                 'hitung_skpp_inisiatif' => $calcBossSkppInit,
        //                 'hitung_skpp_pola_pikir' => $calcBossSkppMind,
        //                 'total_skpp' => $sumPrSkppBoss
        //             ];
        //         }
        //         // self
        //         else if ($rVal['relasi_dinilai'] == 'self') {
        //             // hitung kepemimpinan
        //             $calcSelfKpPlan = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prSelfVal;
        //             $calcSelfKpSuvi = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prSelfVal;
        //             $calcSelfKpInov = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prSelfVal;
        //             $calcSelfKpLead = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prSelfVal;
        //             $calcSelfKpGuide = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prSelfVal;
        //             $calcSelfKpDema = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prSelfVal;
        //             $sumPrKpSelf = $calcSelfKpPlan + $calcSelfKpSuvi + $calcSelfKpInov + $calcSelfKpLead + $calcSelfKpGuide + $calcSelfKpDema;

        //             $weighting[$rVal['npp_dinilai']]['kepemimpinan']['self'] = [
        //                 'hitung_kp_perencanaan' => $calcSelfKpPlan,
        //                 'hitung_kp_pengawasan' => $calcSelfKpSuvi,
        //                 'hitung_kp_inovasi' => $calcSelfKpInov,
        //                 'hitung_kp_kepemimpinan' => $calcSelfKpLead,
        //                 'hitung_kp_membimbing' => $calcSelfKpGuide,
        //                 'hitung_kp_keputusan' => $calcSelfKpDema,
        //                 'total_kp' => $sumPrKpSelf

        //             ];

        //             // hitung nilai perusahaan & prilaku
        //             $calcSelfNnppTeam = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_kerjasama'] * $prSelfVal;
        //             $calcSelfNnppComm = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_komunikasi'] * $prSelfVal;
        //             $calcSelfNnppDisc = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_disiplin'] * $prSelfVal;
        //             $calcSelfNnppDedi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_dedikasi'] * $prSelfVal;
        //             $calcSelfNnppEthi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_etika'] * $prSelfVal;
        //             $sumPrNnppSelf = $calcSelfNnppTeam + $calcSelfNnppComm + $calcSelfNnppDisc + $calcSelfNnppDedi + $calcSelfNnppEthi;

        //             $weighting[$rVal['npp_dinilai']]['nilai_perusahaan_prilaku']['self'] = [
        //                 'hitung_nnpp_kerjasama' => $calcSelfNnppTeam,
        //                 'hitung_nnpp_komunikasi' => $calcSelfNnppComm,
        //                 'hitung_nnpp_disiplin' => $calcSelfNnppDisc,
        //                 'hitung_nnpp_dedikasi' => $calcSelfNnppDedi,
        //                 'hitung_nnpp_etika' => $calcSelfNnppEthi,
        //                 'total_nnpp' => $sumPrNnppSelf
        //             ];

        //             // // hitung kinerja & pencapaian
        //             $calcSelfSkppGoal = $rVal['kinerja_pencapaian']['skor_skpp_goal'] * $prSelfVal;
        //             $calcSelfSkppError = $rVal['kinerja_pencapaian']['skor_skpp_error'] * $prSelfVal;
        //             $calcSelfSkppDocu = $rVal['kinerja_pencapaian']['skor_skpp_dokumen'] * $prSelfVal;
        //             $calcSelfSkppInit = $rVal['kinerja_pencapaian']['skor_skpp_inisiatif'] * $prSelfVal;
        //             $calcSelfSkppMind = $rVal['kinerja_pencapaian']['skor_skpp_pola_pikir'] * $prSelfVal;
        //             $sumPrSkppSelf = $calcSelfSkppGoal + $calcSelfSkppError + $calcSelfSkppDocu + $calcSelfSkppInit + $calcSelfSkppMind;

        //             $weighting[$rVal['npp_dinilai']]['kinerja_pencapaian']['self'] = [
        //                 'hitung_skpp_goal' => $calcSelfSkppGoal,
        //                 'hitung_skpp_error' => $calcSelfSkppError,
        //                 'hitung_skpp_dokumen' => $calcSelfSkppDocu,
        //                 'hitung_skpp_inisiatif' => $calcSelfSkppInit,
        //                 'hitung_skpp_pola_pikir' => $calcSelfSkppMind,
        //                 'total_skpp' => $sumPrSkppSelf
        //             ];
        //         }
        //         // selevel
        //         else if ($rVal['relasi_dinilai'] == 'selevel') {
        //             // hitung kepemimpinan
        //             $calcLevelKpPlan = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prLevelVal;
        //             $calcLevelKpSuvi = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prLevelVal;
        //             $calcLevelKpInov = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prLevelVal;
        //             $calcLevelKpLead = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prLevelVal;
        //             $calcLevelKpGuide = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prLevelVal;
        //             $calcLevelKpDema = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prLevelVal;
        //             $sumPrKpLevel = $calcLevelKpPlan + $calcLevelKpSuvi + $calcLevelKpInov + $calcLevelKpLead + $calcLevelKpGuide + $calcLevelKpDema;

        //             $weighting[$rVal['npp_dinilai']]['kepemimpinan']['selevel'] = [
        //                 'hitung_kp_perencanaan' => $calcLevelKpPlan,
        //                 'hitung_kp_pengawasan' => $calcLevelKpSuvi,
        //                 'hitung_kp_inovasi' => $calcLevelKpInov,
        //                 'hitung_kp_kepemimpinan' => $calcLevelKpLead,
        //                 'hitung_kp_membimbing' => $calcLevelKpGuide,
        //                 'hitung_kp_keputusan' => $calcLevelKpDema,
        //                 'total_kp' => $sumPrKpLevel

        //             ];

        //             // hitung nilai perusahaan & prilaku
        //             $calcLevelNnppTeam = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_kerjasama'] * $prLevelVal;
        //             $calcLevelNnppComm = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_komunikasi'] * $prLevelVal;
        //             $calcLevelNnppDisc = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_disiplin'] * $prLevelVal;
        //             $calcLevelNnppDedi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_dedikasi'] * $prLevelVal;
        //             $calcLevelNnppEthi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_etika'] * $prLevelVal;
        //             $sumPrNnppLevel = $calcLevelNnppTeam + $calcLevelNnppComm + $calcLevelNnppDisc + $calcLevelNnppDedi + $calcLevelNnppEthi;

        //             $weighting[$rVal['npp_dinilai']]['nilai_perusahaan_prilaku']['selevel'] = [
        //                 'hitung_nnpp_kerjasama' => $calcLevelNnppTeam,
        //                 'hitung_nnpp_komunikasi' => $calcLevelNnppComm,
        //                 'hitung_nnpp_disiplin' => $calcLevelNnppDisc,
        //                 'hitung_nnpp_dedikasi' => $calcLevelNnppDedi,
        //                 'hitung_nnpp_etika' => $calcLevelNnppEthi,
        //                 'total_nnpp' => $sumPrNnppLevel
        //             ];

        //             // // hitung kinerja & pencapaian
        //             $calcLevelSkppGoal = $rVal['kinerja_pencapaian']['skor_skpp_goal'] * $prLevelVal;
        //             $calcLevelSkppError = $rVal['kinerja_pencapaian']['skor_skpp_error'] * $prLevelVal;
        //             $calcLevelSkppDocu = $rVal['kinerja_pencapaian']['skor_skpp_dokumen'] * $prLevelVal;
        //             $calcLevelSkppInit = $rVal['kinerja_pencapaian']['skor_skpp_inisiatif'] * $prLevelVal;
        //             $calcLevelSkppMind = $rVal['kinerja_pencapaian']['skor_skpp_pola_pikir'] * $prLevelVal;
        //             $sumPrSkppLevel = $calcLevelSkppGoal + $calcLevelSkppError + $calcLevelSkppDocu + $calcLevelSkppInit + $calcLevelSkppMind;

        //             $weighting[$rVal['npp_dinilai']]['kinerja_pencapaian']['selevel'] = [
        //                 'hitung_skpp_goal' => $calcLevelSkppGoal,
        //                 'hitung_skpp_error' => $calcLevelSkppError,
        //                 'hitung_skpp_dokumen' => $calcLevelSkppDocu,
        //                 'hitung_skpp_inisiatif' => $calcLevelSkppInit,
        //                 'hitung_skpp_pola_pikir' => $calcLevelSkppMind,
        //                 'total_skpp' => $sumPrSkppLevel
        //             ];
        //         }
        //         // staff
        //         else if ($rVal['relasi_dinilai'] == 'staff') {
        //             // hitung kepemimpinan
        //             $calcStaffKpPlan = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prStaffVal;
        //             $calcStaffKpSuvi = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prStaffVal;
        //             $calcStaffKpInov = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prStaffVal;
        //             $calcStaffKpLead = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prStaffVal;
        //             $calcStaffKpGuide = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prStaffVal;
        //             $calcStaffKpDema = $rVal['kepemimpinan']['skor_kp_perencanaan'] * $prStaffVal;
        //             $sumPrKpStaff = $calcStaffKpPlan + $calcStaffKpSuvi + $calcStaffKpInov + $calcStaffKpLead + $calcStaffKpGuide + $calcStaffKpDema;

        //             $weighting[$rVal['npp_dinilai']]['kepemimpinan']['staff'] = [
        //                 'hitung_kp_perencanaan' => $calcStaffKpPlan,
        //                 'hitung_kp_pengawasan' => $calcStaffKpSuvi,
        //                 'hitung_kp_inovasi' => $calcStaffKpInov,
        //                 'hitung_kp_kepemimpinan' => $calcStaffKpLead,
        //                 'hitung_kp_membimbing' => $calcStaffKpGuide,
        //                 'hitung_kp_keputusan' => $calcStaffKpDema,
        //                 'total_kp' => $sumPrKpStaff

        //             ];

        //             // hitung nilai perusahaan & prilaku
        //             $calcStaffNnppTeam = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_kerjasama'] * $prStaffVal;
        //             $calcStaffNnppComm = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_komunikasi'] * $prStaffVal;
        //             $calcStaffNnppDisc = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_disiplin'] * $prStaffVal;
        //             $calcStaffNnppDedi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_dedikasi'] * $prStaffVal;
        //             $calcStaffNnppEthi = $rVal['nilai_perusahaan_prilaku']['skor_nnpp_etika'] * $prStaffVal;
        //             $sumPrNnppStaff = $calcStaffNnppTeam + $calcStaffNnppComm + $calcStaffNnppDisc + $calcStaffNnppDedi + $calcStaffNnppEthi;

        //             $weighting[$rVal['npp_dinilai']]['nilai_perusahaan_prilaku']['staff'] = [
        //                 'hitung_nnpp_kerjasama' => $calcStaffNnppTeam,
        //                 'hitung_nnpp_komunikasi' => $calcStaffNnppComm,
        //                 'hitung_nnpp_disiplin' => $calcStaffNnppDisc,
        //                 'hitung_nnpp_dedikasi' => $calcStaffNnppDedi,
        //                 'hitung_nnpp_etika' => $calcStaffNnppEthi,
        //                 'total_nnpp' => $sumPrNnppStaff
        //             ];

        //             // // hitung kinerja & pencapaian
        //             $calcStaffSkppGoal = $rVal['kinerja_pencapaian']['skor_skpp_goal'] * $prStaffVal;
        //             $calcStaffSkppError = $rVal['kinerja_pencapaian']['skor_skpp_error'] * $prStaffVal;
        //             $calcStaffSkppDocu = $rVal['kinerja_pencapaian']['skor_skpp_dokumen'] * $prStaffVal;
        //             $calcStaffSkppInit = $rVal['kinerja_pencapaian']['skor_skpp_inisiatif'] * $prStaffVal;
        //             $calcStaffSkppMind = $rVal['kinerja_pencapaian']['skor_skpp_pola_pikir'] * $prStaffVal;
        //             $sumPrSkppStaff = $calcStaffSkppGoal + $calcStaffSkppError + $calcStaffSkppDocu + $calcStaffSkppInit + $calcStaffSkppMind;

        //             $weighting[$rVal['npp_dinilai']]['kinerja_pencapaian']['staff'] = [
        //                 'hitung_skpp_goal' => $calcStaffSkppGoal,
        //                 'hitung_skpp_error' => $calcStaffSkppError,
        //                 'hitung_skpp_dokumen' => $calcStaffSkppDocu,
        //                 'hitung_skpp_inisiatif' => $calcStaffSkppInit,
        //                 'hitung_skpp_pola_pikir' => $calcStaffSkppMind,
        //                 'total_skpp' => $sumPrSkppStaff
        //             ];
        //         }
        //     }
        // }
        dd($filterRecap);
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
