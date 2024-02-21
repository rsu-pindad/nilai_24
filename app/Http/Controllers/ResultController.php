<?php

namespace App\Http\Controllers;

use App\Imports\DP3Import;
use App\Models\ScoreResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Revolution\Google\Sheets\Facades\Sheets;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ResultController extends Controller
{

    public function respon()
    {
        $responScore = ScoreResponse::all();

        $groupData = $responScore->reduce(function ($group, $currentData) {
            $group[$currentData->npp_dinilai][] = $currentData;
            return $group;
        });

        // // $filterData = collect($groupData)->filter(function ($item, $index) {
        // //     return $index == 12375;
        // // });
        $map = collect($groupData)->map(function ($dtNpp) {
            $countBossEvaluator = 0;
            $countStaffEvaluator = 0;
            $countLevelEvaluator = 0;
            $countSelfEvaluator = 0;

            $sumResponVal = [
                'kepemimpinan' => [
                    'atasan' => ['perencanaan' => 0, 'pengawasan' => 0, 'inovasi' => 0, 'kepemimpinan' => 0, 'membimbing' => 0, 'keputusan' => 0],
                    'self' => ['perencanaan' => 0, 'pengawasan' => 0, 'inovasi' => 0, 'kepemimpinan' => 0, 'membimbing' => 0, 'keputusan' => 0],
                    'selevel' => ['perencanaan' => 0, 'pengawasan' => 0, 'inovasi' => 0, 'kepemimpinan' => 0, 'membimbing' => 0, 'keputusan' => 0],
                    'staff' => ['perencanaan' => 0, 'pengawasan' => 0, 'inovasi' => 0, 'kepemimpinan' => 0, 'membimbing' => 0, 'keputusan' => 0],
                ],
                'nilai_perusahaan' => [
                    'atasan' => ['kerja_sama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                    'self' => ['kerja_sama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                    'selevel' => ['kerja_sama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                    'staff' => ['kerja_sama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                ],
                'sasaran_kinerja' => [
                    'atasan' => ['goal' => 0, 'error' => 0, 'dokumen' => 0, 'inisiatif' => 0, 'pola_pikir' => 0, 'keputusan' => 0],
                    'self' => ['goal' => 0, 'error' => 0, 'dokumen' => 0, 'inisiatif' => 0, 'pola_pikir' => 0, 'keputusan' => 0],
                    'selevel' => ['goal' => 0, 'error' => 0, 'dokumen' => 0, 'inisiatif' => 0, 'pola_pikir' => 0, 'keputusan' => 0],
                    'staff' => ['goal' => 0, 'error' => 0, 'dokumen' => 0, 'inisiatif' => 0, 'pola_pikir' => 0, 'keputusan' => 0],
                ]
            ];
            foreach ($dtNpp as $dk => $dn) {
                if ($dn->relasi_penilai == 'atasan') {
                    $countBossEvaluator += 1;

                    $sumResponVal['kepemimpinan']['atasan']['perencanaan'] += $dn->kpmn_perencanaan;
                    $sumResponVal['kepemimpinan']['atasan']['pengawasan'] += $dn->kpmn_pengawasan;
                    $sumResponVal['kepemimpinan']['atasan']['inovasi'] += $dn->kpmn_inovasi;
                    $sumResponVal['kepemimpinan']['atasan']['kepemimpinan'] += $dn->kpmn_kepemimpinan;
                    $sumResponVal['kepemimpinan']['atasan']['membimbing'] += $dn->kpmn_membimbing;
                    $sumResponVal['kepemimpinan']['atasan']['keputusan'] += $dn->kpmn_keputusan;

                    $sumResponVal['nilai_perusahaan']['atasan']['kerja_sama'] += $dn->nnpp_kerjasama;
                    $sumResponVal['nilai_perusahaan']['atasan']['komunikasi'] += $dn->nnpp_komunikasi;
                    $sumResponVal['nilai_perusahaan']['atasan']['disiplin'] += $dn->nnpp_disiplin;
                    $sumResponVal['nilai_perusahaan']['atasan']['dedikasi'] += $dn->nnpp_dedikasi;
                    $sumResponVal['nilai_perusahaan']['atasan']['etika'] += $dn->nnpp_etika;

                    $sumResponVal['sasaran_kinerja']['atasan']['goal'] += $dn->skpp_goal;
                    $sumResponVal['sasaran_kinerja']['atasan']['error'] += $dn->skpp_error;
                    $sumResponVal['sasaran_kinerja']['atasan']['dokumen'] += $dn->skpp_dokumen;
                    $sumResponVal['sasaran_kinerja']['atasan']['inisiatif'] += $dn->skpp_inisiatif;
                    $sumResponVal['sasaran_kinerja']['atasan']['pola_pikir'] += $dn->skpp_pola_pikir;
                } else if ($dn->relasi_penilai == 'self') {
                    $countSelfEvaluator += 1;

                    $sumResponVal['kepemimpinan']['self']['perencanaan'] += $dn->kpmn_perencanaan;
                    $sumResponVal['kepemimpinan']['self']['pengawasan'] += $dn->kpmn_pengawasan;
                    $sumResponVal['kepemimpinan']['self']['inovasi'] += $dn->kpmn_inovasi;
                    $sumResponVal['kepemimpinan']['self']['kepemimpinan'] += $dn->kpmn_kepemimpinan;
                    $sumResponVal['kepemimpinan']['self']['membimbing'] += $dn->kpmn_membimbing;
                    $sumResponVal['kepemimpinan']['self']['keputusan'] += $dn->kpmn_keputusan;

                    $sumResponVal['nilai_perusahaan']['self']['kerja_sama'] += $dn->nnpp_kerjasama;
                    $sumResponVal['nilai_perusahaan']['self']['komunikasi'] += $dn->nnpp_komunikasi;
                    $sumResponVal['nilai_perusahaan']['self']['disiplin'] += $dn->nnpp_disiplin;
                    $sumResponVal['nilai_perusahaan']['self']['dedikasi'] += $dn->nnpp_dedikasi;
                    $sumResponVal['nilai_perusahaan']['self']['etika'] += $dn->nnpp_etika;

                    $sumResponVal['sasaran_kinerja']['self']['goal'] += $dn->skpp_goal;
                    $sumResponVal['sasaran_kinerja']['self']['error'] += $dn->skpp_error;
                    $sumResponVal['sasaran_kinerja']['self']['dokumen'] += $dn->skpp_dokumen;
                    $sumResponVal['sasaran_kinerja']['self']['inisiatif'] += $dn->skpp_inisiatif;
                    $sumResponVal['sasaran_kinerja']['self']['pola_pikir'] += $dn->skpp_pola_pikir;
                } else if ($dn->relasi_penilai == 'selevel') {
                    $countLevelEvaluator += 1;

                    $sumResponVal['kepemimpinan']['selevel']['perencanaan'] += $dn->kpmn_perencanaan;
                    $sumResponVal['kepemimpinan']['selevel']['pengawasan'] += $dn->kpmn_pengawasan;
                    $sumResponVal['kepemimpinan']['selevel']['inovasi'] += $dn->kpmn_inovasi;
                    $sumResponVal['kepemimpinan']['selevel']['kepemimpinan'] += $dn->kpmn_kepemimpinan;
                    $sumResponVal['kepemimpinan']['selevel']['membimbing'] += $dn->kpmn_membimbing;
                    $sumResponVal['kepemimpinan']['selevel']['keputusan'] += $dn->kpmn_keputusan;

                    $sumResponVal['nilai_perusahaan']['selevel']['kerja_sama'] += $dn->nnpp_kerjasama;
                    $sumResponVal['nilai_perusahaan']['selevel']['komunikasi'] += $dn->nnpp_komunikasi;
                    $sumResponVal['nilai_perusahaan']['selevel']['disiplin'] += $dn->nnpp_disiplin;
                    $sumResponVal['nilai_perusahaan']['selevel']['dedikasi'] += $dn->nnpp_dedikasi;
                    $sumResponVal['nilai_perusahaan']['selevel']['etika'] += $dn->nnpp_etika;

                    $sumResponVal['sasaran_kinerja']['selevel']['goal'] += $dn->skpp_goal;
                    $sumResponVal['sasaran_kinerja']['selevel']['error'] += $dn->skpp_error;
                    $sumResponVal['sasaran_kinerja']['selevel']['dokumen'] += $dn->skpp_dokumen;
                    $sumResponVal['sasaran_kinerja']['selevel']['inisiatif'] += $dn->skpp_inisiatif;
                    $sumResponVal['sasaran_kinerja']['selevel']['pola_pikir'] += $dn->skpp_pola_pikir;
                } else if ($dn->relasi_penilai == 'staff') {
                    $countStaffEvaluator += 1;

                    $sumResponVal['kepemimpinan']['staff']['perencanaan'] += $dn->kpmn_perencanaan;
                    $sumResponVal['kepemimpinan']['staff']['pengawasan'] += $dn->kpmn_pengawasan;
                    $sumResponVal['kepemimpinan']['staff']['inovasi'] += $dn->kpmn_inovasi;
                    $sumResponVal['kepemimpinan']['staff']['kepemimpinan'] += $dn->kpmn_kepemimpinan;
                    $sumResponVal['kepemimpinan']['staff']['membimbing'] += $dn->kpmn_membimbing;
                    $sumResponVal['kepemimpinan']['staff']['keputusan'] += $dn->kpmn_keputusan;

                    $sumResponVal['nilai_perusahaan']['staff']['kerja_sama'] += $dn->nnpp_kerjasama;
                    $sumResponVal['nilai_perusahaan']['staff']['komunikasi'] += $dn->nnpp_komunikasi;
                    $sumResponVal['nilai_perusahaan']['staff']['disiplin'] += $dn->nnpp_disiplin;
                    $sumResponVal['nilai_perusahaan']['staff']['dedikasi'] += $dn->nnpp_dedikasi;
                    $sumResponVal['nilai_perusahaan']['staff']['etika'] += $dn->nnpp_etika;

                    $sumResponVal['sasaran_kinerja']['staff']['goal'] += $dn->skpp_goal;
                    $sumResponVal['sasaran_kinerja']['staff']['error'] += $dn->skpp_error;
                    $sumResponVal['sasaran_kinerja']['staff']['dokumen'] += $dn->skpp_dokumen;
                    $sumResponVal['sasaran_kinerja']['staff']['inisiatif'] += $dn->skpp_inisiatif;
                    $sumResponVal['sasaran_kinerja']['staff']['pola_pikir'] += $dn->skpp_pola_pikir;
                }
            }
            $data = [
                // 'npp_penilai' => $dn->npp_penilai,
                // 'nama_penilai' => $dn->nama_penilai,
                // 'level_penilai' => $dn->level_penilai,
                // 'relasi_penilai' => $dn->relasi_penilai,

                'npp_dinilai' => $dn->npp_dinilai,
                'nama_dinilai' => $dn->nama_dinilai,
                'level_dinilai' => $dn->level_dinilai,
                // 'relasi_dinilai' => $dn->relasi_dinilai,

                'jumlah_penilai_atasan' => $countBossEvaluator,
                'jumlah_penilai_staff' => $countStaffEvaluator,
                'jumlah_penilai_selevel' => $countLevelEvaluator,
                'jumlah_penilai_self' => $countSelfEvaluator,

                'kepemimpinan_perencanaan' => [
                    'atasan' => $sumResponVal['kepemimpinan']['atasan']['perencanaan'],
                    'self' => $sumResponVal['kepemimpinan']['self']['perencanaan'],
                    'selevel' => $sumResponVal['kepemimpinan']['selevel']['perencanaan'],
                    'staff' => $sumResponVal['kepemimpinan']['staff']['perencanaan'],
                ],

                'kepemimpinan_pengawasan' => [
                    'atasan' => $sumResponVal['kepemimpinan']['atasan']['pengawasan'],
                    'self' => $sumResponVal['kepemimpinan']['self']['pengawasan'],
                    'selevel' => $sumResponVal['kepemimpinan']['selevel']['pengawasan'],
                    'staff' => $sumResponVal['kepemimpinan']['staff']['pengawasan'],
                ],

                'kepemimpinan_inovasi' => [
                    'atasan' => $sumResponVal['kepemimpinan']['atasan']['inovasi'],
                    'self' => $sumResponVal['kepemimpinan']['self']['inovasi'],
                    'selevel' => $sumResponVal['kepemimpinan']['selevel']['inovasi'],
                    'staff' => $sumResponVal['kepemimpinan']['staff']['inovasi'],
                ],

                'kepemimpinan_kepemimpinan' => [
                    'atasan' => $sumResponVal['kepemimpinan']['atasan']['kepemimpinan'],
                    'self' => $sumResponVal['kepemimpinan']['self']['kepemimpinan'],
                    'selevel' => $sumResponVal['kepemimpinan']['selevel']['kepemimpinan'],
                    'staff' => $sumResponVal['kepemimpinan']['staff']['kepemimpinan'],
                ],

                'kepemimpinan_membimbing' => [
                    'atasan' => $sumResponVal['kepemimpinan']['atasan']['membimbing'],
                    'self' => $sumResponVal['kepemimpinan']['self']['membimbing'],
                    'selevel' => $sumResponVal['kepemimpinan']['selevel']['membimbing'],
                    'staff' => $sumResponVal['kepemimpinan']['staff']['membimbing'],
                ],

                'kepemimpinan_keputusan' => [
                    'atasan' => $sumResponVal['kepemimpinan']['atasan']['keputusan'],
                    'self' => $sumResponVal['kepemimpinan']['self']['keputusan'],
                    'selevel' => $sumResponVal['kepemimpinan']['selevel']['keputusan'],
                    'staff' => $sumResponVal['kepemimpinan']['staff']['keputusan'],
                ],


                'nilai_perusahaan_kerja_sama' => [
                    'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['kerja_sama'],
                    'self' => $sumResponVal['nilai_perusahaan']['self']['kerja_sama'],
                    'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['kerja_sama'],
                    'staff' => $sumResponVal['nilai_perusahaan']['staff']['kerja_sama'],
                ],

                'nilai_perusahaan_komunikasi' => [
                    'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['komunikasi'],
                    'self' => $sumResponVal['nilai_perusahaan']['self']['komunikasi'],
                    'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['komunikasi'],
                    'staff' => $sumResponVal['nilai_perusahaan']['staff']['komunikasi'],
                ],

                'nilai_perusahaan_disiplin' => [
                    'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['disiplin'],
                    'self' => $sumResponVal['nilai_perusahaan']['self']['disiplin'],
                    'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['disiplin'],
                    'staff' => $sumResponVal['nilai_perusahaan']['staff']['disiplin'],
                ],

                'nilai_perusahaan_dedikasi' => [
                    'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['dedikasi'],
                    'self' => $sumResponVal['nilai_perusahaan']['self']['dedikasi'],
                    'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['dedikasi'],
                    'staff' => $sumResponVal['nilai_perusahaan']['staff']['dedikasi'],
                ],

                'nilai_perusahaan_etika' => [
                    'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['etika'],
                    'self' => $sumResponVal['nilai_perusahaan']['self']['etika'],
                    'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['etika'],
                    'staff' => $sumResponVal['nilai_perusahaan']['staff']['etika'],
                ],


                'sasaran_kinerja_goal' => [
                    'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['goal'],
                    'self' => $sumResponVal['sasaran_kinerja']['self']['goal'],
                    'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['goal'],
                    'staff' => $sumResponVal['sasaran_kinerja']['staff']['goal'],
                ],

                'sasaran_kinerja_error' => [
                    'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['error'],
                    'self' => $sumResponVal['sasaran_kinerja']['self']['error'],
                    'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['error'],
                    'staff' => $sumResponVal['sasaran_kinerja']['staff']['error'],
                ],

                'sasaran_kinerja_dokumen' => [
                    'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['dokumen'],
                    'self' => $sumResponVal['sasaran_kinerja']['self']['dokumen'],
                    'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['dokumen'],
                    'staff' => $sumResponVal['sasaran_kinerja']['staff']['dokumen'],
                ],

                'sasaran_kinerja_inisiatif' => [
                    'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['inisiatif'],
                    'self' => $sumResponVal['sasaran_kinerja']['self']['inisiatif'],
                    'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['inisiatif'],
                    'staff' => $sumResponVal['sasaran_kinerja']['staff']['inisiatif'],
                ],

                'sasaran_kinerja_pola_pikir' => [
                    'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['pola_pikir'],
                    'self' => $sumResponVal['sasaran_kinerja']['self']['pola_pikir'],
                    'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['pola_pikir'],
                    'staff' => $sumResponVal['sasaran_kinerja']['staff']['pola_pikir'],
                ],
            ];
            return $data;
        });

        // dd($groupData[12375], $map[12375]);
    }

    public function import()
    {
        Excel::import(new DP3Import, 'form_respon_DP3.xlsx');
    }
}
