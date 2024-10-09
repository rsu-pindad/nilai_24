<?php

namespace App\Exports\Sdm\Rekap;

use App\Models\RekapPenilai;
use App\Models\RelasiKaryawan;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class Dp3Export implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $chunk;

    protected $rekap;

    public function __construct()
    {
        $this->rekap = [];
        $this->chunk = RelasiKaryawan::with(['relasi_atasan']);
    }

    public function view(): View
    {
        $this->chunk->chunk(50, function (Collection $data) {
            foreach ($data as $key => $chunk) {
                $this->rekap[] = [
                    'npp_karyawan'                         => $chunk->npp_karyawan,
                    'nama_karyawan'                        => $chunk->nama_karyawan,
                    'level_jabatan'                        => $chunk->level_jabatan,
                    'unit_jabatan'                         => $chunk->unit_jabatan,
                    'strategi_perencanaan_konversi_aspek'  => round($chunk->getAvgAtasan('strategi_perencanaan_konversi_aspek') + $chunk->getAvgSelf('strategi_perencanaan_konversi_aspek') + $chunk->getAvgRekanan('strategi_perencanaan_konversi_aspek') + $chunk->getAvgStaff('strategi_perencanaan_konversi_aspek'), 2),
                    'strategi_pengawasan_konversi_aspek'   => round($chunk->getAvgAtasan('strategi_pengawasan_konversi_aspek') + $chunk->getAvgSelf('strategi_pengawasan_konversi_aspek') + $chunk->getAvgRekanan('strategi_pengawasan_konversi_aspek') + $chunk->getAvgStaff('strategi_pengawasan_konversi_aspek'), 2),
                    'strategi_inovasi_konversi_aspek'      => round($chunk->getAvgAtasan('strategi_inovasi_konversi_aspek') + $chunk->getAvgSelf('strategi_inovasi_konversi_aspek') + $chunk->getAvgRekanan('strategi_inovasi_konversi_aspek') + $chunk->getAvgStaff('strategi_inovasi_konversi_aspek'), 2),
                    'kepemimpinan_konversi_aspek'          => round($chunk->getAvgAtasan('kepemimpinan_konversi_aspek') + $chunk->getAvgSelf('kepemimpinan_konversi_aspek') + $chunk->getAvgRekanan('kepemimpinan_konversi_aspek') + $chunk->getAvgStaff('kepemimpinan_konversi_aspek'), 2),
                    'membimbing_membangun_konversi_aspek'  => round($chunk->getAvgAtasan('membimbing_membangun_konversi_aspek') + $chunk->getAvgSelf('membimbing_membangun_konversi_aspek') + $chunk->getAvgRekanan('membimbing_membangun_konversi_aspek') + $chunk->getAvgStaff('membimbing_membangun_konversi_aspek'), 2),
                    'pengambilan_keputusan_konversi_aspek' => round($chunk->getAvgAtasan('pengambilan_keputusan_konversi_aspek') + $chunk->getAvgSelf('pengambilan_keputusan_konversi_aspek') + $chunk->getAvgRekanan('pengambilan_keputusan_konversi_aspek') + $chunk->getAvgStaff('pengambilan_keputusan_konversi_aspek'), 2),
                    'kerjasama_konversi_aspek'             => round($chunk->getAvgAtasan('kerjasama_konversi_aspek') + $chunk->getAvgSelf('kerjasama_konversi_aspek') + $chunk->getAvgRekanan('kerjasama_konversi_aspek') + $chunk->getAvgStaff('kerjasama_konversi_aspek'), 2),
                    'komunikasi_konversi_aspek'            => round($chunk->getAvgAtasan('komunikasi_konversi_aspek') + $chunk->getAvgSelf('komunikasi_konversi_aspek') + $chunk->getAvgRekanan('komunikasi_konversi_aspek') + $chunk->getAvgStaff('komunikasi_konversi_aspek'), 2),
                    'absensi_konversi_aspek'               => round($chunk->getAvgAtasan('absensi_konversi_aspek') + $chunk->getAvgSelf('absensi_konversi_aspek') + $chunk->getAvgRekanan('absensi_konversi_aspek') + $chunk->getAvgStaff('absensi_konversi_aspek'), 2),
                    'integritas_konversi_aspek'            => round($chunk->getAvgAtasan('integritas_konversi_aspek') + $chunk->getAvgSelf('integritas_konversi_aspek') + $chunk->getAvgRekanan('integritas_konversi_aspek') + $chunk->getAvgStaff('integritas_konversi_aspek'), 2),
                    'etika_konversi_aspek'                 => round($chunk->getAvgAtasan('etika_konversi_aspek') + $chunk->getAvgSelf('etika_konversi_aspek') + $chunk->getAvgRekanan('etika_konversi_aspek') + $chunk->getAvgStaff('etika_konversi_aspek'), 2),
                    'goal_kinerja_konversi_aspek'          => round($chunk->getAvgAtasan('goal_kinerja_konversi_aspek') + $chunk->getAvgSelf('goal_kinerja_konversi_aspek') + $chunk->getAvgRekanan('goal_kinerja_konversi_aspek') + $chunk->getAvgStaff('goal_kinerja_konversi_aspek'), 2),
                    'error_kinerja_konversi_aspek'         => round($chunk->getAvgAtasan('error_kinerja_konversi_aspek') + $chunk->getAvgSelf('error_kinerja_konversi_aspek') + $chunk->getAvgRekanan('error_kinerja_konversi_aspek') + $chunk->getAvgStaff('error_kinerja_konversi_aspek'), 2),
                    'proses_dokumen_konversi_aspek'        => round($chunk->getAvgAtasan('proses_dokumen_konversi_aspek') + $chunk->getAvgSelf('proses_dokumen_konversi_aspek') + $chunk->getAvgRekanan('proses_dokumen_konversi_aspek') + $chunk->getAvgStaff('proses_dokumen_konversi_aspek'), 2),
                    'proses_inisiatif_konversi_aspek'      => round($chunk->getAvgAtasan('proses_inisiatif_konversi_aspek') + $chunk->getAvgSelf('proses_inisiatif_konversi_aspek') + $chunk->getAvgRekanan('proses_inisiatif_konversi_aspek') + $chunk->getAvgStaff('proses_inisiatif_konversi_aspek'), 2),
                    'proses_polapikir_konversi_aspek'      => round($chunk->getAvgAtasan('proses_polapikir_konversi_aspek') + $chunk->getAvgSelf('proses_polapikir_konversi_aspek') + $chunk->getAvgRekanan('proses_polapikir_konversi_aspek') + $chunk->getAvgStaff('proses_polapikir_konversi_aspek'), 2),
                    'sum_nilai_k_konversi_aspek'           => round($chunk->getAvgAtasan('sum_nilai_k_konversi_aspek') + $chunk->getAvgSelf('sum_nilai_k_konversi_aspek') + $chunk->getAvgRekanan('sum_nilai_k_konversi_aspek') + $chunk->getAvgStaff('sum_nilai_k_konversi_aspek'), 2),
                    'sum_nilai_s_konversi_aspek'           => round($chunk->getAvgAtasan('sum_nilai_s_konversi_aspek') + $chunk->getAvgSelf('sum_nilai_s_konversi_aspek') + $chunk->getAvgRekanan('sum_nilai_s_konversi_aspek') + $chunk->getAvgStaff('sum_nilai_s_konversi_aspek'), 2),
                    'sum_nilai_p_konversi_aspek'           => round($chunk->getAvgAtasan('sum_nilai_p_konversi_aspek') + $chunk->getAvgSelf('sum_nilai_p_konversi_aspek') + $chunk->getAvgRekanan('sum_nilai_p_konversi_aspek') + $chunk->getAvgStaff('sum_nilai_p_konversi_aspek'), 2),
                    'sum_nilai_dp3'                        => round($chunk->getAvgAtasan('sum_nilai_dp3') + $chunk->getAvgSelf('sum_nilai_dp3') + $chunk->getAvgRekanan('sum_nilai_dp3') + $chunk->getAvgStaff('sum_nilai_dp3'), 2),
                ];
            }
        });

        return view('export.dp3.export-dp3', ['rekap' => $this->rekap]);
    }
}
