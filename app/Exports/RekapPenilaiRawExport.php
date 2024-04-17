<?php

namespace App\Exports;

use App\Models\RekapPenilai;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class RekapPenilaiRawExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    
    public function query()
    {
        return RekapPenilai::query()->orderBy('npp_penilai');
    }

    public function map($row) : array
    {
        return [
            $row->pool_respon_id,
            $row->identitas_penilai->npp_karyawan,
            $row->identitas_penilai->nama_karyawan,
            $row->identitas_penilai->level_jabatan,
            $row->npp_dinilai,
            $row->identitas_dinilai->nama_karyawan,
            $row->identitas_dinilai->level_jabatan,
            $row->relasi,
            $row->strategi_perencanaan_bobot_aspek,
            $row->strategi_pengawasan_bobot_aspek,
            $row->strategi_inovasi_bobot_aspek,
            $row->kepemimpinan_bobot_aspek,
            $row->membimbing_membangun_bobot_aspek,
            $row->pengambilan_keputusan_bobot_aspek,
            $row->kerjasama_bobot_aspek,
            $row->komunikasi_bobot_aspek,
            $row->absensi_bobot_aspek,
            $row->integritas_bobot_aspek,
            $row->etika_bobot_aspek,
            $row->goal_kinerja_bobot_aspek,
            $row->error_kinerja_bobot_aspek,
            $row->proses_dokumen_bobot_aspek,
            $row->proses_inisiatif_bobot_aspek,
            $row->proses_polapikir_bobot_aspek,
            $row->sum_nilai_k_bobot_aspek,
            $row->sum_nilai_s_bobot_aspek,
            $row->sum_nilai_p_bobot_aspek,
            $row->sum_nilai_dp3,
        ];
    }

    public function headings(): array
    {
        return [
            'SheetID',
            'npp_penilai',
            'nama_penilai',
            'jabatan_penilai',
            'npp_dinilai',
            'nama_dinilai',
            'jabatan_dinilai',
            'relasi',
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
        ];
    }
}
