<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Imports\DP3Import;
use App\Models\Employee;
use App\Models\PercentRelation;
use App\Models\ScoreResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ResponseController extends Controller
{
    public function index()
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
        // dd($groupByNpp[11070]);
        $data = [
            'title' => 'Data Respon', 'page' => 'Halaman Respon', 'sheet' => [],
            'response' => $responseMap
        ];
        return view('hc.form_respon.index', $data);
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

        $countSelfEvaluator = 0;
        $countStaffEvaluator = 0;
        $countBossEvaluator = 0;
        $countLevelEvaluator = 0;

        $sumCalc = [
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

        foreach ($groupByNpp[$npp] as $vEmp) {
            // staff menilai atasan
            if ($vEmp->relasi_penilai == "staff" && $vEmp->relasi_dinilai == "atasan") {

                // jumlah staff yang menilai
                $countStaffEvaluator += 1;

                // jumlah score dari seluruh staff
                // kepemimpinan
                $sumCalc['kepemimpinan']['perencanaan']['staff'] += $vEmp->kpmn_perencanaan;
                $sumCalc['kepemimpinan']['pengawasan']['staff'] += $vEmp->kpmn_pengawasan;
                $sumCalc['kepemimpinan']['inovasi']['staff'] += $vEmp->kpmn_inovasi;
                $sumCalc['kepemimpinan']['kepemimpinan']['staff'] += $vEmp->kpmn_kepemimpinan;
                $sumCalc['kepemimpinan']['membimbing']['staff'] += $vEmp->kpmn_membimbing;
                $sumCalc['kepemimpinan']['keputusan']['staff'] += $vEmp->kpmn_keputusan;

                // nilai2 perusahaan
                $sumCalc['nilai_perusahaan']['kerjasama']['staff'] += $vEmp->nnpp_kerjasama;
                $sumCalc['nilai_perusahaan']['komunikasi']['staff'] += $vEmp->nnpp_komunikasi;
                $sumCalc['nilai_perusahaan']['disiplin']['staff'] += $vEmp->nnpp_disiplin;
                $sumCalc['nilai_perusahaan']['dedikasi']['staff'] += $vEmp->nnpp_dedikasi;
                $sumCalc['nilai_perusahaan']['etika']['staff'] += $vEmp->nnpp_etika;

                // sasaran kinerja
                $sumCalc['sasaran_kerja']['goal']['staff'] += $vEmp->skpp_goal;
                $sumCalc['sasaran_kerja']['error']['staff'] += $vEmp->skpp_error;
                $sumCalc['sasaran_kerja']['dokumen']['staff'] += $vEmp->skpp_dokumen;
                $sumCalc['sasaran_kerja']['inisiatif']['staff'] += $vEmp->skpp_inisiatif;
                $sumCalc['sasaran_kerja']['pola_pikir']['staff'] += $vEmp->skpp_pola_pikir;
            }
            // self menilai self
            else if ($vEmp->relasi_penilai == "self" && $vEmp->relasi_dinilai == "self") {
                // jumlah self yang menilai
                $countSelfEvaluator += 1;

                // jumlah score dari seluruh self
                // kepemimpinan
                $sumCalc['kepemimpinan']['perencanaan']['self'] += $vEmp->kpmn_perencanaan;
                $sumCalc['kepemimpinan']['pengawasan']['self'] += $vEmp->kpmn_pengawasan;
                $sumCalc['kepemimpinan']['inovasi']['self'] += $vEmp->kpmn_inovasi;
                $sumCalc['kepemimpinan']['kepemimpinan']['self'] += $vEmp->kpmn_kepemimpinan;
                $sumCalc['kepemimpinan']['membimbing']['self'] += $vEmp->kpmn_membimbing;
                $sumCalc['kepemimpinan']['keputusan']['self'] += $vEmp->kpmn_keputusan;

                // nilai2 perusahaan
                $sumCalc['nilai_perusahaan']['kerjasama']['self'] += $vEmp->nnpp_kerjasama;
                $sumCalc['nilai_perusahaan']['komunikasi']['self'] += $vEmp->nnpp_komunikasi;
                $sumCalc['nilai_perusahaan']['disiplin']['self'] += $vEmp->nnpp_disiplin;
                $sumCalc['nilai_perusahaan']['dedikasi']['self'] += $vEmp->nnpp_dedikasi;
                $sumCalc['nilai_perusahaan']['etika']['self'] += $vEmp->nnpp_etika;

                // sasaran kinerja
                $sumCalc['sasaran_kerja']['goal']['self'] += $vEmp->skpp_goal;
                $sumCalc['sasaran_kerja']['error']['self'] += $vEmp->skpp_error;
                $sumCalc['sasaran_kerja']['dokumen']['self'] += $vEmp->skpp_dokumen;
                $sumCalc['sasaran_kerja']['inisiatif']['self'] += $vEmp->skpp_inisiatif;
                $sumCalc['sasaran_kerja']['pola_pikir']['self'] += $vEmp->skpp_pola_pikir;
            }
            // atasan menilai staff
            else if ($vEmp->relasi_penilai == "atasan" && $vEmp->relasi_dinilai == "staff") {
                // jumlah atasan yang menilai
                $countBossEvaluator += 1;

                // jumlah score dari seluruh atasan
                // kepemimpinan
                $sumCalc['kepemimpinan']['perencanaan']['atasan'] += $vEmp->kpmn_perencanaan;
                $sumCalc['kepemimpinan']['pengawasan']['atasan'] += $vEmp->kpmn_pengawasan;
                $sumCalc['kepemimpinan']['inovasi']['atasan'] += $vEmp->kpmn_inovasi;
                $sumCalc['kepemimpinan']['kepemimpinan']['atasan'] += $vEmp->kpmn_kepemimpinan;
                $sumCalc['kepemimpinan']['membimbing']['atasan'] += $vEmp->kpmn_membimbing;
                $sumCalc['kepemimpinan']['keputusan']['atasan'] += $vEmp->kpmn_keputusan;

                // nilai2 perusahaan
                $sumCalc['nilai_perusahaan']['kerjasama']['atasan'] += $vEmp->nnpp_kerjasama;
                $sumCalc['nilai_perusahaan']['komunikasi']['atasan'] += $vEmp->nnpp_komunikasi;
                $sumCalc['nilai_perusahaan']['disiplin']['atasan'] += $vEmp->nnpp_disiplin;
                $sumCalc['nilai_perusahaan']['dedikasi']['atasan'] += $vEmp->nnpp_dedikasi;
                $sumCalc['nilai_perusahaan']['etika']['atasan'] += $vEmp->nnpp_etika;

                // sasaran kinerja
                $sumCalc['sasaran_kerja']['goal']['atasan'] += $vEmp->skpp_goal;
                $sumCalc['sasaran_kerja']['error']['atasan'] += $vEmp->skpp_error;
                $sumCalc['sasaran_kerja']['dokumen']['atasan'] += $vEmp->skpp_dokumen;
                $sumCalc['sasaran_kerja']['inisiatif']['atasan'] += $vEmp->skpp_inisiatif;
                $sumCalc['sasaran_kerja']['pola_pikir']['atasan'] += $vEmp->skpp_pola_pikir;
            }
            // selevel menilai selevel
            else if ($vEmp->relasi_penilai == "selevel" && $vEmp->relasi_dinilai == "selevel") {
                // jumlah rekan kerja yang menilai
                $countLevelEvaluator += 1;

                // jumlah score dari seluruh rekan kerja
                // kepemimpinan
                $sumCalc['kepemimpinan']['perencanaan']['selevel'] += $vEmp->kpmn_perencanaan;
                $sumCalc['kepemimpinan']['pengawasan']['selevel'] += $vEmp->kpmn_pengawasan;
                $sumCalc['kepemimpinan']['inovasi']['selevel'] += $vEmp->kpmn_inovasi;
                $sumCalc['kepemimpinan']['kepemimpinan']['selevel'] += $vEmp->kpmn_kepemimpinan;
                $sumCalc['kepemimpinan']['membimbing']['selevel'] += $vEmp->kpmn_membimbing;
                $sumCalc['kepemimpinan']['keputusan']['selevel'] += $vEmp->kpmn_keputusan;

                // nilai2 perusahaan
                $sumCalc['nilai_perusahaan']['kerjasama']['selevel'] += $vEmp->nnpp_kerjasama;
                $sumCalc['nilai_perusahaan']['komunikasi']['selevel'] += $vEmp->nnpp_komunikasi;
                $sumCalc['nilai_perusahaan']['disiplin']['selevel'] += $vEmp->nnpp_disiplin;
                $sumCalc['nilai_perusahaan']['dedikasi']['selevel'] += $vEmp->nnpp_dedikasi;
                $sumCalc['nilai_perusahaan']['etika']['selevel'] += $vEmp->nnpp_etika;

                // sasaran kinerja
                $sumCalc['sasaran_kerja']['goal']['selevel'] += $vEmp->skpp_goal;
                $sumCalc['sasaran_kerja']['error']['selevel'] += $vEmp->skpp_error;
                $sumCalc['sasaran_kerja']['dokumen']['selevel'] += $vEmp->skpp_dokumen;
                $sumCalc['sasaran_kerja']['inisiatif']['selevel'] += $vEmp->skpp_inisiatif;
                $sumCalc['sasaran_kerja']['pola_pikir']['selevel'] += $vEmp->skpp_pola_pikir;
            }
        }

        $indctrSelfLvlVal = PercentRelation::where(['status' => 'self', 'level' => $groupByNpp[$npp][0]->level_dinilai])->first()->nilai;
        $indctrBossLvlVal = PercentRelation::where(['status' => 'atasan', 'level' => $groupByNpp[$npp][0]->level_dinilai])->first()->nilai;
        $indctrLevelLvlVal = PercentRelation::where(['status' => 'rekan kerja', 'level' => $groupByNpp[$npp][0]->level_dinilai])->first()->nilai;
        $indctrStaffLvlVal = PercentRelation::where(['status' => 'staff', 'level' => $groupByNpp[$npp][0]->level_dinilai])->first()->nilai;

        if ($countBossEvaluator == 0) {
            $countBossEvaluator = 1;
        }
        if ($countSelfEvaluator == 0) {
            $countSelfEvaluator = 1;
        }
        if ($countLevelEvaluator == 0) {
            $countLevelEvaluator = 1;
        }
        if ($countStaffEvaluator == 0) {
            $countStaffEvaluator = 1;
        }


        foreach ($groupByNpp[$npp] as $vEmp2) {

            // level 1
            if ($vEmp2->level_dinilai == 'I A' || $vEmp2->level_dinilai == 'I B'  || $vEmp2->level_dinilai == 'I C' || $vEmp2->level_dinilai == 'I A NS' || $vEmp2->level_dinilai == 'IA NS') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 5%) * 100
                $kPcnSelf = (($sumCalc['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.4) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 60%) * 100
                $kPcnBoss = (($sumCalc['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.4) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 20%) * 100
                $kPcnLevel = (($sumCalc['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.4) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 40%) * 15%) * 100
                $kPcnStaff = (($sumCalc['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.4) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 5%) * 100
                $npKsmSelf = (($sumCalc['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 60%) * 100
                $npKsmBoss = (($sumCalc['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $npKsmLevel = (($sumCalc['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 15%) * 100
                $npKsmStaff = (($sumCalc['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 5%) * 100
                $skGolSelf = (($sumCalc['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 60%) * 100
                $skGolBoss = (($sumCalc['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 20%) * 100
                $skGolLevel = (($sumCalc['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 15%) * 100
                $skGolStaff = (($sumCalc['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
            }
            // level 2
            elseif ($vEmp2->level_dinilai == 'II' || $vEmp2->level_dinilai == 'II NS') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 5%) * 100
                $kPcnSelf = (($sumCalc['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.35) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 60%) * 100
                $kPcnBoss = (($sumCalc['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.35) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 20%) * 100
                $kPcnLevel = (($sumCalc['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.35) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 35%) * 15%) * 100
                $kPcnStaff = (($sumCalc['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.35) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 5%) * 100
                $npKsmSelf = (($sumCalc['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 60%) * 100
                $npKsmBoss = (($sumCalc['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $npKsmLevel = (($sumCalc['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 15%) * 100
                $npKsmStaff = (($sumCalc['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 5%) * 100
                $skGolSelf = (($sumCalc['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.40) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 60%) * 100
                $skGolBoss = (($sumCalc['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.40) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 20%) * 100
                $skGolLevel = (($sumCalc['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.40) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.40) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.40) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.40) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.40) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 40%) * 15%) * 100
                $skGolStaff = (($sumCalc['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.40) * $indctrStaffLvlVal) * 100;
            }
            // level 3
            elseif ($vEmp2->level_dinilai == 'III' || $vEmp2->level_dinilai == 'III NS') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 5%) * 100
                $kPcnSelf = (($sumCalc['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.30) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 60%) * 100
                $kPcnBoss = (($sumCalc['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.30) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 20%) * 100
                $kPcnLevel = (($sumCalc['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.30) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 30%) * 15%) * 100
                $kPcnStaff = (($sumCalc['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.30) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 5%) * 100
                $npKsmSelf = (($sumCalc['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.25) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 60%) * 100
                $npKsmBoss = (($sumCalc['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.25) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 20%) * 100
                $npKsmLevel = (($sumCalc['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.25) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 25%) * 15%) * 100
                $npKsmStaff = (($sumCalc['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.25) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 5%) * 100
                $skGolSelf = (($sumCalc['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.45) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 60%) * 100
                $skGolBoss = (($sumCalc['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.45) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 20%) * 100
                $skGolLevel = (($sumCalc['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.45) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 45%) * 15%) * 100
                $skGolStaff = (($sumCalc['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.45) * $indctrStaffLvlVal) * 100;
            }
            // level 4 A
            elseif ($vEmp2->level_dinilai == 'IV A') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 5%) * 100
                $kPcnSelf = (($sumCalc['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kPgnSelf = (($sumCalc['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kIvsSelf = (($sumCalc['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kKpmSelf = (($sumCalc['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kMbgSelf = (($sumCalc['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;
                $kKptSelf = (($sumCalc['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.10) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 60%) * 100
                $kPcnBoss = (($sumCalc['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.10) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 20%) * 100
                $kPcnLevel = (($sumCalc['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.10) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 10%) * 15%) * 100
                $kPcnStaff = (($sumCalc['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.10) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 5%) * 100
                $npKsmSelf = (($sumCalc['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.30) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 60%) * 100
                $npKsmBoss = (($sumCalc['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.30) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 20%) * 100
                $npKsmLevel = (($sumCalc['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.30) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 30%) * 15%) * 100
                $npKsmStaff = (($sumCalc['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.30) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 5%) * 100
                $skGolSelf = (($sumCalc['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.60) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 60%) * 100
                $skGolBoss = (($sumCalc['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.60) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 20%) * 100
                $skGolLevel = (($sumCalc['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.60) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 60%) * 15%) * 100
                $skGolStaff = (($sumCalc['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.60) * $indctrStaffLvlVal) * 100;
            }
            // level 4 B & 5
            elseif ($vEmp2->level_dinilai == 'IV B' || $vEmp2->level_dinilai == 'V') {
                // kepemimpinan
                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 5%) * 100
                $kPcnSelf = (($sumCalc['kepemimpinan']['perencanaan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kPgnSelf = (($sumCalc['kepemimpinan']['pengawasan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kIvsSelf = (($sumCalc['kepemimpinan']['inovasi']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kKpmSelf = (($sumCalc['kepemimpinan']['kepemimpinan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kMbgSelf = (($sumCalc['kepemimpinan']['membimbing']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;
                $kKptSelf = (($sumCalc['kepemimpinan']['keputusan']['self'] / $countSelfEvaluator / 30 * 0.50) * 0.05) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 60%) * 100
                $kPcnBoss = (($sumCalc['kepemimpinan']['perencanaan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kPgnBoss = (($sumCalc['kepemimpinan']['pengawasan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kIvsBoss = (($sumCalc['kepemimpinan']['inovasi']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kKpmBoss = (($sumCalc['kepemimpinan']['kepemimpinan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kMbgBoss = (($sumCalc['kepemimpinan']['membimbing']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;
                $kKptBoss = (($sumCalc['kepemimpinan']['keputusan']['atasan'] / $countBossEvaluator / 30 * 0.50) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 20%) * 100
                $kPcnLevel = (($sumCalc['kepemimpinan']['perencanaan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kPgnLevel = (($sumCalc['kepemimpinan']['pengawasan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kIvsLevel = (($sumCalc['kepemimpinan']['inovasi']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kKpmLevel = (($sumCalc['kepemimpinan']['kepemimpinan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kMbgLevel = (($sumCalc['kepemimpinan']['membimbing']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;
                $kKptLevel = (($sumCalc['kepemimpinan']['keputusan']['selevel'] / $countLevelEvaluator / 30 * 0.50) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 30 * 50%) * 15%) * 100
                $kPcnStaff = (($sumCalc['kepemimpinan']['perencanaan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kPgnStaff = (($sumCalc['kepemimpinan']['pengawasan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kIvsStaff = (($sumCalc['kepemimpinan']['inovasi']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kKpmStaff = (($sumCalc['kepemimpinan']['kepemimpinan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kMbgStaff = (($sumCalc['kepemimpinan']['membimbing']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;
                $kKptStaff = (($sumCalc['kepemimpinan']['keputusan']['staff'] / $countStaffEvaluator / 30 * 0.50) * $indctrStaffLvlVal) * 100;

                // nilai2 perusahaan
                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 10%) * 100
                $npKsmSelf = (($sumCalc['nilai_perusahaan']['kerjasama']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npKmkSelf = (($sumCalc['nilai_perusahaan']['komunikasi']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npDpnSelf = (($sumCalc['nilai_perusahaan']['disiplin']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npDdkSelf = (($sumCalc['nilai_perusahaan']['dedikasi']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;
                $npEtkSelf = (($sumCalc['nilai_perusahaan']['etika']['self'] / $countSelfEvaluator / 25 * 0.35) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 65%) * 100
                $npKsmBoss = (($sumCalc['nilai_perusahaan']['kerjasama']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npKmkBoss = (($sumCalc['nilai_perusahaan']['komunikasi']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npDpnBoss = (($sumCalc['nilai_perusahaan']['disiplin']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npDdkBoss = (($sumCalc['nilai_perusahaan']['dedikasi']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;
                $npEtkBoss = (($sumCalc['nilai_perusahaan']['etika']['atasan'] / $countBossEvaluator / 25 * 0.35) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 25%) * 100
                $npKsmLevel = (($sumCalc['nilai_perusahaan']['kerjasama']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npKmkLevel = (($sumCalc['nilai_perusahaan']['komunikasi']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npDpnLevel = (($sumCalc['nilai_perusahaan']['disiplin']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npDdkLevel = (($sumCalc['nilai_perusahaan']['dedikasi']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;
                $npEtkLevel = (($sumCalc['nilai_perusahaan']['etika']['selevel'] / $countLevelEvaluator / 25 * 0.35) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 35%) * 0%) * 100
                $npKsmStaff = (($sumCalc['nilai_perusahaan']['kerjasama']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npKmkStaff = (($sumCalc['nilai_perusahaan']['komunikasi']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npDpnStaff = (($sumCalc['nilai_perusahaan']['disiplin']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npDdkStaff = (($sumCalc['nilai_perusahaan']['dedikasi']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;
                $npEtkStaff = (($sumCalc['nilai_perusahaan']['etika']['staff'] / $countStaffEvaluator / 25 * 0.35) * $indctrStaffLvlVal) * 100;

                // sasaran kinerja
                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 10%) * 100
                $skGolSelf = (($sumCalc['sasaran_kerja']['goal']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skErrSelf = (($sumCalc['sasaran_kerja']['error']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skDocSelf = (($sumCalc['sasaran_kerja']['dokumen']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skIniSelf = (($sumCalc['sasaran_kerja']['inisiatif']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;
                $skPprSelf = (($sumCalc['sasaran_kerja']['pola_pikir']['self'] / $countSelfEvaluator / 25 * 0.65) * $indctrSelfLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 60%) * 100
                $skGolBoss = (($sumCalc['sasaran_kerja']['goal']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skErrBoss = (($sumCalc['sasaran_kerja']['error']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skDocBoss = (($sumCalc['sasaran_kerja']['dokumen']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skIniBoss = (($sumCalc['sasaran_kerja']['inisiatif']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;
                $skPprBoss = (($sumCalc['sasaran_kerja']['pola_pikir']['atasan'] / $countBossEvaluator / 25 * 0.65) * $indctrBossLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 20%) * 100
                $skGolLevel = (($sumCalc['sasaran_kerja']['goal']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skErrLevel = (($sumCalc['sasaran_kerja']['error']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skDocLevel = (($sumCalc['sasaran_kerja']['dokumen']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skIniLevel = (($sumCalc['sasaran_kerja']['inisiatif']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;
                $skPprLevel = (($sumCalc['sasaran_kerja']['pola_pikir']['selevel'] / $countLevelEvaluator / 25 * 0.65) * $indctrLevelLvlVal) * 100;

                // ((jumlah score penilai / jumlah penilai * 25 * 65%) * 15%) * 100
                $skGolStaff = (($sumCalc['sasaran_kerja']['goal']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skErrStaff = (($sumCalc['sasaran_kerja']['error']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skDocStaff = (($sumCalc['sasaran_kerja']['dokumen']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skIniStaff = (($sumCalc['sasaran_kerja']['inisiatif']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
                $skPprStaff = (($sumCalc['sasaran_kerja']['pola_pikir']['staff'] / $countStaffEvaluator / 25 * 0.65) * $indctrStaffLvlVal) * 100;
            }
        }



        $calcArr = [
            'kepemimpinan' => [
                'perencanaan' => ['self' => $kPcnSelf, 'atasan' =>  $kPcnBoss, 'selevel' => $kPcnLevel, 'staff' => $kPcnStaff],

                'pengawasan' => ['self' => $kPgnSelf, 'atasan' => $kPgnBoss, 'selevel' => $kPgnLevel, 'staff' => $kPgnStaff],

                'inovasi' => ['self' => $kIvsSelf, 'atasan' => $kIvsBoss, 'selevel' => $kIvsLevel, 'staff' => $kIvsStaff],

                'kepemimpinan' => ['self' => $kKpmSelf, 'atasan' => $kKpmBoss, 'selevel' => $kKpmLevel, 'staff' => $kKpmStaff],

                'membimbing' => ['self' => $kMbgSelf, 'atasan' => $kMbgBoss, 'selevel' => $kMbgLevel, 'staff' => $kMbgStaff],

                'keputusan' => ['self' => $kKptSelf, 'atasan' =>  $kKptBoss, 'selevel' =>  $kKptLevel, 'staff' =>  $kKptStaff],
            ],

            'nilai_perusahaan' => [
                'kerjasama' => ['self' => $npKsmSelf, 'atasan' => $npKsmBoss, 'selevel' => $npKsmLevel, 'staff' => $npKsmStaff],

                'komunikasi' => ['self' => $npKmkSelf, 'atasan' => $npKmkBoss, 'selevel' => $npKmkLevel, 'staff' => $npKmkStaff],

                'disiplin' => ['self' => $npDpnSelf, 'atasan' => $npDpnBoss, 'selevel' => $npDpnLevel, 'staff' => $npDpnStaff],

                'dedikasi' => ['self' => $npDdkSelf, 'atasan' => $npDdkBoss, 'selevel' => $npDdkLevel, 'staff' => $npDdkStaff],

                'etika' => ['self' => $npEtkSelf, 'atasan' => $npEtkBoss, 'selevel' => $npEtkLevel, 'staff' => $npEtkStaff],
            ],

            'sasaran_kerja' => [
                'goal' => ['self' => $skGolSelf, 'atasan' => $skGolBoss, 'selevel' => $skGolLevel, 'staff' => $skGolStaff],

                'error' => ['self' => $skErrSelf, 'atasan' => $skErrBoss, 'selevel' => $skErrLevel, 'staff' => $skErrStaff],

                'dokumen' => ['self' => $skDocSelf, 'atasan' => $skDocBoss, 'selevel' => $skDocLevel, 'staff' => $skDocStaff],

                'inisiatif' => ['self' => $skIniSelf, 'atasan' => $skIniBoss, 'selevel' => $skIniLevel, 'staff' => $skIniStaff],

                'pola_pikir' => ['self' => $skPprSelf, 'atasan' => $skPprBoss, 'selevel' => $skPprLevel, 'staff' => $skPprStaff],
            ],
        ];

        $scoreDp3 = collect($calcArr['kepemimpinan'])->sum('self') +
            collect($calcArr['kepemimpinan'])->sum('atasan') +
            collect($calcArr['kepemimpinan'])->sum('selevel') +
            collect($calcArr['kepemimpinan'])->sum('staff') +
            (collect($calcArr['nilai_perusahaan'])->sum('self') +
                collect($calcArr['nilai_perusahaan'])->sum('atasan') +
                collect($calcArr['nilai_perusahaan'])->sum('selevel') +
                collect($calcArr['nilai_perusahaan'])->sum('staff')) +
            (collect($calcArr['sasaran_kerja'])->sum('self') +
                collect($calcArr['sasaran_kerja'])->sum('atasan') +
                collect($calcArr['sasaran_kerja'])->sum('selevel') +
                collect($calcArr['sasaran_kerja'])->sum('staff'));

        $criteria = '';
        $criteriaValue = 0;

        if ($scoreDp3 > 95) {
            $criteria = 'Sangat Baik';
            $criteriaValue = 4;
        } elseif ($scoreDp3 > 85 && $scoreDp3 <= 95) {
            $criteria = 'Baik';
            $criteriaValue = 3;
        } elseif ($scoreDp3 > 65 && $scoreDp3 <= 85) {
            $criteria = 'Cukup';
            $criteriaValue = 2;
        } elseif ($scoreDp3 > 50 && $scoreDp3 <= 65) {
            $criteria = 'Kurang';
            $criteriaValue = 1;
        } else {
            $criteria = 'Sangat Kurang';
        }



        // dd(collect($groupByNpp[$npp]));
        $data = [
            'title' => 'Detail Data Respon', 'page' => 'Detail Respon', 'sheet' => [],
            'response' => collect($groupByNpp[$npp]),
            'employee' => $employee,
            'npp' => $npp,
            'result' => $calcArr,
            'scoreDp3' => $scoreDp3,
            'criteria' => $criteria,
            'criteriaValue' => $criteriaValue,
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

    public function import()
    {
        Excel::import(new DP3Import, 'form_respon_DP3.xlsx');
        return redirect()->route('response')->with('success', 'berhasil mengimpor data penilaian');
    }
}
