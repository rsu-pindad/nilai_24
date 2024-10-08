<?php

namespace App\Jobs\Sdm\Rekap;

use App\Models\RekapDp3;
use App\Models\RekapPenilai;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class RekapNilaiDp3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $relasiRekap;

    /**
     * Create a new job instance.
     */
    public function __construct($relasi)
    {
        $this->relasiRekap = RekapPenilai::with(['relasi_karyawan', 'identitas_penilai', 'identitas_dinilai'])->where('relasi', $relasi)->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chunks = $this->relasiRekap->whereNotNull('identitas_dinilai.level_jabatan')->chunk(5);
        // try {
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $items) {
                    // Cari data penilai karyawan
                    // Untuk Pengkalian Bobot setelah skor di dapat
                    if (Str::remove(' ', $items->relasi) == 'atasan') {
                        $bobot = 0.6;
                    }
                    if (Str::remove(' ', $items->relasi) == 'rekanan') {
                        $bobot = 0.2;
                    }
                    if (Str::remove(' ', $items->relasi) == 'staff') {
                        $bobot = 0.15;
                    }
                    if (Str::remove(' ', $items->relasi) == 'self') {
                        $bobot = 0.05;
                    }
                    // Kepemimpinan
                    $collection['strategi_perencanaan_konversi_aspek']  = round(round($items->strategi_perencanaan_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['strategi_pengawasan_konversi_aspek']   = round(round($items->strategi_pengawasan_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['strategi_inovasi_konversi_aspek']      = round(round($items->strategi_inovasi_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['kepemimpinan_konversi_aspek']          = round(round($items->kepemimpinan_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['membimbing_membangun_konversi_aspek']  = round(round($items->membimbing_membangun_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['pengambilan_keputusan_konversi_aspek'] = round(round($items->pengambilan_keputusan_bobot_aspek * 100, 2) * $bobot, 2);

                    $collection['sum_nilai_k_konversi_aspek'] = round($collection['strategi_perencanaan_konversi_aspek']
                        + $collection['strategi_pengawasan_konversi_aspek']
                        + $collection['strategi_inovasi_konversi_aspek']
                        + $collection['kepemimpinan_konversi_aspek']
                        + $collection['membimbing_membangun_konversi_aspek']
                        + $collection['pengambilan_keputusan_konversi_aspek'], 2);

                    // Perilaku
                    $collection['kerjasama_konversi_aspek']  = round(round($items->kerjasama_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['komunikasi_konversi_aspek'] = round(round($items->komunikasi_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['absensi_konversi_aspek']    = round(round($items->absensi_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['integritas_konversi_aspek'] = round(round($items->integritas_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['etika_konversi_aspek']      = round(round($items->etika_bobot_aspek * 100, 2) * $bobot, 2);

                    $collection['sum_nilai_p_konversi_aspek'] = round($collection['kerjasama_konversi_aspek']
                        + $collection['komunikasi_konversi_aspek']
                        + $collection['absensi_konversi_aspek']
                        + $collection['integritas_konversi_aspek']
                        + $collection['etika_konversi_aspek'], 2);

                    // Sasaran
                    $collection['goal_kinerja_konversi_aspek']     = round(round($items->goal_kinerja_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['error_kinerja_konversi_aspek']    = round(round($items->error_kinerja_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['proses_dokumen_konversi_aspek']   = round(round($items->proses_dokumen_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['proses_inisiatif_konversi_aspek'] = round(round($items->proses_inisiatif_bobot_aspek * 100, 2) * $bobot, 2);
                    $collection['proses_polapikir_konversi_aspek'] = round(round($items->proses_polapikir_bobot_aspek * 100, 2) * $bobot, 2);

                    $collection['sum_nilai_s_konversi_aspek'] = round($collection['goal_kinerja_konversi_aspek']
                        + $collection['error_kinerja_konversi_aspek']
                        + $collection['proses_dokumen_konversi_aspek']
                        + $collection['proses_inisiatif_konversi_aspek']
                        + $collection['proses_polapikir_konversi_aspek'], 2);

                    $collection['sum_nilai_dp3'] = round((
                        $collection['sum_nilai_k_konversi_aspek']
                        + $collection['sum_nilai_s_konversi_aspek']
                        + $collection['sum_nilai_p_konversi_aspek']
                    ), 2);

                    RekapDp3::updateOrCreate(
                        [
                            'rekap_penilai_id' => $items->id,
                        ],
                        [
                            'penilai_id'                           => $items->identitas_penilai->id,
                            'dinilai_id'                           => $items->identitas_dinilai->id,
                            'strategi_perencanaan_konversi_aspek'  => $collection['strategi_perencanaan_konversi_aspek'],
                            'strategi_pengawasan_konversi_aspek'   => $collection['strategi_pengawasan_konversi_aspek'],
                            'strategi_inovasi_konversi_aspek'      => $collection['strategi_inovasi_konversi_aspek'],
                            'kepemimpinan_konversi_aspek'          => $collection['kepemimpinan_konversi_aspek'],
                            'membimbing_membangun_konversi_aspek'  => $collection['membimbing_membangun_konversi_aspek'],
                            'pengambilan_keputusan_konversi_aspek' => $collection['pengambilan_keputusan_konversi_aspek'],
                            'kerjasama_konversi_aspek'             => $collection['kerjasama_konversi_aspek'],
                            'komunikasi_konversi_aspek'            => $collection['komunikasi_konversi_aspek'],
                            'absensi_konversi_aspek'               => $collection['absensi_konversi_aspek'],
                            'integritas_konversi_aspek'            => $collection['integritas_konversi_aspek'],
                            'etika_konversi_aspek'                 => $collection['etika_konversi_aspek'],
                            'goal_kinerja_konversi_aspek'          => $collection['goal_kinerja_konversi_aspek'],
                            'error_kinerja_konversi_aspek'         => $collection['error_kinerja_konversi_aspek'],
                            'proses_dokumen_konversi_aspek'        => $collection['proses_dokumen_konversi_aspek'],
                            'proses_inisiatif_konversi_aspek'      => $collection['proses_inisiatif_konversi_aspek'],
                            'proses_polapikir_konversi_aspek'      => $collection['proses_polapikir_konversi_aspek'],
                            'sum_nilai_k_konversi_aspek'           => $collection['sum_nilai_k_konversi_aspek'],
                            'sum_nilai_s_konversi_aspek'           => $collection['sum_nilai_s_konversi_aspek'],
                            'sum_nilai_p_konversi_aspek'           => $collection['sum_nilai_p_konversi_aspek'],
                            'sum_nilai_dp3'                        => $collection['sum_nilai_dp3'],
                            'relasi'                               => $items->relasi,
                        ]
                    );
                }
            }
        // } catch (\Throwable $th) {
        //     throw $th->getMessage();
        // }
    }
}
