<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Imports\DP3Import;
use App\Models\Dp3Calculated;
use App\Models\Employee;
use App\Models\PercentRelation;
use App\Models\ScoreResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ResponseController extends Controller
{
    public function index()
    {
        $dp3Calculated = Dp3Calculated::all();

        $responseScore = DB::table('tbl_respon_skor as t1')
            ->select('t1.*')
            ->join(DB::raw('(SELECT npp_penilai,npp_dinilai, MAX(id) id FROM tbl_respon_skor GROUP BY npp_penilai,npp_dinilai) as t2'), 't1.id', '=', 't2.id')
            ->where('deleted_at', null)
            ->get();

        $groupByNpp = $responseScore->reduce(function ($group, $currentData) {
            $group[$currentData->npp_dinilai][] = $currentData;
            return $group;
        });

        $responseMap = (object)collect($groupByNpp)->map(function ($dtNpp) {
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
                    'atasan' => ['kerjasama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                    'self' => ['kerjasama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                    'selevel' => ['kerjasama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
                    'staff' => ['kerjasama' => 0, 'komunikasi' => 0, 'disiplin' => 0, 'dedikasi' => 0, 'etika' => 0],
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

                    $sumResponVal['nilai_perusahaan']['atasan']['kerjasama'] += $dn->nnpp_kerjasama;
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

                    $sumResponVal['nilai_perusahaan']['self']['kerjasama'] += $dn->nnpp_kerjasama;
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

                    $sumResponVal['nilai_perusahaan']['selevel']['kerjasama'] += $dn->nnpp_kerjasama;
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

                    $sumResponVal['nilai_perusahaan']['staff']['kerjasama'] += $dn->nnpp_kerjasama;
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
            // $countStaffEvaluator = $countStaffEvaluator === 0 ? 1 : $countStaffEvaluator;
            // echo $dn->npp_dinilai . ' - ' . $countStaffEvaluator . '<br>';


            $response = collect([
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

                'kepemimpinan' => [
                    'perencanaan' => [
                        'self' => $sumResponVal['kepemimpinan']['self']['perencanaan'],
                        'atasan' => $sumResponVal['kepemimpinan']['atasan']['perencanaan'],
                        'selevel' => $sumResponVal['kepemimpinan']['selevel']['perencanaan'],
                        'staff' => $sumResponVal['kepemimpinan']['staff']['perencanaan'],
                    ],

                    'pengawasan' => [
                        'self' => $sumResponVal['kepemimpinan']['self']['pengawasan'],
                        'atasan' => $sumResponVal['kepemimpinan']['atasan']['pengawasan'],
                        'selevel' => $sumResponVal['kepemimpinan']['selevel']['pengawasan'],
                        'staff' => $sumResponVal['kepemimpinan']['staff']['pengawasan'],
                    ],

                    'inovasi' => [
                        'self' => $sumResponVal['kepemimpinan']['self']['inovasi'],
                        'atasan' => $sumResponVal['kepemimpinan']['atasan']['inovasi'],
                        'selevel' => $sumResponVal['kepemimpinan']['selevel']['inovasi'],
                        'staff' => $sumResponVal['kepemimpinan']['staff']['inovasi'],
                    ],

                    'kepemimpinan' => [
                        'self' => $sumResponVal['kepemimpinan']['self']['kepemimpinan'],
                        'atasan' => $sumResponVal['kepemimpinan']['atasan']['kepemimpinan'],
                        'selevel' => $sumResponVal['kepemimpinan']['selevel']['kepemimpinan'],
                        'staff' => $sumResponVal['kepemimpinan']['staff']['kepemimpinan'],
                    ],

                    'membimbing' => [
                        'self' => $sumResponVal['kepemimpinan']['self']['membimbing'],
                        'atasan' => $sumResponVal['kepemimpinan']['atasan']['membimbing'],
                        'selevel' => $sumResponVal['kepemimpinan']['selevel']['membimbing'],
                        'staff' => $sumResponVal['kepemimpinan']['staff']['membimbing'],
                    ],

                    'keputusan' => [
                        'self' => $sumResponVal['kepemimpinan']['self']['keputusan'],
                        'atasan' => $sumResponVal['kepemimpinan']['atasan']['keputusan'],
                        'selevel' => $sumResponVal['kepemimpinan']['selevel']['keputusan'],
                        'staff' => $sumResponVal['kepemimpinan']['staff']['keputusan'],
                    ],
                ],

                'nilai_perusahaan' => [
                    'kerjasama' => [
                        'self' => $sumResponVal['nilai_perusahaan']['self']['kerjasama'],
                        'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['kerjasama'],
                        'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['kerjasama'],
                        'staff' => $sumResponVal['nilai_perusahaan']['staff']['kerjasama'],
                    ],

                    'komunikasi' => [
                        'self' => $sumResponVal['nilai_perusahaan']['self']['komunikasi'],
                        'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['komunikasi'],
                        'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['komunikasi'],
                        'staff' => $sumResponVal['nilai_perusahaan']['staff']['komunikasi'],
                    ],

                    'disiplin' => [
                        'self' => $sumResponVal['nilai_perusahaan']['self']['disiplin'],
                        'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['disiplin'],
                        'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['disiplin'],
                        'staff' => $sumResponVal['nilai_perusahaan']['staff']['disiplin'],
                    ],

                    'dedikasi' => [
                        'self' => $sumResponVal['nilai_perusahaan']['self']['dedikasi'],
                        'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['dedikasi'],
                        'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['dedikasi'],
                        'staff' => $sumResponVal['nilai_perusahaan']['staff']['dedikasi'],
                    ],

                    'etika' => [
                        'self' => $sumResponVal['nilai_perusahaan']['self']['etika'],
                        'atasan' => $sumResponVal['nilai_perusahaan']['atasan']['etika'],
                        'selevel' => $sumResponVal['nilai_perusahaan']['selevel']['etika'],
                        'staff' => $sumResponVal['nilai_perusahaan']['staff']['etika'],
                    ],
                ],

                'sasaran_kerja' => [
                    'goal' => [
                        'self' => $sumResponVal['sasaran_kinerja']['self']['goal'],
                        'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['goal'],
                        'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['goal'],
                        'staff' => $sumResponVal['sasaran_kinerja']['staff']['goal'],
                    ],

                    'error' => [
                        'self' => $sumResponVal['sasaran_kinerja']['self']['error'],
                        'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['error'],
                        'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['error'],
                        'staff' => $sumResponVal['sasaran_kinerja']['staff']['error'],
                    ],

                    'dokumen' => [
                        'self' => $sumResponVal['sasaran_kinerja']['self']['dokumen'],
                        'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['dokumen'],
                        'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['dokumen'],
                        'staff' => $sumResponVal['sasaran_kinerja']['staff']['dokumen'],
                    ],

                    'inisiatif' => [
                        'self' => $sumResponVal['sasaran_kinerja']['self']['inisiatif'],
                        'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['inisiatif'],
                        'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['inisiatif'],
                        'staff' => $sumResponVal['sasaran_kinerja']['staff']['inisiatif'],
                    ],

                    'pola_pikir' => [
                        'self' => $sumResponVal['sasaran_kinerja']['self']['pola_pikir'],
                        'atasan' => $sumResponVal['sasaran_kinerja']['atasan']['pola_pikir'],
                        'selevel' => $sumResponVal['sasaran_kinerja']['selevel']['pola_pikir'],
                        'staff' => $sumResponVal['sasaran_kinerja']['staff']['pola_pikir'],
                    ],
                ],
            ]);
            return $response;
        });

        $data = [
            'title' => 'Data Respon', 'page' => 'Data DP3',
            'responseMap' => $responseMap,
            'dp3Calculated' => $dp3Calculated
        ];

        return view('hc.form_respon.index', $data);
    }

    public function calculate_dp3()
    {
        $responScore = DB::table('tbl_respon_skor as t1')
            ->select('t1.*')
            ->join(DB::raw('(SELECT npp_penilai,npp_dinilai, MAX(id) id FROM tbl_respon_skor GROUP BY npp_penilai,npp_dinilai) as t2'), 't1.id', '=', 't2.id')
            ->where('deleted_at', null)
            ->get();

        $groupByNpp = $responScore->reduce(function ($group, $currentData) {
            $group[$currentData->npp_dinilai][] = $currentData;
            return $group;
        });

        // perhitungan jumlah orang yg menilai
        foreach ($groupByNpp as $kEmp => $emp) {

            $sumCalc[$kEmp] = [
                'jumlah_penilai' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                'nama_dinilai' => $emp[0]->nama_dinilai,
                'level_dinilai' => $emp[0]->level_dinilai,

                'kepemimpinan' => [
                    'perencanaan' => ['self' => 0, 'atasan' =>  0, 'selevel' => 0, 'staff' => 0],

                    'pengawasan' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'inovasi' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'kepemimpinan' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'membimbing' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'keputusan' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],
                ],

                'nilai_perusahaan' => [
                    'kerjasama' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'komunikasi' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'disiplin' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'dedikasi' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'etika' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],
                ],

                'sasaran_kerja' => [
                    'goal' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'error' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'dokumen' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'inisiatif' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],

                    'pola_pikir' => ['self' => 0, 'atasan' => 0, 'selevel' => 0, 'staff' => 0],
                ],

            ];

            foreach ($emp as $vEmp) {
                // staff menilai atasan
                if ($vEmp->relasi_penilai == "staff" && $vEmp->relasi_dinilai == "atasan") {

                    // jumlah staff yang menilai
                    $sumCalc[$vEmp->npp_dinilai]['jumlah_penilai']['staff'] += 1;

                    // jumlah score dari seluruh staff
                    // kepemimpinan
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['perencanaan']['staff'] += $vEmp->kpmn_perencanaan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['pengawasan']['staff'] += $vEmp->kpmn_pengawasan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['inovasi']['staff'] += $vEmp->kpmn_inovasi;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['kepemimpinan']['staff'] += $vEmp->kpmn_kepemimpinan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['membimbing']['staff'] += $vEmp->kpmn_membimbing;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['keputusan']['staff'] += $vEmp->kpmn_keputusan;

                    // nilai2 perusahaan
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['kerjasama']['staff'] += $vEmp->nnpp_kerjasama;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['komunikasi']['staff'] += $vEmp->nnpp_komunikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['disiplin']['staff'] += $vEmp->nnpp_disiplin;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['dedikasi']['staff'] += $vEmp->nnpp_dedikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['etika']['staff'] += $vEmp->nnpp_etika;

                    // sasaran kinerja
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['goal']['staff'] += $vEmp->skpp_goal;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['error']['staff'] += $vEmp->skpp_error;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['dokumen']['staff'] += $vEmp->skpp_dokumen;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['inisiatif']['staff'] += $vEmp->skpp_inisiatif;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['pola_pikir']['staff'] += $vEmp->skpp_pola_pikir;
                }
                // self menilai self
                else if ($vEmp->relasi_penilai == "self" && $vEmp->relasi_dinilai == "self") {
                    // jumlah self yang menilai
                    $sumCalc[$vEmp->npp_dinilai]['jumlah_penilai']['self']  += 1;

                    // jumlah score dari seluruh self
                    // kepemimpinan
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['perencanaan']['self'] += $vEmp->kpmn_perencanaan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['pengawasan']['self'] += $vEmp->kpmn_pengawasan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['inovasi']['self'] += $vEmp->kpmn_inovasi;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['kepemimpinan']['self'] += $vEmp->kpmn_kepemimpinan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['membimbing']['self'] += $vEmp->kpmn_membimbing;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['keputusan']['self'] += $vEmp->kpmn_keputusan;

                    // nilai2 perusahaan
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['kerjasama']['self'] += $vEmp->nnpp_kerjasama;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['komunikasi']['self'] += $vEmp->nnpp_komunikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['disiplin']['self'] += $vEmp->nnpp_disiplin;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['dedikasi']['self'] += $vEmp->nnpp_dedikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['etika']['self'] += $vEmp->nnpp_etika;

                    // sasaran kinerja
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['goal']['self'] += $vEmp->skpp_goal;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['error']['self'] += $vEmp->skpp_error;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['dokumen']['self'] += $vEmp->skpp_dokumen;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['inisiatif']['self'] += $vEmp->skpp_inisiatif;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['pola_pikir']['self'] += $vEmp->skpp_pola_pikir;
                }
                // atasan menilai staff
                else if ($vEmp->relasi_penilai == "atasan" && $vEmp->relasi_dinilai == "staff") {
                    // jumlah atasan yang menilai
                    $sumCalc[$vEmp->npp_dinilai]['jumlah_penilai']['atasan'] += 1;

                    // jumlah score dari seluruh atasan
                    // kepemimpinan
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['perencanaan']['atasan'] += $vEmp->kpmn_perencanaan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['pengawasan']['atasan'] += $vEmp->kpmn_pengawasan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['inovasi']['atasan'] += $vEmp->kpmn_inovasi;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['kepemimpinan']['atasan'] += $vEmp->kpmn_kepemimpinan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['membimbing']['atasan'] += $vEmp->kpmn_membimbing;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['keputusan']['atasan'] += $vEmp->kpmn_keputusan;

                    // nilai2 perusahaan
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['kerjasama']['atasan'] += $vEmp->nnpp_kerjasama;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['komunikasi']['atasan'] += $vEmp->nnpp_komunikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['disiplin']['atasan'] += $vEmp->nnpp_disiplin;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['dedikasi']['atasan'] += $vEmp->nnpp_dedikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['etika']['atasan'] += $vEmp->nnpp_etika;

                    // sasaran kinerja
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['goal']['atasan'] += $vEmp->skpp_goal;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['error']['atasan'] += $vEmp->skpp_error;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['dokumen']['atasan'] += $vEmp->skpp_dokumen;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['inisiatif']['atasan'] += $vEmp->skpp_inisiatif;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['pola_pikir']['atasan'] += $vEmp->skpp_pola_pikir;
                }
                // selevel menilai selevel
                else if ($vEmp->relasi_penilai == "selevel" && $vEmp->relasi_dinilai == "selevel") {
                    // jumlah rekan kerja yang menilai
                    $sumCalc[$vEmp->npp_dinilai]['jumlah_penilai']['selevel']  += 1;

                    // jumlah score dari seluruh rekan kerja
                    // kepemimpinan
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['perencanaan']['selevel'] += $vEmp->kpmn_perencanaan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['pengawasan']['selevel'] += $vEmp->kpmn_pengawasan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['inovasi']['selevel'] += $vEmp->kpmn_inovasi;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['kepemimpinan']['selevel'] += $vEmp->kpmn_kepemimpinan;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['membimbing']['selevel'] += $vEmp->kpmn_membimbing;
                    $sumCalc[$vEmp->npp_dinilai]['kepemimpinan']['keputusan']['selevel'] += $vEmp->kpmn_keputusan;

                    // nilai2 perusahaan
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['kerjasama']['selevel'] += $vEmp->nnpp_kerjasama;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['komunikasi']['selevel'] += $vEmp->nnpp_komunikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['disiplin']['selevel'] += $vEmp->nnpp_disiplin;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['dedikasi']['selevel'] += $vEmp->nnpp_dedikasi;
                    $sumCalc[$vEmp->npp_dinilai]['nilai_perusahaan']['etika']['selevel'] += $vEmp->nnpp_etika;

                    // sasaran kinerja
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['goal']['selevel'] += $vEmp->skpp_goal;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['error']['selevel'] += $vEmp->skpp_error;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['dokumen']['selevel'] += $vEmp->skpp_dokumen;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['inisiatif']['selevel'] += $vEmp->skpp_inisiatif;
                    $sumCalc[$vEmp->npp_dinilai]['sasaran_kerja']['pola_pikir']['selevel'] += $vEmp->skpp_pola_pikir;
                }

                $sumCalc[$vEmp->npp_dinilai]['indikator_nilai_level']['self'] = PercentRelation::where(['status' => 'self', 'level' => $vEmp->level_dinilai])->first()->nilai ?? 0;
                $sumCalc[$vEmp->npp_dinilai]['indikator_nilai_level']['atasan'] = PercentRelation::where(['status' => 'atasan', 'level' => $vEmp->level_dinilai])->first()->nilai ?? 0;
                $sumCalc[$vEmp->npp_dinilai]['indikator_nilai_level']['selevel'] = PercentRelation::where(['status' => 'rekan kerja', 'level' => $vEmp->level_dinilai])->first()->nilai ?? 0;
                $sumCalc[$vEmp->npp_dinilai]['indikator_nilai_level']['staff'] = PercentRelation::where(['status' => 'staff', 'level' => $vEmp->level_dinilai])->first()->nilai ?? 0;
            }
        }

        // perhitungan dp3
        foreach ($sumCalc as $kCalc => $calcDp3) {

            $countSelfEvaluator = $calcDp3['jumlah_penilai']['self'] == 0 ? 1 : $calcDp3['jumlah_penilai']['self'];
            $countBossEvaluator = $calcDp3['jumlah_penilai']['atasan'] == 0 ? 1 : $calcDp3['jumlah_penilai']['atasan'];
            $countLevelEvaluator = $calcDp3['jumlah_penilai']['selevel'] == 0 ? 1 : $calcDp3['jumlah_penilai']['selevel'];
            $countStaffEvaluator = $calcDp3['jumlah_penilai']['staff'] == 0 ? 1 : $calcDp3['jumlah_penilai']['staff'];

            $indctrSelfLvlVal = $sumCalc[$kCalc]['indikator_nilai_level']['self'];
            $indctrBossLvlVal = $sumCalc[$kCalc]['indikator_nilai_level']['atasan'];
            $indctrLevelLvlVal = $sumCalc[$kCalc]['indikator_nilai_level']['selevel'];
            $indctrStaffLvlVal = $sumCalc[$kCalc]['indikator_nilai_level']['staff'];

            // level 1
            if ($calcDp3['level_dinilai'] == 'I A' || $calcDp3['level_dinilai'] == 'I B'  || $calcDp3['level_dinilai'] == 'I C' || $calcDp3['level_dinilai'] == 'I A NS' || $calcDp3['level_dinilai'] == 'IA NS') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 5%) * 100
                $kPcnSelf = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 60%) * 100
                $kPcnBoss = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 20%) * 100
                $kPcnLevel = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 15%) * 100
                $kPcnStaff = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 5%) * 100
                $npKsmSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 60%) * 100
                $npKsmBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $npKsmLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 15%) * 100
                $npKsmStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 5%) * 100
                $skGolSelf = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc[$kCalc]['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 60%) * 100
                $skGolBoss = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc[$kCalc]['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 20%) * 100
                $skGolLevel = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc[$kCalc]['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 15%) * 100
                $skGolStaff = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc[$kCalc]['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
            }
            // level 2
            elseif ($calcDp3['level_dinilai'] == 'II' || $calcDp3['level_dinilai'] == 'II NS') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 5%) * 100
                $kPcnSelf = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 60%) * 100
                $kPcnBoss = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 20%) * 100
                $kPcnLevel = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 15%) * 100
                $kPcnStaff = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 5%) * 100
                $npKsmSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 60%) * 100
                $npKsmBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $npKsmLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 15%) * 100
                $npKsmStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 5%) * 100
                $skGolSelf = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc[$kCalc]['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 60%) * 100
                $skGolBoss = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc[$kCalc]['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $skGolLevel = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc[$kCalc]['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 15%) * 100
                $skGolStaff = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc[$kCalc]['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
            }
            // level 3
            elseif ($calcDp3['level_dinilai'] == 'III' || $calcDp3['level_dinilai'] == 'III NS') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 5%) * 100
                $kPcnSelf = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 60%) * 100
                $kPcnBoss = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 20%) * 100
                $kPcnLevel = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 15%) * 100
                $kPcnStaff = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 5%) * 100
                $npKsmSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 60%) * 100
                $npKsmBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $npKsmLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 15%) * 100
                $npKsmStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 5%) * 100
                $skGolSelf = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc[$kCalc]['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 60%) * 100
                $skGolBoss = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc[$kCalc]['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 20%) * 100
                $skGolLevel = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc[$kCalc]['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 15%) * 100
                $skGolStaff = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc[$kCalc]['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
            }
            // level 4 A
            elseif ($calcDp3['level_dinilai'] == 'IV A') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 5%) * 100
                $kPcnSelf = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 60%) * 100
                $kPcnBoss = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 20%) * 100
                $kPcnLevel = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 15%) * 100
                $kPcnStaff = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 5%) * 100
                $npKsmSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 60%) * 100
                $npKsmBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 20%) * 100
                $npKsmLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 15%) * 100
                $npKsmStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 5%) * 100
                $skGolSelf = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc[$kCalc]['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 60%) * 100
                $skGolBoss = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc[$kCalc]['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 20%) * 100
                $skGolLevel = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc[$kCalc]['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 15%) * 100
                $skGolStaff = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc[$kCalc]['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
            }
            // level 4 B & 5
            elseif ($calcDp3['level_dinilai'] == 'IV B' || $calcDp3['level_dinilai'] == 'V') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 5%) * 100
                $kPcnSelf = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kPgnSelf = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kIvsSelf = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kKpmSelf = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kMbgSelf = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kKptSelf = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 60%) * 100
                $kPcnBoss = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 20%) * 100
                $kPcnLevel = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 15%) * 100
                $kPcnStaff = (($sumCalc[$kCalc]['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc[$kCalc]['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc[$kCalc]['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc[$kCalc]['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc[$kCalc]['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc[$kCalc]['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 10%) * 100
                $npKsmSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 65%) * 100
                $npKsmBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 25%) * 100
                $npKsmLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 0%) * 100
                $npKsmStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc[$kCalc]['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 10%) * 100
                $skGolSelf = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc[$kCalc]['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 60%) * 100
                $skGolBoss = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc[$kCalc]['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 20%) * 100
                $skGolLevel = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc[$kCalc]['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 15%) * 100
                $skGolStaff = (($sumCalc[$kCalc]['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc[$kCalc]['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc[$kCalc]['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc[$kCalc]['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc[$kCalc]['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
            }

            $dp3Score = $kPcnSelf + $kPcnBoss + $kPcnLevel + $kPcnStaff
                + $kPgnSelf + $kPgnBoss + $kPgnLevel + $kPgnStaff
                + $kIvsSelf + $kIvsBoss + $kIvsLevel + $kIvsStaff
                + $kKpmSelf + $kKpmBoss + $kKpmLevel + $kKpmStaff
                + $kMbgSelf + $kMbgBoss + $kMbgLevel + $kMbgStaff
                + $kKptSelf + $kKptBoss + $kKptLevel + $kKptStaff

                + $npKsmSelf + $npKsmBoss + $npKsmLevel + $npKsmStaff
                + $npKmkSelf + $npKmkBoss + $npKmkLevel + $npKmkStaff
                + $npDpnSelf + $npDpnBoss + $npDpnLevel + $npDpnStaff
                + $npDdkSelf + $npDdkBoss + $npDdkLevel + $npDdkStaff
                + $npEtkSelf + $npEtkBoss + $npEtkLevel + $npEtkStaff

                + $skGolSelf + $skGolBoss + $skGolLevel + $skGolStaff
                + $skErrSelf + $skErrBoss + $skErrLevel + $skErrStaff
                + $skDocSelf + $skDocBoss + $skDocLevel + $skDocStaff
                + $skIniSelf + $skIniBoss + $skIniLevel + $skIniStaff
                + $skPprSelf + $skPprBoss + $skPprLevel + $skPprStaff;

            $dp3Criteria = '';
            $dp3CriteriaValue = 0;
            if ($dp3Score > 95) {
                $dp3Criteria = 'Sangat Baik';
                $dp3CriteriaValue = 4;
            } elseif ($dp3Score > 85 && $dp3Score <= 95) {
                $dp3Criteria = 'Baik';
                $dp3CriteriaValue = 3;
            } elseif ($dp3Score > 65 && $dp3Score <= 85) {
                $dp3Criteria = 'Cukup';
                $dp3CriteriaValue = 2;
            } elseif ($dp3Score > 50 && $dp3Score <= 65) {
                $dp3Criteria = 'Kurang';
                $dp3CriteriaValue = 1;
            } else {
                $dp3Criteria = 'Sangat Kurang';
            }

            Dp3Calculated::updateOrCreate(['npp_dinilai' => $kCalc], [
                'npp_dinilai' => $kCalc,
                'nama_dinilai' => $calcDp3['nama_dinilai'],
                'level_dinilai' => $calcDp3['level_dinilai'],

                // kepemimpinan
                'kpmn_perencanaan_self' => $kPcnSelf,
                'kpmn_perencanaan_atasan' => $kPcnBoss,
                'kpmn_perencanaan_selevel' => $kPcnLevel,
                'kpmn_perencanaan_staff' => $kPcnStaff,

                'kpmn_pengawasan_self' => $kPgnSelf,
                'kpmn_pengawasan_atasan' => $kPgnBoss,
                'kpmn_pengawasan_selevel' => $kPgnLevel,
                'kpmn_pengawasan_staff' => $kPgnStaff,

                'kpmn_inovasi_self' => $kIvsSelf,
                'kpmn_inovasi_atasan' => $kIvsBoss,
                'kpmn_inovasi_selevel' => $kIvsLevel,
                'kpmn_inovasi_staff' => $kIvsStaff,

                'kpmn_kepemimpinan_self' => $kKpmSelf,
                'kpmn_kepemimpinan_atasan' => $kKpmBoss,
                'kpmn_kepemimpinan_selevel' => $kKpmLevel,
                'kpmn_kepemimpinan_staff' => $kKpmStaff,

                'kpmn_membimbing_self' => $kMbgSelf,
                'kpmn_membimbing_atasan' => $kMbgBoss,
                'kpmn_membimbing_selevel' => $kMbgLevel,
                'kpmn_membimbing_staff' => $kMbgStaff,

                'kpmn_keputusan_self' => $kKptSelf,
                'kpmn_keputusan_atasan' => $kKptBoss,
                'kpmn_keputusan_selevel' => $kKptLevel,
                'kpmn_keputusan_staff' => $kKptStaff,


                // nilai perusahaan
                'nnpp_kerjasama_self' => $npKsmSelf,
                'nnpp_kerjasama_atasan' => $npKsmBoss,
                'nnpp_kerjasama_selevel' => $npKsmLevel,
                'nnpp_kerjasama_staff' => $npKsmStaff,

                'nnpp_komunikasi_self' => $npKmkSelf,
                'nnpp_komunikasi_atasan' => $npKmkBoss,
                'nnpp_komunikasi_selevel' => $npKmkLevel,
                'nnpp_komunikasi_staff' => $npKmkStaff,

                'nnpp_disiplin_self' => $npDpnSelf,
                'nnpp_disiplin_atasan' => $npDpnBoss,
                'nnpp_disiplin_selevel' => $npDpnLevel,
                'nnpp_disiplin_staff' => $npDpnStaff,

                'nnpp_dedikasi_self' => $npDdkSelf,
                'nnpp_dedikasi_atasan' => $npDdkBoss,
                'nnpp_dedikasi_selevel' => $npDdkLevel,
                'nnpp_dedikasi_staff' => $npDdkStaff,

                'nnpp_etika_self' => $npEtkSelf,
                'nnpp_etika_atasan' => $npEtkBoss,
                'nnpp_etika_selevel' => $npEtkLevel,
                'nnpp_etika_staff' => $npEtkStaff,


                // sasaran_kerja
                'skpp_goal_self' => $skGolSelf,
                'skpp_goal_atasan' => $skGolBoss,
                'skpp_goal_selevel' => $skGolLevel,
                'skpp_goal_staff' => $skGolStaff,

                'skpp_error_self' => $skErrSelf,
                'skpp_error_atasan' => $skErrBoss,
                'skpp_error_selevel' => $skErrLevel,
                'skpp_error_staff' => $skErrStaff,

                'skpp_dokumen_self' => $skDocSelf,
                'skpp_dokumen_atasan' => $skDocBoss,
                'skpp_dokumen_selevel' => $skDocLevel,
                'skpp_dokumen_staff' => $skDocStaff,

                'skpp_inisiatif_self' => $skIniSelf,
                'skpp_inisiatif_atasan' => $skIniBoss,
                'skpp_inisiatif_selevel' => $skIniLevel,
                'skpp_inisiatif_staff' => $skIniStaff,

                'skpp_pola_pikir_self' => $skPprSelf,
                'skpp_pola_pikir_atasan' => $skPprBoss,
                'skpp_pola_pikir_selevel' => $skPprLevel,
                'skpp_pola_pikir_staff' => $skPprStaff,


                'total_nilai' => $dp3Score,
                'kriteria' => $dp3Criteria,
                'nilai_dp3' => $dp3CriteriaValue,
            ]);
            // $kpmn =
            //     $kPcnSelf + $kPcnBoss + $kPcnLevel + $kPcnStaff +
            //     $kPgnSelf + $kPgnBoss + $kPgnLevel + $kPgnStaff +
            //     $kIvsSelf + $kIvsBoss + $kIvsLevel + $kIvsStaff +
            //     $kKpmSelf + $kKpmBoss + $kKpmLevel + $kKpmStaff +
            //     $kMbgSelf + $kMbgBoss + $kMbgLevel + $kMbgStaff +
            //     $kKptSelf + $kKptBoss + $kKptLevel + $kKptStaff;

            // $nnpp =
            //     $npKsmSelf + $npKsmBoss + $npKsmLevel + $npKsmStaff +
            //     $npKmkSelf + $npKmkBoss + $npKmkLevel + $npKmkStaff +
            //     $npDpnSelf + $npDpnBoss + $npDpnLevel + $npDpnStaff +
            //     $npDdkSelf + $npDdkBoss + $npDdkLevel + $npDdkStaff +
            //     $npEtkSelf + $npEtkBoss + $npEtkLevel + $npEtkStaff;

            // $skpp =
            //     $skGolSelf + $skGolBoss + $skGolLevel + $skGolStaff +
            //     $skErrSelf + $skErrBoss + $skErrLevel + $skErrStaff +
            //     $skDocSelf + $skDocBoss + $skDocLevel + $skDocStaff +
            //     $skIniSelf + $skIniBoss + $skIniLevel + $skIniStaff +
            //     $skPprSelf + $skPprBoss + $skPprLevel + $skPprStaff;



            // $dp3[$kCalc] = [
            //     'npp_dinilai' => $kCalc,
            //     'level_dinilai' => $calcDp3['level_dinilai'],
            //     'nama_dinilai' => $calcDp3['nama_dinilai'],
            //     'kepemimpinan' => [
            //         'perencanaan' => ['self' => $kPcnSelf, 'atasan' =>  $kPcnBoss, 'selevel' => $kPcnLevel, 'staff' => $kPcnStaff],

            //         'pengawasan' => ['self' => $kPgnSelf, 'atasan' => $kPgnBoss, 'selevel' => $kPgnLevel, 'staff' => $kPgnStaff],

            //         'inovasi' => ['self' => $kIvsSelf, 'atasan' => $kIvsBoss, 'selevel' => $kIvsLevel, 'staff' => $kIvsStaff],

            //         'kepemimpinan' => ['self' => $kKpmSelf, 'atasan' => $kKpmBoss, 'selevel' => $kKpmLevel, 'staff' => $kKpmStaff],

            //         'membimbing' => ['self' => $kMbgSelf, 'atasan' => $kMbgBoss, 'selevel' => $kMbgLevel, 'staff' => $kMbgStaff],

            //         'keputusan' => ['self' => $kKptSelf, 'atasan' =>  $kKptBoss, 'selevel' =>  $kKptLevel, 'staff' =>  $kKptStaff],
            //     ],

            //     'nilai_perusahaan' => [
            //         'kerjasama' => ['self' => $npKsmSelf, 'atasan' => $npKsmBoss, 'selevel' => $npKsmLevel, 'staff' => $npKsmStaff],

            //         'komunikasi' => ['self' => $npKmkSelf, 'atasan' => $npKmkBoss, 'selevel' => $npKmkLevel, 'staff' => $npKmkStaff],

            //         'disiplin' => ['self' => $npDpnSelf, 'atasan' => $npDpnBoss, 'selevel' => $npDpnLevel, 'staff' => $npDpnStaff],

            //         'dedikasi' => ['self' => $npDdkSelf, 'atasan' => $npDdkBoss, 'selevel' => $npDdkLevel, 'staff' => $npDdkStaff],

            //         'etika' => ['self' => $npEtkSelf, 'atasan' => $npEtkBoss, 'selevel' => $npEtkLevel, 'staff' => $npEtkStaff],
            //     ],

            //     'sasaran_kerja' => [
            //         'goal' => ['self' => $skGolSelf, 'atasan' => $skGolBoss, 'selevel' => $skGolLevel, 'staff' => $skGolStaff],

            //         'error' => ['self' => $skErrSelf, 'atasan' => $skErrBoss, 'selevel' => $skErrLevel, 'staff' => $skErrStaff],

            //         'dokumen' => ['self' => $skDocSelf, 'atasan' => $skDocBoss, 'selevel' => $skDocLevel, 'staff' => $skDocStaff],

            //         'inisiatif' => ['self' => $skIniSelf, 'atasan' => $skIniBoss, 'selevel' => $skIniLevel, 'staff' => $skIniStaff],

            //         'pola_pikir' => ['self' => $skPprSelf, 'atasan' => $skPprBoss, 'selevel' => $skPprLevel, 'staff' => $skPprStaff],
            //     ],
            //     'total_nilai' => $dp3Score,
            //     'total_nilai_kpmn' => $kpmn,
            //     'total_nilai_nnpp' => $nnpp,
            //     'total_nilai_skpp' => $skpp,
            //     'kriteria' => $dp3Criteria,
            //     'nilai_dp3' => $dp3CriteriaValue,
            // ];
        }
        // dd($groupByNpp[11079], $sumCalc[11079], $dp3[11079]);
        return redirect()->back()->with('success', 'berhasil menghitung dp3');
    }

    public function detail($npp)
    {
        $responScore = DB::table('tbl_respon_skor as t1')
            ->select('t1.*')
            ->join(DB::raw('(SELECT npp_penilai,npp_dinilai, MAX(id) id FROM tbl_respon_skor GROUP BY npp_penilai,npp_dinilai) as t2'), 't1.id', '=', 't2.id')
            ->where('deleted_at', null)
            ->get();

        $groupByNpp = $responScore->reduce(function ($group, $currentData) {
            $group[$currentData->npp_dinilai][] = $currentData;
            return $group;
        });

        $employee = Employee::all();


        $dp3Calculated = Dp3Calculated::where('npp_dinilai', $npp)->first();

        $kpmnTotalValue =
            $dp3Calculated->kpmn_perencanaan_self +
            $dp3Calculated->kpmn_perencanaan_atasan +
            $dp3Calculated->kpmn_perencanaan_selevel +
            $dp3Calculated->kpmn_perencanaan_staff +

            $dp3Calculated->kpmn_pengawasan_self +
            $dp3Calculated->kpmn_pengawasan_atasan +
            $dp3Calculated->kpmn_pengawasan_selevel +
            $dp3Calculated->kpmn_pengawasan_staff +

            $dp3Calculated->kpmn_inovasi_self +
            $dp3Calculated->kpmn_inovasi_atasan +
            $dp3Calculated->kpmn_inovasi_selevel +
            $dp3Calculated->kpmn_inovasi_staff +

            $dp3Calculated->kpmn_kepemimpinan_self +
            $dp3Calculated->kpmn_kepemimpinan_atasan +
            $dp3Calculated->kpmn_kepemimpinan_selevel +
            $dp3Calculated->kpmn_kepemimpinan_staff +

            $dp3Calculated->kpmn_membimbing_self +
            $dp3Calculated->kpmn_membimbing_atasan +
            $dp3Calculated->kpmn_membimbing_selevel +
            $dp3Calculated->kpmn_membimbing_staff +

            $dp3Calculated->kpmn_keputusan_self +
            $dp3Calculated->kpmn_keputusan_atasan +
            $dp3Calculated->kpmn_keputusan_selevel +
            $dp3Calculated->kpmn_keputusan_staff;

        $nnppTotalValue =
            $dp3Calculated->nnpp_kerjasama_self +
            $dp3Calculated->nnpp_kerjasama_atasan +
            $dp3Calculated->nnpp_kerjasama_selevel +
            $dp3Calculated->nnpp_kerjasama_staff +

            $dp3Calculated->nnpp_komunikasi_self +
            $dp3Calculated->nnpp_komunikasi_atasan +
            $dp3Calculated->nnpp_komunikasi_selevel +
            $dp3Calculated->nnpp_komunikasi_staff +

            $dp3Calculated->nnpp_disiplin_self +
            $dp3Calculated->nnpp_disiplin_atasan +
            $dp3Calculated->nnpp_disiplin_selevel +
            $dp3Calculated->nnpp_disiplin_staff +

            $dp3Calculated->nnpp_dedikasi_self +
            $dp3Calculated->nnpp_dedikasi_atasan +
            $dp3Calculated->nnpp_dedikasi_selevel +
            $dp3Calculated->nnpp_dedikasi_staff +

            $dp3Calculated->nnpp_etika_self +
            $dp3Calculated->nnpp_etika_atasan +
            $dp3Calculated->nnpp_etika_selevel +
            $dp3Calculated->nnpp_etika_staff;


        $skppTotalValue =
            $dp3Calculated->skpp_goal_self +
            $dp3Calculated->skpp_goal_atasan +
            $dp3Calculated->skpp_goal_selevel +
            $dp3Calculated->skpp_goal_staff +

            $dp3Calculated->skpp_error_self +
            $dp3Calculated->skpp_error_atasan +
            $dp3Calculated->skpp_error_selevel +
            $dp3Calculated->skpp_error_staff +

            $dp3Calculated->skpp_dokumen_self +
            $dp3Calculated->skpp_dokumen_atasan +
            $dp3Calculated->skpp_dokumen_selevel +
            $dp3Calculated->skpp_dokumen_staff +

            $dp3Calculated->skpp_inisiatif_self +
            $dp3Calculated->skpp_inisiatif_atasan +
            $dp3Calculated->skpp_inisiatif_selevel +
            $dp3Calculated->skpp_inisiatif_staff +

            $dp3Calculated->skpp_pola_pikir_self +
            $dp3Calculated->skpp_pola_pikir_atasan +
            $dp3Calculated->skpp_pola_pikir_selevel +
            $dp3Calculated->skpp_pola_pikir_staff;

        $data = [
            'title' => 'Detail Data Respon', 'page' => 'Detail Respon',
            'dp3Calculated' => $dp3Calculated,
            'response' => collect($groupByNpp[$npp]),
            'employee' => $employee,
            'npp' => $npp,
            'kpmnTotalValue' => $kpmnTotalValue,
            'nnppTotalValue' => $nnppTotalValue,
            'skppTotalValue' => $skppTotalValue,
        ];



        return view('hc.form_respon.detail', $data);
    }

    public function store_detail(Request $request)
    {
        $validated = $request->validate([
            'npp_penilai' => 'required|numeric',
            'npp_dinilai' => 'required|numeric',
            "kpmn_perencanaan" => "required|numeric",
            "kpmn_pengawasan" => "required|numeric",
            "kpmn_inovasi" => "required|numeric",
            "kpmn_kepemimpinan" => "required|numeric",
            "kpmn_membimbing" => "required|numeric",
            "kpmn_keputusan" => "required|numeric",
            "nnpp_kerjasama" => "required|numeric",
            "nnpp_komunikasi" => "required|numeric",
            "nnpp_disiplin" => "required|numeric",
            "nnpp_dedikasi" => "required|numeric",
            "nnpp_etika" => "required|numeric",
            "skpp_goal" => "required|numeric",
            "skpp_error" => "required|numeric",
            "skpp_dokumen" => "required|numeric",
            "skpp_inisiatif" => "required|numeric",
            "skpp_pola_pikir" => "required|numeric"
        ]);
        $employees = Employee::all();

        $employeeEvaluator = $employees->filter(function ($emp) use ($validated) {
            return $emp->npp == $validated['npp_penilai'];
        })->first();

        $employeeAssessed = $employees->filter(function ($emp) use ($validated) {
            return $emp->npp == $validated['npp_dinilai'];
        })->first();

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

        $selfLevel = $level[$employeeEvaluator->level] ?? false;
        $otherLevel = $level[$employeeAssessed->level] ?? false;

        if ($selfLevel > $otherLevel) {
            $assessed = 'atasan';
        } else if ($selfLevel == $otherLevel) {
            if ($employeeEvaluator->npp == $employeeAssessed->npp) {
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
            if ($employeeEvaluator->npp == $employeeAssessed->npp) {
                $evaluator = 'self';
            } else {
                $evaluator = 'selevel';
            }
        } else if ($selfLevel > $otherLevel) {
            $evaluator = 'staff';
        } else {
            $evaluator = 'tidak diketahui';
        }

        $validated['nama_penilai'] = $employeeEvaluator->nama;
        $validated['level_penilai'] = $employeeEvaluator->level;
        $validated['relasi_penilai'] = $evaluator;

        $validated['nama_dinilai'] = $employeeAssessed->nama;
        $validated['level_dinilai'] = $employeeAssessed->level;
        $validated['relasi_dinilai'] = $assessed;

        ScoreResponse::create($validated);

        return back()->with('success', 'berhasil menambah data penilaian');
    }

    public function delete_detail($id)
    {
        ScoreResponse::find($id)->delete();
        return back()->with('success', 'berhasil menghapus data penilaian');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_respon' => 'required'
        ]);

        Excel::import(new DP3Import, $request->file('file_respon'));

        return redirect()->route('response')->with('success', 'berhasil mengimpor data penilaian');
    }


    public function report($npp)
    {
        $dp3Calculated = Dp3Calculated::with('employee')->where('npp_dinilai', $npp)->first();



        $calculateFactor = [
            'kpmn_perencanaan' => $dp3Calculated->kpmn_perencanaan_self + $dp3Calculated->kpmn_perencanaan_atasan + $dp3Calculated->kpmn_perencanaan_selevel + $dp3Calculated->kpmn_perencanaan_staff,
            'kpmn_pengawasan' => $dp3Calculated->kpmn_pengawasan_self + $dp3Calculated->kpmn_pengawasan_atasan + $dp3Calculated->kpmn_pengawasan_selevel + $dp3Calculated->kpmn_pengawasan_staff,
            'kpmn_inovasi' => $dp3Calculated->kpmn_inovasi_self + $dp3Calculated->kpmn_inovasi_atasan + $dp3Calculated->kpmn_inovasi_selevel + $dp3Calculated->kpmn_inovasi_staff,
            'kpmn_kepemimpinan' => $dp3Calculated->kpmn_kepemimpinan_self + $dp3Calculated->kpmn_kepemimpinan_atasan + $dp3Calculated->kpmn_kepemimpinan_selevel + $dp3Calculated->kpmn_kepemimpinan_staff,
            'kpmn_membimbing' => $dp3Calculated->kpmn_membimbing_self + $dp3Calculated->kpmn_membimbing_atasan + $dp3Calculated->kpmn_membimbing_selevel + $dp3Calculated->kpmn_membimbing_staff,
            'kpmn_keputusan' => $dp3Calculated->kpmn_keputusan_self + $dp3Calculated->kpmn_keputusan_atasan + $dp3Calculated->kpmn_keputusan_selevel + $dp3Calculated->kpmn_keputusan_staff,

            'nnpp_kerjasama' => $dp3Calculated->nnpp_kerjasama_self + $dp3Calculated->nnpp_kerjasama_atasan + $dp3Calculated->nnpp_kerjasama_selevel + $dp3Calculated->nnpp_kerjasama_staff,
            'nnpp_komunikasi' => $dp3Calculated->nnpp_komunikasi_self + $dp3Calculated->nnpp_komunikasi_atasan + $dp3Calculated->nnpp_komunikasi_selevel + $dp3Calculated->nnpp_komunikasi_staff,
            'nnpp_disiplin' => $dp3Calculated->nnpp_disiplin_self + $dp3Calculated->nnpp_disiplin_atasan + $dp3Calculated->nnpp_disiplin_selevel + $dp3Calculated->nnpp_disiplin_staff,
            'nnpp_dedikasi' => $dp3Calculated->nnpp_dedikasi_self + $dp3Calculated->nnpp_dedikasi_atasan + $dp3Calculated->nnpp_dedikasi_selevel + $dp3Calculated->nnpp_dedikasi_staff,
            'nnpp_etika' => $dp3Calculated->nnpp_etika_self + $dp3Calculated->nnpp_etika_atasan + $dp3Calculated->nnpp_etika_selevel + $dp3Calculated->nnpp_etika_staff,

            'skpp_goal' => $dp3Calculated->skpp_goal_self + $dp3Calculated->skpp_goal_atasan + $dp3Calculated->skpp_goal_selevel + $dp3Calculated->skpp_goal_staff,
            'skpp_error' => $dp3Calculated->skpp_error_self + $dp3Calculated->skpp_error_atasan + $dp3Calculated->skpp_error_selevel + $dp3Calculated->skpp_error_staff,
            'skpp_dokumen' => $dp3Calculated->skpp_dokumen_self + $dp3Calculated->skpp_dokumen_atasan + $dp3Calculated->skpp_dokumen_selevel + $dp3Calculated->skpp_dokumen_staff,
            'skpp_inisiatif' => $dp3Calculated->skpp_inisiatif_self + $dp3Calculated->skpp_inisiatif_atasan + $dp3Calculated->skpp_inisiatif_selevel + $dp3Calculated->skpp_inisiatif_staff,
            'skpp_pola_pikir' => $dp3Calculated->skpp_pola_pikir_self + $dp3Calculated->skpp_pola_pikir_atasan + $dp3Calculated->skpp_pola_pikir_selevel + $dp3Calculated->skpp_pola_pikir_staff,
        ];

        $totalFactor = [
            'kpmn' => $calculateFactor['kpmn_perencanaan'] + $calculateFactor['kpmn_pengawasan'] + $calculateFactor['kpmn_inovasi'] + $calculateFactor['kpmn_kepemimpinan'] + $calculateFactor['kpmn_membimbing'], +$calculateFactor['kpmn_keputusan'],

            'nnpp' => $calculateFactor['nnpp_kerjasama'] + $calculateFactor['nnpp_komunikasi'] + $calculateFactor['nnpp_disiplin'] + $calculateFactor['nnpp_dedikasi'] + $calculateFactor['nnpp_etika'],

            'skpp' => $calculateFactor['skpp_goal'] + $calculateFactor['skpp_error'] + $calculateFactor['skpp_dokumen'] + $calculateFactor['skpp_inisiatif'] + $calculateFactor['skpp_pola_pikir'],

        ];

        $level = $dp3Calculated->employee->level;
        $name = $dp3Calculated->employee->nama;

        if ($level == 'IV A' || $level == 'IV B' || $level == 'V') {
            $signatureName = 'NOVITA INDAH FITRIYANI';
            $position = 'KEPALA BIDANG HC';
        } else {
            $signatureName = 'ZUL KURNIAWAN';
            $position = 'DIREKTUR OPERASIONAL';
        }
        $today = Carbon::now()->isoFormat('D MMMM Y');

        $data = [
            'dp3Calculated' => $dp3Calculated,
            'calculateFactor' => $calculateFactor,
            'totalFactor' => $totalFactor,
            'today' => $today,
            'signatureName' => $signatureName,
            'position' => $position,

        ];
        // dd($dp3Calculated);
        // return view('hc.form_respon.report', $data);
        $pdf = Pdf::loadView('hc.form_respon.report', $data);

        $pdf->setPaper('A4');

        return $pdf->download("LAPORAN HASIL PENILAIAN KINERJA $name.pdf");
    }
}
