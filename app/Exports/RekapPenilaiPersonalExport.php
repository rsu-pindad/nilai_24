<?php

namespace App\Exports;

use App\Models\FinalDp3;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Database\Eloquent\Collection;

class RekapPenilaiPersonalExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    // public function __construct(FinalDp3 $final)
    // {
    //     $this->final = $final;
    // }

    public function query()
    {
        // return FinalDp3::query()->orderBy('npp_dinilai_id');
        return FinalDp3::query()
            ->select()
            ->selectRaw('SUM(avg_dp3) as total')
            ->groupBy('npp_dinilai_id');
    }

    public function map($row): array
    {
        
        $kriteria_dp3 = '';
        $point_dp3 = 0;
        if ($row->total > 95) {
            $kriteria_dp3 = 'Sangat Baik';
            $point_dp3 = 4;
        } elseif ($row->total > 85 && $row->total <= 95) {
            $kriteria_dp3 = 'Baik';
            $point_dp3 = 3;
        } elseif ($row->total > 65 && $row->total <= 85) {
            $kriteria_dp3 = 'Cukup';
            $point_dp3 = 2;
        } elseif ($row->total > 50 && $row->total <= 65) {
            $kriteria_dp3 = 'Kurang';
            $point_dp3 = 1;
        } else {
            $kriteria_dp3 = 'Sangat Kurang';
            $point_dp3 = 0;
        }
        return [
            $row->id,
            $row->relasi_karyawan->npp_karyawan,
            $row->relasi_karyawan->nama_karyawan,
            $row->total,
            $point_dp3,
            $kriteria_dp3,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'nama_dinilai',
            'npp_dinilai',
            'skor_dp3',
            'point',
            'kriteria',
        ];
    }
}
