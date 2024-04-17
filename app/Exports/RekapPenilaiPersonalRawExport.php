<?php

namespace App\Exports;

use App\Models\FinalDp3;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class RekapPenilaiPersonalRawExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    // public function __construct(FinalDp3 $final)
    // {
    //     $this->final = $final;
    // }

    public function query()
    {
        return FinalDp3::query()->orderBy('npp_dinilai_id');
        // return FinalDp3::query()
        //     ->select()
        //     ->selectRaw('SUM(avg_dp3) as total')
        //     ->groupBy('npp_dinilai_id');
    }

    public function map($row): array
    {
        // return FinalDp3::all();
        return [
            $row->id,
            $row->relasi_karyawan->npp_karyawan,
            $row->relasi_karyawan->nama_karyawan,
            $row->avg_dp3,
            $row->relasi,
        ];

        // return [
        //     $row->id,
        //     $row->relasi_karyawan->npp_karyawan,
        //     $row->relasi_karyawan->nama_karyawan,
        //     $row->total,
        // ];
    }

    public function headings(): array
    {
        return [
            'id',
            'nama_dinilai',
            'npp_dinilai',
            'rerata_dp3',
            'relasi',
        ];
        // return [
        //     'id',
        //     'nama_dinilai',
        //     'npp_dinilai',
        //     'skor_dp3',
        // ];
    }
}
