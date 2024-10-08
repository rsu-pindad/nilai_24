<?php

namespace App\Livewire\Sdm;

use App\Jobs\Sdm\Rekap\RekapNilaiDp3;
use App\Livewire\Notifikasi\NotifikasiDefault;
use App\Models\RekapDp3;
use App\Models\RekapPenilai;
use App\Models\RelasiAtasan;
use App\Models\RelasiKaryawan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\LaravelPdf\Enums\Orientation;
use Spatie\LaravelPdf\Facades\Pdf;

#[Title('Halaman Rekap Personal')]
class RekapDp3ExStaff extends Component
{
    public $judulPdf = '';
    public $urlPdf   = '';

    public function render()
    {
        return view('livewire.sdm.rekap-dp3-ex-staff');
    }

    public function calculate($relasi)
    {
        $rekap = new RekapNilaiDp3($relasi);
        dispatch($rekap)->onConnection('redis')->onQueue('hitung-dp3');

        return $this->dispatch('notifSuccess', title: 'Rekap DP3 ', description: 'perhitungan ' . Str::ucfirst($relasi) . ' dilakukan!.')->to(NotifikasiDefault::class);
    }

    #[On('lihatPersonal')]
    public function lihatPdf($dinilaiId)
    {
        try {
            $dataKaryawan = RelasiKaryawan::with('relasi_atasan')->find($dinilaiId);
            $dataAtasanKaryawan = RelasiAtasan::with('relasi_baru_karyawan')->find($dataKaryawan->relasi_atasan->id);
            $rekap = [
                'npp_karyawan'                         => $dataKaryawan->npp_karyawan,
                'nama_karyawan'                        => $dataKaryawan->nama_karyawan,
                'level_jabatan'                        => $dataKaryawan->level_jabatan,
                'unit_jabatan'                         => $dataKaryawan->unit_jabatan,
                'atasan_npp_karyawan'                  => $dataAtasanKaryawan->relasi_baru_karyawan->npp_karyawan,
                'atasan_nama_karyawan'                 => $dataAtasanKaryawan->relasi_baru_karyawan->nama_karyawan,
                'atasan_level_jabatan'                 => $dataAtasanKaryawan->relasi_baru_karyawan->level_jabatan,
                'atasan_unit_jabatan'                  => $dataAtasanKaryawan->relasi_baru_karyawan->unit_jabatan,
                'strategi_perencanaan_konversi_aspek'  => round($dataKaryawan->getSum('strategi_perencanaan_konversi_aspek') + $dataKaryawan->getAvg('strategi_perencanaan_konversi_aspek'), 2),
                'strategi_pengawasan_konversi_aspek'   => round($dataKaryawan->getSum('strategi_pengawasan_konversi_aspek') + $dataKaryawan->getAvg('strategi_pengawasan_konversi_aspek'), 2),
                'strategi_inovasi_konversi_aspek'      => round($dataKaryawan->getSum('strategi_inovasi_konversi_aspek') + $dataKaryawan->getAvg('strategi_inovasi_konversi_aspek'), 2),
                'kepemimpinan_konversi_aspek'          => round($dataKaryawan->getSum('kepemimpinan_konversi_aspek') + $dataKaryawan->getAvg('kepemimpinan_konversi_aspek'), 2),
                'membimbing_membangun_konversi_aspek'  => round($dataKaryawan->getSum('membimbing_membangun_konversi_aspek') + $dataKaryawan->getAvg('membimbing_membangun_konversi_aspek'), 2),
                'pengambilan_keputusan_konversi_aspek' => round($dataKaryawan->getSum('pengambilan_keputusan_konversi_aspek') + $dataKaryawan->getAvg('pengambilan_keputusan_konversi_aspek'), 2),
                'kerjasama_konversi_aspek'             => round($dataKaryawan->getSum('kerjasama_konversi_aspek') + $dataKaryawan->getAvg('kerjasama_konversi_aspek'), 2),
                'komunikasi_konversi_aspek'            => round($dataKaryawan->getSum('komunikasi_konversi_aspek') + $dataKaryawan->getAvg('komunikasi_konversi_aspek'), 2),
                'absensi_konversi_aspek'               => round($dataKaryawan->getSum('absensi_konversi_aspek') + $dataKaryawan->getAvg('absensi_konversi_aspek'), 2),
                'integritas_konversi_aspek'            => round($dataKaryawan->getSum('integritas_konversi_aspek') + $dataKaryawan->getAvg('integritas_konversi_aspek'), 2),
                'etika_konversi_aspek'                 => round($dataKaryawan->getSum('etika_konversi_aspek') + $dataKaryawan->getAvg('etika_konversi_aspek'), 2),
                'goal_kinerja_konversi_aspek'          => round($dataKaryawan->getSum('goal_kinerja_konversi_aspek') + $dataKaryawan->getAvg('goal_kinerja_konversi_aspek'), 2),
                'error_kinerja_konversi_aspek'         => round($dataKaryawan->getSum('error_kinerja_konversi_aspek') + $dataKaryawan->getAvg('error_kinerja_konversi_aspek'), 2),
                'proses_dokumen_konversi_aspek'        => round($dataKaryawan->getSum('proses_dokumen_konversi_aspek') + $dataKaryawan->getAvg('proses_dokumen_konversi_aspek'), 2),
                'proses_inisiatif_konversi_aspek'      => round($dataKaryawan->getSum('proses_inisiatif_konversi_aspek') + $dataKaryawan->getAvg('proses_inisiatif_konversi_aspek'), 2),
                'proses_polapikir_konversi_aspek'      => round($dataKaryawan->getSum('proses_polapikir_konversi_aspek') + $dataKaryawan->getAvg('proses_polapikir_konversi_aspek'), 2),
                'sum_nilai_k_konversi_aspek'           => round($dataKaryawan->getSum('sum_nilai_k_konversi_aspek') + $dataKaryawan->getAvg('sum_nilai_k_konversi_aspek'), 2),
                'sum_nilai_s_konversi_aspek'           => round($dataKaryawan->getSum('sum_nilai_s_konversi_aspek') + $dataKaryawan->getAvg('sum_nilai_s_konversi_aspek'), 2),
                'sum_nilai_p_konversi_aspek'           => round($dataKaryawan->getSum('sum_nilai_p_konversi_aspek') + $dataKaryawan->getAvg('sum_nilai_p_konversi_aspek'), 2),
                'sum_nilai_dp3'                        => round($dataKaryawan->getSum('sum_nilai_dp3') + $dataKaryawan->getAvg('sum_nilai_dp3'), 2),
            ];
            $pdfName        = $dataKaryawan->npp_karyawan . '_final.pdf';
            $this->judulPdf = 'Personal : ' . $dataKaryawan->npp_karyawan . '/' . $dataKaryawan->nama_karyawan . '-' . $dataKaryawan->level_jabatan;

            Pdf::view('pdf.dokumen-table-semua', ['rekap' => $rekap])
                ->orientation(Orientation::Portrait)
                //    ->format(Format::A4)
                ->margins(2, 2, 2, 2)
                //    ->name($pdfName);
                ->disk('public')
                ->save('dokumen/' . $pdfName);
            $this->urlPdf = Storage::disk('public')->url('dokumen/' . $pdfName);

            return $this->dispatch('lihatPersonalDokumen');
        } catch (\Throwable $th) {
            return $this->dispatch('notifError', title: 'Rekap DP3', description: $th->getMessage())->to(NotifikasiDefault::class);
        }
    }
}
