<?php

namespace App\Livewire\Sdm;

use App\Models\PoolRespon;
use App\Models\RekapPenilai;
use App\Models\RelasiKaryawan;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Rekap Respon')]
class RekapRespon extends Component
{
    public function render()
    {
        return view('livewire.sdm.rekap-respon');
    }

    public function calculate()
    {
        $getPoolRespon = PoolRespon::orderby('created_at')->get()->unique('npp_penilai_dinilai')->toArray();
        $chunks        = array_chunk($getPoolRespon, 50);
        $bobot_penilai = 0;
        $collection    = [];
        $aspek_k       = 0;  // 3
        $aspek_s       = 0;  // 2
        $aspek_p       = 0;  // 1

        $penilai_atasan  = 0;
        $penilai_rekanan = 0;
        $penilai_staff   = 0;
        $penilai_self    = 0;

        $finalData = collect();
        $tempData  = array();
        foreach ($chunks as $chunk) {
            foreach ($chunk as $key => $items) {
                // Cari data penilai karyawan
                $penilaiKaryawan = RelasiKaryawan::where('id', $items['npp_penilai'])->first();
                if ($penilaiKaryawan) {
                    $penilaiKaryawan->toArray();
                    // Untuk Pengkalian Bobot setelah skor di dapat
                    if (
                        Str::remove(' ', $items['jabatan_dinilai']) == 'DIREKSI'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IA'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IB'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IC'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IANS'
                    ) {
                        $aspek_k = 0.4;   // 3
                        $aspek_s = 0.35;  // 2
                        $aspek_p = 0.25;  // 1

                        $penilai_atasan  = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff   = 0.15;
                        $penilai_self    = 0.05;
                    } elseif (
                        Str::remove(' ', $items['jabatan_dinilai']) == 'II'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IINS'
                    ) {
                        $aspek_k = 0.35;
                        $aspek_s = 0.4;
                        $aspek_p = 0.25;

                        $penilai_atasan  = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff   = 0.15;
                        $penilai_self    = 0.05;
                    } elseif (
                        Str::remove(' ', $items['jabatan_dinilai']) == 'III'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IIINS'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IIII'
                    ) {
                        $aspek_k = 0.3;
                        $aspek_s = 0.45;
                        $aspek_p = 0.25;

                        $penilai_atasan  = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff   = 0.15;
                        $penilai_self    = 0.05;
                    } elseif (
                        Str::remove(' ', $items['jabatan_dinilai']) == 'IV'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IVA(III)'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IVA(IIINS)'
                        || Str::remove(' ', $items['jabatan_dinilai']) == 'IVA'
                    ) {
                        $aspek_k = 0.1;
                        $aspek_s = 0.6;
                        $aspek_p = 0.3;

                        $penilai_atasan  = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff   = 0.15;
                        $penilai_self    = 0.05;
                    } else {
                        $aspek_k = 0;
                        $aspek_s = 0.65;
                        $aspek_p = 0.35;

                        $penilai_atasan  = 0.65;
                        $penilai_rekanan = 0.25;
                        $penilai_staff   = 0;
                        $penilai_self    = 0.1;
                    }

                    if ($items['relasi'] == 'self') {
                        $bobot_penilai = $penilai_self;
                    } elseif ($items['relasi'] == 'atasan') {
                        $bobot_penilai = $penilai_atasan;
                    } elseif ($items['relasi'] == 'rekanan') {
                        $bobot_penilai = $penilai_rekanan;
                    } elseif ($items['relasi'] == 'staff') {
                        $bobot_penilai = $penilai_staff;
                    }

                    // Kepemimpinan
                    $collection['strategi_perencanaan_bobot_aspek']  = round(round($items['strategi_perencanaan'] / 30, 2) * $aspek_k, 2);
                    $collection['strategi_pengawasan_bobot_aspek']   = round(round($items['strategi_pengawasan'] / 30, 2) * $aspek_k, 2);
                    $collection['strategi_inovasi_bobot_aspek']      = round(round($items['strategi_inovasi'] / 30, 2) * $aspek_k, 2);
                    $collection['kepemimpinan_bobot_aspek']          = round(round($items['kepemimpinan'] / 30, 2) * $aspek_k, 2);
                    $collection['membimbing_membangun_bobot_aspek']  = round(round($items['membimbing_membangun'] / 30, 2) * $aspek_k, 2);
                    $collection['pengambilan_keputusan_bobot_aspek'] = round(round($items['pengambilan_keputusan'] / 30, 2) * $aspek_k, 2);

                    $collection['sum_nilai_k_bobot_aspek'] =
                        $collection['strategi_perencanaan_bobot_aspek']
                        + $collection['strategi_pengawasan_bobot_aspek']
                        + $collection['strategi_inovasi_bobot_aspek']
                        + $collection['kepemimpinan_bobot_aspek']
                        + $collection['membimbing_membangun_bobot_aspek']
                        + $collection['pengambilan_keputusan_bobot_aspek'];

                    // Perilaku
                    $collection['kerjasama_bobot_aspek']  = round(round($items['kerjasama'] / 25, 2) * $aspek_p, 2);
                    $collection['komunikasi_bobot_aspek'] = round(round($items['komunikasi'] / 25, 2) * $aspek_p, 2);
                    $collection['absensi_bobot_aspek']    = round(round($items['absensi'] / 25, 2) * $aspek_p, 2);
                    $collection['integritas_bobot_aspek'] = round(round($items['integritas'] / 25, 2) * $aspek_p, 2);
                    $collection['etika_bobot_aspek']      = round(round($items['etika'] / 25, 2) * $aspek_p, 2);

                    $collection['sum_nilai_p_bobot_aspek'] =
                        $collection['kerjasama_bobot_aspek']
                        + $collection['komunikasi_bobot_aspek']
                        + $collection['absensi_bobot_aspek']
                        + $collection['integritas_bobot_aspek']
                        + $collection['etika_bobot_aspek'];

                    // Sasaran
                    $collection['goal_kinerja_bobot_aspek']     = round(round($items['goal_kinerja'] / 25, 2) * $aspek_s, 2);
                    $collection['error_kinerja_bobot_aspek']    = round(round($items['error_kinerja'] / 25, 2) * $aspek_s, 2);
                    $collection['proses_dokumen_bobot_aspek']   = round(round($items['proses_dokumen'] / 25, 2) * $aspek_s, 2);
                    $collection['proses_inisiatif_bobot_aspek'] = round(round($items['proses_inisiatif'] / 25, 2) * $aspek_s, 2);
                    $collection['proses_polapikir_bobot_aspek'] = round(round($items['proses_polapikir'] / 25, 2) * $aspek_s, 2);

                    $collection['sum_nilai_s_bobot_aspek'] =
                        $collection['goal_kinerja_bobot_aspek']
                        + $collection['error_kinerja_bobot_aspek']
                        + $collection['proses_dokumen_bobot_aspek']
                        + $collection['proses_inisiatif_bobot_aspek']
                        + $collection['proses_polapikir_bobot_aspek'];

                    $collection['sum_nilai_dp3'] = round((
                        $collection['sum_nilai_k_bobot_aspek']
                        + $collection['sum_nilai_s_bobot_aspek']
                        + $collection['sum_nilai_p_bobot_aspek']
                    ) * $bobot_penilai, 4);
                }

                $tmpData = [
                    [
                        'pool_respon_id' => $items['id'],
                    ],
                    [
                        'npp_penilai'                       => $penilaiKaryawan['id'],
                        'npp_dinilai'                       => $items['npp_dinilai'],
                        'jabatan_penilai'                   => $penilaiKaryawan['level_jabatan'],
                        'jabatan_dinilai'                   => $items['jabatan_dinilai'],
                        'strategi_perencanaan_bobot_aspek'  => $collection['strategi_perencanaan_bobot_aspek'],
                        'strategi_pengawasan_bobot_aspek'   => $collection['strategi_pengawasan_bobot_aspek'],
                        'strategi_inovasi_bobot_aspek'      => $collection['strategi_inovasi_bobot_aspek'],
                        'kepemimpinan_bobot_aspek'          => $collection['kepemimpinan_bobot_aspek'],
                        'membimbing_membangun_bobot_aspek'  => $collection['membimbing_membangun_bobot_aspek'],
                        'pengambilan_keputusan_bobot_aspek' => $collection['pengambilan_keputusan_bobot_aspek'],
                        'kerjasama_bobot_aspek'             => $collection['kerjasama_bobot_aspek'],
                        'komunikasi_bobot_aspek'            => $collection['komunikasi_bobot_aspek'],
                        'absensi_bobot_aspek'               => $collection['absensi_bobot_aspek'],
                        'integritas_bobot_aspek'            => $collection['integritas_bobot_aspek'],
                        'etika_bobot_aspek'                 => $collection['etika_bobot_aspek'],
                        'goal_kinerja_bobot_aspek'          => $collection['goal_kinerja_bobot_aspek'],
                        'error_kinerja_bobot_aspek'         => $collection['error_kinerja_bobot_aspek'],
                        'proses_dokumen_bobot_aspek'        => $collection['proses_dokumen_bobot_aspek'],
                        'proses_inisiatif_bobot_aspek'      => $collection['proses_inisiatif_bobot_aspek'],
                        'proses_polapikir_bobot_aspek'      => $collection['proses_polapikir_bobot_aspek'],
                        'sum_nilai_k_bobot_aspek'           => $collection['sum_nilai_k_bobot_aspek'],
                        'sum_nilai_s_bobot_aspek'           => $collection['sum_nilai_s_bobot_aspek'],
                        'sum_nilai_p_bobot_aspek'           => $collection['sum_nilai_p_bobot_aspek'],
                        'sum_nilai_dp3'                     => $collection['sum_nilai_dp3'],
                        'npp_penilai_dinilai'               => $penilaiKaryawan['npp_karyawan'] . $items['npp_dinilai'],
                        'relasi'                            => $items['relasi'],
                    ],
                ];
                $tempData[] = $tmpData;
            }
        }
        $finalData = collect($tempData);
        $finalData->unique()->values()->all();
        foreach ($finalData as $key => $data) {
            try {
                RekapPenilai::updateOrCreate($data[0], $data[1]);
            } catch (\Illuminate\Database\QueryException $e) {
                throw $e;
            }
        }
    }
}
