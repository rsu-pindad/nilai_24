<?php

namespace App\Jobs\Sdm\Skor;

use App\Models\GResponse;
use App\Models\PoolRespon;
use App\Models\RelasiKaryawan;
use App\Models\ScoreJawaban;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncSelf implements ShouldQueue
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
            $self         = [];
            $slugs_relasi = 'self';
            // $collection  = collect($this->googleForm);
            // $chunks = $collection->chunk(50);
            $chunks = array_chunk($this->googleForm, 50);
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $value) {
                    if ($chunk[$key]['npp_penilai'] == $chunk[$key]['npp_dinilai']) {
                        $temp = $chunk[$key];
                        array_push($self, $temp);
                    }
                }
            }
            // Pembagian Segment
            $kepemimpinan = $this->skorJawabanData[1];
            $perilaku     = $this->skorJawabanData[2];
            $sasaran      = $this->skorJawabanData[3];
            $karyawan     = [];
            $tempData     = [];

            foreach ($self as $key => $value) {
                $nilai_skor_1 = 0;
                $nilai_skor_2 = 0;
                $nilai_skor_3 = 0;
                $nilai_skor_4 = 0;
                $nilai_skor_5 = 0;
                $nilai_skor_6 = 0;

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

                $self_1 = '';
                $self_2 = '';
                $self_3 = '';
                $self_4 = '';
                $self_5 = '';
                $self_6 = '';

                $self_7  = '';
                $self_8  = '';
                $self_9  = '';
                $self_10 = '';
                $self_11 = '';

                $self_12 = '';
                $self_13 = '';
                $self_14 = '';
                $self_15 = '';
                $self_16 = '';

                foreach ($kepemimpinan as $keys => $value) {
                    // Kepemimpinan
                    $self_1 = str($self[$key]['strategi_perencanaan'])->squish();
                    $self_2 = str($self[$key]['strategi_pengawasan'])->squish();
                    $self_3 = str($self[$key]['strategi_inovasi'])->squish();
                    $self_4 = str($self[$key]['kepemimpinan'])->squish();
                    $self_5 = str($self[$key]['membimbing_membangun'])->squish();
                    $self_6 = str($self[$key]['pengambilan_keputusan'])->squish();

                    if ($self_1 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_1 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($self_2 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_2 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($self_3 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_3 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($self_4 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_4 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($self_5 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_5 = $kepemimpinan[$keys]['skor'];
                    }
                    if ($self_6 == str($kepemimpinan[$keys]['jawaban'])->squish()) {
                        $nilai_skor_6 = $kepemimpinan[$keys]['skor'];
                    }
                }

                foreach ($perilaku as $keys => $value) {
                    // Perilaku
                    $self_7  = str($self[$key]['kerjasama'])->squish();
                    $self_8  = str($self[$key]['komunikasi'])->squish();
                    $self_9  = str($self[$key]['absensi'])->squish();
                    $self_10 = str($self[$key]['integritas'])->squish();
                    $self_11 = str($self[$key]['etika'])->squish();
                    if ($self_7 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_7 = $perilaku[$keys]['skor'];
                    }
                    if ($self_8 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_8 = $perilaku[$keys]['skor'];
                    }
                    if ($self_9 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_9 = $perilaku[$keys]['skor'];
                    }
                    if ($self_10 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_10 = $perilaku[$keys]['skor'];
                    }
                    if ($self_11 == str($perilaku[$keys]['jawaban'])->squish()) {
                        $nilai_skor_11 = $perilaku[$keys]['skor'];
                    }
                }

                foreach ($sasaran as $keys => $value) {
                    // Sasaran
                    $self_12 = str($self[$key]['goal_kinerja'])->squish();
                    $self_13 = str($self[$key]['error_kinerja'])->squish();
                    $self_14 = str($self[$key]['proses_dokumen'])->squish();
                    $self_15 = str($self[$key]['proses_inisiatif'])->squish();
                    $self_16 = str($self[$key]['proses_polapikir'])->squish();
                    if ($self_12 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_12 = $sasaran[$keys]['skor'];
                    }
                    if ($self_13 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_13 = $sasaran[$keys]['skor'];
                    }
                    if ($self_14 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_14 = $sasaran[$keys]['skor'];
                    }
                    if ($self_15 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_15 = $sasaran[$keys]['skor'];
                    }
                    if ($self_16 == str($sasaran[$keys]['jawaban'])->squish()) {
                        $nilai_skor_16 = $sasaran[$keys]['skor'];
                    }
                }

                $temp_nilai = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
                $karyawan   = [];
                $karyawan   = RelasiKaryawan::where('npp_karyawan', $self[$key]['npp_penilai'])->first() ?? '';
                if ($karyawan != '') {
                    $karyawan->toArray();
                    $tempData = [
                        'npp_penilai' => $karyawan['id'],
                        'npp_dinilai' => $self[$key]['npp_dinilai'],
                        // 'jabatan_dinilai' => $self[$key]['jabatan_dinilai'],
                        'jabatan_dinilai'       => $karyawan['level_jabatan'],
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
                        'relasi'                => $slugs_relasi,
                        'npp_penilai_dinilai'   => $self[$key]['npp_penilai'] . $self[$key]['npp_dinilai']
                    ];
                    PoolRespon::updateOrCreate(
                        [
                            'npp_penilai_dinilai' => $self[$key]['npp_penilai'] . $self[$key]['npp_dinilai']
                        ],
                        $tempData
                    );
                }
                $tempData = [];
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
