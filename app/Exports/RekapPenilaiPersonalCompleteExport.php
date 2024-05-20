<?php

namespace App\Exports;

use App\Models\FinalDp3;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Database\Eloquent\Collection;
use App\Models\RekapPenilai;
use App\Models\RelasiKaryawan;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RekapPenilaiPersonalCompleteExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    // public function __construct(FinalDp3 $final)
    // {
    //     $this->final = $final;
    // }

    public function query()
    {
        // return FinalDp3::query()->orderBy('npp_dinilai_id');
        // return FinalDp3::query()
        //     ->select()
        //     ->selectRaw('SUM(avg_dp3) as total')
        //     ->groupBy('npp_dinilai_id');
        return RelasiKaryawan::select();
        // ->whereNot('id', 1)
        // ->orWhereNot('id', 2);
    }

    public function map($row): array
    {
        // dd($row->id, $row->npp_karyawan);

        $personal = RekapPenilai::select(
            'npp_penilai',
            'strategi_perencanaan_bobot_aspek',
            'strategi_pengawasan_bobot_aspek',
            'strategi_inovasi_bobot_aspek',
            'kepemimpinan_bobot_aspek',
            'membimbing_membangun_bobot_aspek',
            'pengambilan_keputusan_bobot_aspek',
            'kerjasama_bobot_aspek',
            'komunikasi_bobot_aspek',
            'absensi_bobot_aspek',
            'integritas_bobot_aspek',
            'etika_bobot_aspek',
            'goal_kinerja_bobot_aspek',
            'error_kinerja_bobot_aspek',
            'proses_dokumen_bobot_aspek',
            'proses_inisiatif_bobot_aspek',
            'proses_polapikir_bobot_aspek',
            'sum_nilai_k_bobot_aspek',
            'sum_nilai_s_bobot_aspek',
            'sum_nilai_p_bobot_aspek',
            'sum_nilai_dp3',
            'relasi',
            'npp_penilai_dinilai'
        )
        ->where('npp_dinilai', $row->npp_karyawan)
        ->get();

        $dp3 = FinalDp3::with(['relasi_karyawan'])
            ->select('npp_dinilai_id')
            ->selectRaw('sum(avg_dp3) as total')
            ->where('npp_dinilai_id', $row->id)
            ->groupBy('npp_dinilai_id')
            ->get();

        // dd($row);
        // dd($dp3->toArray());

        $collectionDp3 = $dp3->sortBy('relasi');
        $collectionDp3->values()->all();

        $collectionPersonal = $personal->sortBy('relasi');;
        $collectionPersonal->values()->all();

        // dd(collect($collectionPersonal)->unique('npp_penilai_id'));

        $data_karyawan = collect($collectionDp3)->unique('npp_dinilai_id');
        // dd(count($data_karyawan));
        $total_raspek = 0;
        if(count($data_karyawan) > 0 ){
            $data_karyawan = Arr::flatten($data_karyawan->toArray());

            // dd(count($data_karyawan));
    
            $nama = $data_karyawan[6] ?? 'blm ada nama';
            $unit = $data_karyawan[5] ?? 'blm ada unit';
            $level = $data_karyawan[4] ?? 'blm ada level';
            $npp = $data_karyawan[3] ?? 'blm ada npp';
    
            $avg_dp3_staff = [];
            $avg_dp3_non_staff = [];
    
            $k1_staff = [];
            $k2_staff = [];
            $k3_staff = [];
            $k4_staff = [];
            $k5_staff = [];
            $k6_staff = [];
    
            $p1_staff = [];
            $p2_staff = [];
            $p3_staff = [];
            $p4_staff = [];
            $p5_staff = [];
    
            $s1_staff = [];
            $s2_staff = [];
            $s3_staff = [];
            $s4_staff = [];
            $s5_staff = [];
    
            $raspek_k_staff = [];
            $raspek_s_staff = [];
            $raspek_p_staff = [];
    
            $k1_non = [];
            $k2_non = [];
            $k3_non = [];
            $k4_non = [];
            $k5_non = [];
            $k6_non = [];
    
            $p1_non = [];
            $p2_non = [];
            $p3_non = [];
            $p4_non = [];
            $p5_non = [];
    
            $s1_non = [];
            $s2_non = [];
            $s3_non = [];
            $s4_non = [];
            $s5_non = [];
    
            $raspek_k_non = [];
            $raspek_s_non = [];
            $raspek_p_non = [];
            $divider = 0;
    
            $ambang_batas_k = [];
            $ambang_batas_s = [];
            $ambang_batas_p = [];
    
            $relasiExist = ['staff', 'self', 'rekanan', 'atasan'];
    
            // dd($collectionPersonal['relasi']);
            foreach ($collectionPersonal as $keyRelasi => $itemRelasi) {
                if (in_array($itemRelasi['relasi'], $relasiExist)) {
                    unset($relasiExist[array_search($itemRelasi['relasi'], $relasiExist)]);
                }
            }
    
            $total_missing_relasi = 0;
    
            // dd($relasiExist);
    
            $missingItem = '';
    
            foreach ($relasiExist as $missingKey => $missingItem) {
                // dd($level);
                if (
                    Str::remove(' ', $level) == 'DIREKSI' ||
                    Str::remove(' ', $level) == 'IA' ||
                    Str::remove(' ', $level) == 'IB' ||
                    Str::remove(' ', $level) == 'IC' ||
                    Str::remove(' ', $level) == 'IANS'
                ) {
                    // Bobot Dinilai Level
                    $dinilai_atasan = 0.6;
                    $dinilai_rekan = 0.2;
                    $dinilai_staff = 0.15;
                    $dinilai_self = 0.05;
                    // Bobot End Level
                    // Bobot Aspek Level
                    $kali_k = 1 * 0.4;  // Kepemimpinan
                    $kali_p = 1 * 0.25;  // Perilaku
                    $kali_s = 1 * 0.35;  // Sasaran
                    // End Bobot Aspek Level
                    if ($missingItem == 'atasan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                    } elseif ($missingItem == 'rekanan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                    } elseif ($missingItem == 'staff') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                    } elseif($missingItem == 'self'){
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                    }
                } elseif (
                    Str::remove(' ', $level) == 'II' ||
                    Str::remove(' ', $level) == 'IINS'
                ) {
                    // Bobot Dinilai Level
                    $dinilai_atasan = 0.6;
                    $dinilai_rekan = 0.2;
                    $dinilai_staff = 0.15;
                    $dinilai_self = 0.05;
                    // Bobot End Level
                    $kali_k = 1 * 0.35;
                    $kali_p = 1 * 0.25;
                    $kali_s = 1 * 0.4;
                    if ($missingItem == 'atasan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                    } elseif ($missingItem == 'rekanan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                    } elseif ($missingItem == 'staff') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                    } elseif($missingItem == 'self'){
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                    }
                } elseif (
                    Str::remove(' ', $level) == 'III' ||
                    Str::remove(' ', $level) == 'IIINS' ||
                    Str::remove(' ', $level) == 'IIII'
                ) {
                    // Bobot Dinilai Level
                    $dinilai_atasan = 0.6;
                    $dinilai_rekan = 0.2;
                    $dinilai_staff = 0.15;
                    $dinilai_self = 0.05;
                    // Bobot End Level
                    $kali_k = 1 * 0.3;
                    $kali_p = 1 * 0.25;
                    $kali_s = 1 * 0.45;
                    if ($missingItem == 'atasan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                    } elseif ($missingItem == 'rekanan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                    } elseif ($missingItem == 'staff') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                    } elseif($missingItem == 'self'){
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                    }
                } elseif (
                    Str::remove(' ', $level) == 'IV' ||
                    Str::remove(' ', $level) == 'IVA(III)' ||
                    Str::remove(' ', $level) == 'IVA(IIINS)' ||
                    Str::remove(' ', $level) == 'IVA'
                ) {
                    // Bobot Dinilai Level
                    $dinilai_atasan = 0.6;
                    $dinilai_rekan = 0.2;
                    $dinilai_staff = 0.15;
                    $dinilai_self = 0.05;
                    // Bobot End Level
                    $kali_k = 1 * 0.1;
                    $kali_p = 1 * 0.3;
                    $kali_s = 1 * 0.6;
                    if ($missingItem == 'atasan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                    } elseif ($missingItem == 'rekanan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                    } elseif ($missingItem == 'staff') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                    } elseif($missingItem == 'self'){
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                    }
                } else {
                    // Bobot Dinilai Level
                    $dinilai_atasan = 0.65;
                    $dinilai_rekan = 0.25;
                    $dinilai_staff = 0;
                    $dinilai_self = 0.1;
                    // Bobot End Level
                    $kali_k = 1 * 0;
                    $kali_p = 1 * 0.35;
                    $kali_s = 1 * 0.65;
                    if ($missingItem == 'atasan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                    } elseif ($missingItem == 'rekanan') {
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                    } elseif($missingItem == 'self'){
                        $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                    }
                }
            }
    
            foreach ($collectionPersonal as $keys => $item) {
                if ($item['relasi'] == 'staff' || $item['relasi'] == 'rekanan') {
                    $avg_dp3_staff[$keys]['sum_nilai_dp3'] = $item['sum_nilai_dp3'];
                    $k1_staff[$keys]['k1'] = $item['strategi_perencanaan_bobot_aspek'];
                    $k2_staff[$keys]['k2'] = $item['strategi_pengawasan_bobot_aspek'];
                    $k3_staff[$keys]['k3'] = $item['strategi_inovasi_bobot_aspek'];
                    $k4_staff[$keys]['k4'] = $item['kepemimpinan_bobot_aspek'];
                    $k5_staff[$keys]['k5'] = $item['membimbing_membangun_bobot_aspek'];
                    $k6_staff[$keys]['k6'] = $item['pengambilan_keputusan_bobot_aspek'];
    
                    $p1_staff[$keys]['p1'] = $item['kerjasama_bobot_aspek'];
                    $p2_staff[$keys]['p2'] = $item['komunikasi_bobot_aspek'];
                    $p3_staff[$keys]['p3'] = $item['absensi_bobot_aspek'];
                    $p4_staff[$keys]['p4'] = $item['integritas_bobot_aspek'];
                    $p5_staff[$keys]['p5'] = $item['etika_bobot_aspek'];
    
                    $s1_staff[$keys]['s1'] = $item['goal_kinerja_bobot_aspek'];
                    $s2_staff[$keys]['s2'] = $item['error_kinerja_bobot_aspek'];
                    $s3_staff[$keys]['s3'] = $item['proses_dokumen_bobot_aspek'];
                    $s4_staff[$keys]['s4'] = $item['proses_inisiatif_bobot_aspek'];
                    $s5_staff[$keys]['s5'] = $item['proses_polapikir_bobot_aspek'];
    
                    $raspek_k_staff[$keys]['raspek_k'] = round(
                        $item['strategi_perencanaan_bobot_aspek']
                            + $item['strategi_pengawasan_bobot_aspek']
                            + $item['strategi_inovasi_bobot_aspek']
                            + $item['kepemimpinan_bobot_aspek']
                            + $item['membimbing_membangun_bobot_aspek']
                            + $item['pengambilan_keputusan_bobot_aspek'],
                        2
                    );
                    $raspek_s_staff[$keys]['raspek_s'] = round(
                        $item['kerjasama_bobot_aspek']
                            + $item['komunikasi_bobot_aspek']
                            + $item['absensi_bobot_aspek']
                            + $item['integritas_bobot_aspek']
                            + $item['etika_bobot_aspek'],
                        2
                    );
                    $raspek_p_staff[$keys]['raspek_p'] = round(
                        $item['goal_kinerja_bobot_aspek']
                            + $item['error_kinerja_bobot_aspek']
                            + $item['proses_dokumen_bobot_aspek']
                            + $item['proses_inisiatif_bobot_aspek']
                            + $item['proses_polapikir_bobot_aspek'],
                        2
                    );
                } else {
                    $avg_dp3_non_staff[$keys]['sum_nilai_dp3'] = $item['sum_nilai_dp3'];
                    $k1_non[$keys]['k1'] = $item['strategi_perencanaan_bobot_aspek'];
                    $k2_non[$keys]['k2'] = $item['strategi_pengawasan_bobot_aspek'];
                    $k3_non[$keys]['k3'] = $item['strategi_inovasi_bobot_aspek'];
                    $k4_non[$keys]['k4'] = $item['kepemimpinan_bobot_aspek'];
                    $k5_non[$keys]['k5'] = $item['membimbing_membangun_bobot_aspek'];
                    $k6_non[$keys]['k6'] = $item['pengambilan_keputusan_bobot_aspek'];
    
                    $p1_non[$keys]['p1'] = $item['kerjasama_bobot_aspek'];
                    $p2_non[$keys]['p2'] = $item['komunikasi_bobot_aspek'];
                    $p3_non[$keys]['p3'] = $item['absensi_bobot_aspek'];
                    $p4_non[$keys]['p4'] = $item['integritas_bobot_aspek'];
                    $p5_non[$keys]['p5'] = $item['etika_bobot_aspek'];
    
                    $s1_non[$keys]['s1'] = $item['goal_kinerja_bobot_aspek'];
                    $s2_non[$keys]['s2'] = $item['error_kinerja_bobot_aspek'];
                    $s3_non[$keys]['s3'] = $item['proses_dokumen_bobot_aspek'];
                    $s4_non[$keys]['s4'] = $item['proses_inisiatif_bobot_aspek'];
                    $s5_non[$keys]['s5'] = $item['proses_polapikir_bobot_aspek'];
    
                    $raspek_k_non[$keys]['raspek_k'] = round(
                        $item['strategi_perencanaan_bobot_aspek']
                            + $item['strategi_pengawasan_bobot_aspek']
                            + $item['strategi_inovasi_bobot_aspek']
                            + $item['kepemimpinan_bobot_aspek']
                            + $item['membimbing_membangun_bobot_aspek']
                            + $item['pengambilan_keputusan_bobot_aspek'],
                        2
                    );
                    $raspek_s_non[$keys]['raspek_s'] = round(
                        $item['kerjasama_bobot_aspek']
                            + $item['komunikasi_bobot_aspek']
                            + $item['absensi_bobot_aspek']
                            + $item['integritas_bobot_aspek']
                            + $item['etika_bobot_aspek'],
                        2
                    );
                    $raspek_p_non[$keys]['raspek_p'] = round(
                        $item['goal_kinerja_bobot_aspek']
                            + $item['error_kinerja_bobot_aspek']
                            + $item['proses_dokumen_bobot_aspek']
                            + $item['proses_inisiatif_bobot_aspek']
                            + $item['proses_polapikir_bobot_aspek'],
                        2
                    );
                    $divider++;
                }
            }
    
            $bil1 = collect($avg_dp3_staff)->avg('sum_nilai_dp3');
            $bil2 = collect($avg_dp3_non_staff)->sum('sum_nilai_dp3');
            // $total_raspek = round(($bil1 + $bil2) * 100, 2);
            $total_raspek = round(($data_karyawan[1]) + ($total_missing_relasi * 100),2);
            // dd($total_raspek);
    
            $k1_mentah = round(collect($k1_staff)->avg('k1') + collect($k1_non)->sum('k1'),2);
            $k2_mentah = round(collect($k2_staff)->avg('k2') + collect($k2_non)->sum('k2'),2);
            $k3_mentah = round(collect($k3_staff)->avg('k3') + collect($k3_non)->sum('k3'),2);
            $k4_mentah = round(collect($k4_staff)->avg('k4') + collect($k4_non)->sum('k4'),2);
            $k5_mentah = round(collect($k5_staff)->avg('k5') + collect($k5_non)->sum('k5'),2);
            $k6_mentah = round(collect($k6_staff)->avg('k6') + collect($k6_non)->sum('k6'),2);
    
            $p1_mentah = round(collect($p1_staff)->avg('p1') + collect($p1_non)->sum('p1'),2);
            $p2_mentah = round(collect($p2_staff)->avg('p2') + collect($p2_non)->sum('p2'),2);
            $p3_mentah = round(collect($p3_staff)->avg('p3') + collect($p3_non)->sum('p3'),2);
            $p4_mentah = round(collect($p4_staff)->avg('p4') + collect($p4_non)->sum('p4'),2);
            $p5_mentah = round(collect($p5_staff)->avg('p5') + collect($p5_non)->sum('p5'),2);
    
            $s1_mentah = round(collect($s1_staff)->avg('s1') + collect($s1_non)->sum('s1'),2);
            $s2_mentah = round(collect($s2_staff)->avg('s2') + collect($s2_non)->sum('s2'),2);
            $s3_mentah = round(collect($s3_staff)->avg('s3') + collect($s3_non)->sum('s3'),2);
            $s4_mentah = round(collect($s4_staff)->avg('s4') + collect($s4_non)->sum('s4'),2);
            $s5_mentah = round(collect($s5_staff)->avg('s5') + collect($s5_non)->sum('s5'),2);
    
            $raspek_k_mentah = round(collect($raspek_k_staff)->avg('raspek_k') + collect($raspek_k_non)->sum('raspek_k'),2);
            $raspek_s_mentah = round(collect($raspek_s_staff)->avg('raspek_s') + collect($raspek_s_non)->sum('raspek_s'),2);
            $raspek_p_mentah = round(collect($raspek_p_staff)->avg('raspek_p') + collect($raspek_p_non)->sum('raspek_p'),2);
    
            $k1 = round($k1_mentah / ($divider + 1), 2);
            $k2 = round($k2_mentah / ($divider + 1), 2);
            $k3 = round($k3_mentah / ($divider + 1), 2);
            $k4 = round($k4_mentah / ($divider + 1), 2);
            $k5 = round($k5_mentah / ($divider + 1), 2);
            $k6 = round($k6_mentah / ($divider + 1), 2);

            $p1 = round($p1_mentah / ($divider + 1), 2);
            $p2 = round($p2_mentah / ($divider + 1), 2);
            $p3 = round($p3_mentah / ($divider + 1), 2);
            $p4 = round($p4_mentah / ($divider + 1), 2);
            $p5 = round($p5_mentah / ($divider + 1), 2);

            $s1 = round($s1_mentah / ($divider + 1), 2);
            $s2 = round($s2_mentah / ($divider + 1), 2);
            $s3 = round($s3_mentah / ($divider + 1), 2);
            $s4 = round($s4_mentah / ($divider + 1), 2);
            $s5 = round($s5_mentah / ($divider + 1), 2);
    
            $raspek_k = round($k1 + $k2 + $k3 + $k4 + $k5 + $k6, 2);
            $raspek_s = round($s1 + $s2 + $s3 + $s4 + $s5, 2);
            $raspek_p = round($p1 + $p2 + $p3 + $p4 + $p5, 2);
    
            $point_dp3 = 0;
            $kriteria_dp3 = '';
            // dd($total_raspek);
            if ($total_raspek > 95) {
                $kriteria_dp3 = 'Sangat Baik';
                $point_dp3 = 4;
            } elseif ($total_raspek > 85 && $total_raspek <= 95) {
                $kriteria_dp3 = 'Baik';
                $point_dp3 = 3;
            } elseif ($total_raspek > 65 && $total_raspek <= 85) {
                $kriteria_dp3 = 'Cukup';
                $point_dp3 = 2;
            } elseif ($total_raspek > 50 && $total_raspek <= 65) {
                $kriteria_dp3 = 'Kurang';
                $point_dp3 = 1;
            } else {
                $kriteria_dp3 = 'Sangat Kurang';
                $point_dp3 = 0;
            }
        }
        
        setlocale(LC_TIME, 'id_ID');
        // $nows = Carbon::setLocale('id');
        // $nows = Carbon::now()->formatLocalized("%A, %d %B %Y");

        $nows = Carbon::now()->isoFormat('D MMMM Y');

        return [
            $npp ?? 'null',
            $nama ?? 'null',
            round($total_raspek,2) ?? 'null',
            $point_dp3 ?? 'null',
            $kriteria_dp3 ?? 'null',
        ];

        // return [
        //     $row->id,
        //     $row->relasi_karyawan->npp_karyawan,
        //     $row->relasi_karyawan->nama_karyawan,
        //     $row->total,
        // ];
    }

    public function headings(): array
    {
        return [
            'npp_dinilai',
            'nama_dinilai',
            'skor_dp3',
            'point',
            'kriteria'
        ];
    }
}
