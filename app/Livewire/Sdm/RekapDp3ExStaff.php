<?php

namespace App\Livewire\Sdm;

use App\Exports\Sdm\Rekap\Dp3Export;
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
use Maatwebsite\Excel\Facades\Excel;
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
                'strategi_perencanaan_konversi_aspek'  => round($dataKaryawan->getAvgAtasan('strategi_perencanaan_konversi_aspek') + $dataKaryawan->getAvgSelf('strategi_perencanaan_konversi_aspek') + $dataKaryawan->getAvgRekanan('strategi_perencanaan_konversi_aspek') + $dataKaryawan->getAvgStaff('strategi_perencanaan_konversi_aspek'), 2),
                'strategi_pengawasan_konversi_aspek'   => round($dataKaryawan->getAvgAtasan('strategi_pengawasan_konversi_aspek') + $dataKaryawan->getAvgSelf('strategi_pengawasan_konversi_aspek') + $dataKaryawan->getAvgRekanan('strategi_pengawasan_konversi_aspek') + $dataKaryawan->getAvgStaff('strategi_pengawasan_konversi_aspek'), 2),
                'strategi_inovasi_konversi_aspek'      => round($dataKaryawan->getAvgAtasan('strategi_inovasi_konversi_aspek') + $dataKaryawan->getAvgSelf('strategi_inovasi_konversi_aspek') + $dataKaryawan->getAvgRekanan('strategi_inovasi_konversi_aspek') + $dataKaryawan->getAvgStaff('strategi_inovasi_konversi_aspek'), 2),
                'kepemimpinan_konversi_aspek'          => round($dataKaryawan->getAvgAtasan('kepemimpinan_konversi_aspek') + $dataKaryawan->getAvgSelf('kepemimpinan_konversi_aspek') + $dataKaryawan->getAvgRekanan('kepemimpinan_konversi_aspek') + $dataKaryawan->getAvgStaff('kepemimpinan_konversi_aspek'), 2),
                'membimbing_membangun_konversi_aspek'  => round($dataKaryawan->getAvgAtasan('membimbing_membangun_konversi_aspek') + $dataKaryawan->getAvgSelf('membimbing_membangun_konversi_aspek') + $dataKaryawan->getAvgRekanan('membimbing_membangun_konversi_aspek') + $dataKaryawan->getAvgStaff('membimbing_membangun_konversi_aspek'), 2),
                'pengambilan_keputusan_konversi_aspek' => round($dataKaryawan->getAvgAtasan('pengambilan_keputusan_konversi_aspek') + $dataKaryawan->getAvgSelf('pengambilan_keputusan_konversi_aspek') + $dataKaryawan->getAvgRekanan('pengambilan_keputusan_konversi_aspek') + $dataKaryawan->getAvgStaff('pengambilan_keputusan_konversi_aspek'), 2),
                'kerjasama_konversi_aspek'             => round($dataKaryawan->getAvgAtasan('kerjasama_konversi_aspek') + $dataKaryawan->getAvgSelf('kerjasama_konversi_aspek') + $dataKaryawan->getAvgRekanan('kerjasama_konversi_aspek') + $dataKaryawan->getAvgStaff('kerjasama_konversi_aspek'), 2),
                'komunikasi_konversi_aspek'            => round($dataKaryawan->getAvgAtasan('komunikasi_konversi_aspek') + $dataKaryawan->getAvgSelf('komunikasi_konversi_aspek') + $dataKaryawan->getAvgRekanan('komunikasi_konversi_aspek') + $dataKaryawan->getAvgStaff('komunikasi_konversi_aspek'), 2),
                'absensi_konversi_aspek'               => round($dataKaryawan->getAvgAtasan('absensi_konversi_aspek') + $dataKaryawan->getAvgSelf('absensi_konversi_aspek') + $dataKaryawan->getAvgRekanan('absensi_konversi_aspek') + $dataKaryawan->getAvgStaff('absensi_konversi_aspek'), 2),
                'integritas_konversi_aspek'            => round($dataKaryawan->getAvgAtasan('integritas_konversi_aspek') + $dataKaryawan->getAvgSelf('integritas_konversi_aspek') + $dataKaryawan->getAvgRekanan('integritas_konversi_aspek') + $dataKaryawan->getAvgStaff('integritas_konversi_aspek'), 2),
                'etika_konversi_aspek'                 => round($dataKaryawan->getAvgAtasan('etika_konversi_aspek') + $dataKaryawan->getAvgSelf('etika_konversi_aspek') + $dataKaryawan->getAvgRekanan('etika_konversi_aspek') + $dataKaryawan->getAvgStaff('etika_konversi_aspek'), 2),
                'goal_kinerja_konversi_aspek'          => round($dataKaryawan->getAvgAtasan('goal_kinerja_konversi_aspek') + $dataKaryawan->getAvgSelf('goal_kinerja_konversi_aspek') + $dataKaryawan->getAvgRekanan('goal_kinerja_konversi_aspek') + $dataKaryawan->getAvgStaff('goal_kinerja_konversi_aspek'), 2),
                'error_kinerja_konversi_aspek'         => round($dataKaryawan->getAvgAtasan('error_kinerja_konversi_aspek') + $dataKaryawan->getAvgSelf('error_kinerja_konversi_aspek') + $dataKaryawan->getAvgRekanan('error_kinerja_konversi_aspek') + $dataKaryawan->getAvgStaff('error_kinerja_konversi_aspek'), 2),
                'proses_dokumen_konversi_aspek'        => round($dataKaryawan->getAvgAtasan('proses_dokumen_konversi_aspek') + $dataKaryawan->getAvgSelf('proses_dokumen_konversi_aspek') + $dataKaryawan->getAvgRekanan('proses_dokumen_konversi_aspek') + $dataKaryawan->getAvgStaff('proses_dokumen_konversi_aspek'), 2),
                'proses_inisiatif_konversi_aspek'      => round($dataKaryawan->getAvgAtasan('proses_inisiatif_konversi_aspek') + $dataKaryawan->getAvgSelf('proses_inisiatif_konversi_aspek') + $dataKaryawan->getAvgRekanan('proses_inisiatif_konversi_aspek') + $dataKaryawan->getAvgStaff('proses_inisiatif_konversi_aspek'), 2),
                'proses_polapikir_konversi_aspek'      => round($dataKaryawan->getAvgAtasan('proses_polapikir_konversi_aspek') + $dataKaryawan->getAvgSelf('proses_polapikir_konversi_aspek') + $dataKaryawan->getAvgRekanan('proses_polapikir_konversi_aspek') + $dataKaryawan->getAvgStaff('proses_polapikir_konversi_aspek'), 2),
                'sum_nilai_k_konversi_aspek'           => round($dataKaryawan->getAvgAtasan('sum_nilai_k_konversi_aspek') + $dataKaryawan->getAvgSelf('sum_nilai_k_konversi_aspek') + $dataKaryawan->getAvgRekanan('sum_nilai_k_konversi_aspek') + $dataKaryawan->getAvgStaff('sum_nilai_k_konversi_aspek'), 2),
                'sum_nilai_s_konversi_aspek'           => round($dataKaryawan->getAvgAtasan('sum_nilai_s_konversi_aspek') + $dataKaryawan->getAvgSelf('sum_nilai_s_konversi_aspek') + $dataKaryawan->getAvgRekanan('sum_nilai_s_konversi_aspek') + $dataKaryawan->getAvgStaff('sum_nilai_s_konversi_aspek'), 2),
                'sum_nilai_p_konversi_aspek'           => round($dataKaryawan->getAvgAtasan('sum_nilai_p_konversi_aspek') + $dataKaryawan->getAvgSelf('sum_nilai_p_konversi_aspek') + $dataKaryawan->getAvgRekanan('sum_nilai_p_konversi_aspek') + $dataKaryawan->getAvgStaff('sum_nilai_p_konversi_aspek'), 2),
                'sum_nilai_dp3'                        => round($dataKaryawan->getAvgAtasan('sum_nilai_dp3') + $dataKaryawan->getAvgSelf('sum_nilai_dp3') + $dataKaryawan->getAvgRekanan('sum_nilai_dp3') + $dataKaryawan->getAvgStaff('sum_nilai_dp3'), 2),
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

    public function export()
    {
        return Excel::download(new Dp3Export, 'test.xlsx');
    }
}
