<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Imports\DP3Import;
use App\Models\Employee;
use App\Models\ScoreResponse;
use App\Models\User;
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
            ->get();

        $groupByNpp = $responScore->reduce(function ($group, $currentData) {
            $group[$currentData->npp_dinilai][] = $currentData;
            return $group;
        });

        $employee = Employee::all();

        $data = [
            'title' => 'Detail Data Respon', 'page' => 'Detail Respon', 'sheet' => [],
            'response' => collect($groupByNpp[$npp]),
            'employee' => $employee,
            'npp' => $npp
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
            'IV B' => 4,
            'I V B' => 4,
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
