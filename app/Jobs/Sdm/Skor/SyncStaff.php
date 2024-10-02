<?php

namespace App\Jobs\Sdm\Skor;

use App\Models\GResponse;
use App\Models\PoolRespon;
use App\Models\RelasiAtasan;
use App\Models\RelasiKaryawan;
use App\Models\RelasiSelevel;
use App\Models\RelasiStaff;
use App\Models\ScoreJawaban;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStaff implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $skorJawabanData;
    protected $googleForm;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->skorJawabanData = ScoreJawaban::get()->groupBy('aspek_id')->toArray();
        $this->googleForm      = GResponse::get()->toArray();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $temp         = [];
            $atasan       = [];
            $findrelasi   = [];
            $npp_karyawan = [];
            $chunks       = array_chunk($this->googleForm, 50);
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $value) {
                    if ($chunk[$key]['npp_penilai'] != $chunk[$key]['npp_dinilai']) {
                        $idRelasiKaryawan = RelasiKaryawan::where('npp_karyawan', $chunk[$key]['npp_penilai'])->first();
                        if ($idRelasiKaryawan) {
                            $idRelasiKaryawan->toArray();
                            $findrelasi = $this->findRelasi('atasan', $idRelasiKaryawan['id']);
                            if ($findrelasi) {
                                $findrelasi->toArray();
                                if ($findrelasi['npp_atasan'] != $chunk[$key]['npp_dinilai']) {
                                    continue;
                                } elseif ($findrelasi['npp_atasan'] == $chunk[$key]['npp_dinilai']) {
                                    $npp_karyawan[] = $idRelasiKaryawan['id'];
                                    $temp           = $chunk[$key];
                                    array_push($atasan, $temp);
                                }
                            }
                        }
                    }
                }
            }
            // dd($atasan);
            // Pembagian Segment
            $kepemimpinan = $this->skorJawabanData[1];
            $perilaku     = $this->skorJawabanData[2];
            $sasaran      = $this->skorJawabanData[3];
            $tempData     = [];

            foreach ($atasan as $key => $value) {
                $nilai_skor_1  = 0;
                $nilai_skor_2  = 0;
                $nilai_skor_3  = 0;
                $nilai_skor_4  = 0;
                $nilai_skor_5  = 0;
                $nilai_skor_6  = 0;
                $nilai_skor_7  = 0;
                $nilai_skor_8  = 0;
                $nilai_skor_9  = 0;
                $nilai_skor_10 = 0;
                $nilai_skor_11 = 0;
                $nilai_skor_12 = 0;
                $nilai_skor_13 = 0;
                $nilai_skor_14 = 0;
                $nilai_skor_15 = 0;
                $nilai_skor_16 = 0;

                $point_1  = '';
                $point_2  = '';
                $point_3  = '';
                $point_4  = '';
                $point_5  = '';
                $point_6  = '';
                $point_7  = '';
                $point_8  = '';
                $point_9  = '';
                $point_10 = '';
                $point_11 = '';
                $point_12 = '';
                $point_13 = '';
                $point_14 = '';
                $point_15 = '';
                $point_16 = '';

                foreach ($kepemimpinan as $keys => $value) {
                    // Kepemimpinan
                    $point_1 = str($atasan[$key]['strategi_perencanaan'])->squish();
                    $point_2 = str($atasan[$key]['strategi_pengawasan'])->squish();
                    $point_3 = str($atasan[$key]['strategi_inovasi'])->squish();
                    $point_4 = str($atasan[$key]['kepemimpinan'])->squish();
                    $point_5 = str($atasan[$key]['membimbing_membangun'])->squish();
                    $point_6 = str($atasan[$key]['pengambilan_keputusan'])->squish();

                    if ($point_1 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_1 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($point_2 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_2 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($point_3 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_3 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($point_4 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_4 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($point_5 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_5 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($point_6 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_6 = $kepemimpinan[$keys]['skor'];
                    }
                }

                foreach ($perilaku as $keys => $value) {
                    // Perilaku
                    $point_7  = str($atasan[$key]['kerjasama'])->squish();
                    $point_8  = str($atasan[$key]['komunikasi'])->squish();
                    $point_9  = str($atasan[$key]['absensi'])->squish();
                    $point_10 = str($atasan[$key]['integritas'])->squish();
                    $point_11 = str($atasan[$key]['etika'])->squish();
                    if ($point_7 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_7 = $perilaku[$keys]['skor'];
                    }
                    if ($point_8 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_8 = $perilaku[$keys]['skor'];
                    }
                    if ($point_9 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_9 = $perilaku[$keys]['skor'];
                    }
                    if ($point_10 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_10 = $perilaku[$keys]['skor'];
                    }
                    if ($point_11 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_11 = $perilaku[$keys]['skor'];
                    }
                }

                foreach ($sasaran as $keys => $value) {
                    // Sasaran
                    $point_12 = str($atasan[$key]['goal_kinerja'])->squish();
                    $point_13 = str($atasan[$key]['error_kinerja'])->squish();
                    $point_14 = str($atasan[$key]['proses_dokumen'])->squish();
                    $point_15 = str($atasan[$key]['proses_inisiatif'])->squish();
                    $point_16 = str($atasan[$key]['proses_polapikir'])->squish();
                    if ($point_12 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_12 = $sasaran[$keys]['skor'];
                    }
                    if ($point_13 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_13 = $sasaran[$keys]['skor'];
                    }
                    if ($point_14 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_14 = $sasaran[$keys]['skor'];
                    }
                    if ($point_15 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_15 = $sasaran[$keys]['skor'];
                    }
                    if ($point_16 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_16 = $sasaran[$keys]['skor'];
                    }
                }
                $temp_nilai = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
                $tempData = [
                    'npp_penilai'           => $npp_karyawan[$key],
                    'npp_dinilai'           => $atasan[$key]['npp_dinilai'],
                    'jabatan_dinilai'       => $atasan[$key]['jabatan_dinilai'],
                    'strategi_perencanaan'  => $nilai_skor_1,
                    'strategi_pengawasan'   => $nilai_skor_2,
                    'strategi_inovasi'      => $nilai_skor_3,
                    'kepemimpinan'          => $nilai_skor_4,
                    'membimbing_membangun'  => $nilai_skor_5,
                    'pengambilan_keputusan' => $nilai_skor_6,
                    'kerjasama'             => $nilai_skor_7,
                    'komunikasi'            => $nilai_skor_8,
                    'absensi'               => $nilai_skor_9,
                    'integritas'            => $nilai_skor_10,
                    'etika'                 => $nilai_skor_11,
                    'goal_kinerja'          => $nilai_skor_12,
                    'error_kinerja'         => $nilai_skor_13,
                    'proses_dokumen'        => $nilai_skor_14,
                    'proses_inisiatif'      => $nilai_skor_15,
                    'proses_polapikir'      => $nilai_skor_16,
                    'sum_nilai'             => $temp_nilai,
                    'relasi'                => 'staff',
                    'npp_penilai_dinilai'   => $atasan[$key]['npp_penilai'] . $atasan[$key]['npp_dinilai']
                ];
                PoolRespon::updateOrCreate(
                    [
                        'npp_penilai_dinilai' => $atasan[$key]['npp_penilai'] . $atasan[$key]['npp_dinilai']
                    ],
                    $tempData
                );
                $tempData = [];
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function findRelasi($relasi = null, $npp_karyawan = null)
    {
        if ($relasi == 'atasan') {
            return RelasiAtasan::where('relasi_karyawan_id', $npp_karyawan)->first();
        } elseif ($relasi == 'rekanan') {
            return RelasiSelevel::where('relasi_karyawan_id', $npp_karyawan)->first();
        } elseif ($relasi == 'staff') {
            return RelasiStaff::where('relasi_karyawan_id', $npp_karyawan)->get();
        }
    }
}
