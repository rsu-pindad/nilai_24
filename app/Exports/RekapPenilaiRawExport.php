<?php

namespace App\Exports;

use App\Models\RekapPenilai;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapPenilaiRawExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // use Exportable;
    
    public function collection()
    {
        return RekapPenilai::select(
            'pool_respon_id',
            'npp_penilai',
            'npp_dinilai',
            'jabatan_penilai',
            'jabatan_dinilai',
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
        )
        ->get();
    }

    public function headings(): array
    {
        return [
            'SheetID',
            'npp_penilai',
            'npp_dinilai',
            'jabatan_penilai',
            'jabatan_dinilai',
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
        ];
    }
}
