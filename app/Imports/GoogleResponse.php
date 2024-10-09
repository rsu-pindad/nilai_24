<?php

namespace App\Imports;

use App\Models\GResponse;
use Maatwebsite\Excel\Concerns\ToModel;

class GoogleResponse implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new GResponse([
            'timestamp'             => $row[0],
            'npp_penilai'           => $row[1],
            'nama_penilai'          => $row[2],
            'npp_dinilai'           => $row[3],
            'nama_dinilai'          => $row[4],
            'jabatan_dinilai'       => $row[5],
            'strategi_perencanaan'  => $row[6],
            'strategi_pengawasan'   => $row[7],
            'strategi_inovasi'      => $row[8],
            'kepemimpinan'          => $row[9],
            'membimbing_membangun'  => $row[10],
            'pengambilan_keputusan' => $row[11],
            'kerjasama'             => $row[11],
            'komunikasi'            => $row[12],
            'absensi'               => $row[13],
            'integritas'            => $row[14],
            'etika'                 => $row[15],
            'goal_kinerja'          => $row[16],
            'error_kinerja'         => $row[17],
            'proses_dokumen'        => $row[18],
            'proses_inisiatif'      => $row[19],
            'proses_polapikir'      => $row[20],
        ]);
    }
}
