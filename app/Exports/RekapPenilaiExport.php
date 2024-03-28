<?php

namespace App\Exports;

use App\Models\RekapPenilai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapPenilaiExport implements FromView
{
    public function view(): View
    {
        $rekap = RekapPenilai::select()
        ->selectRaw('AVG(sum_nilai_k_bobot_aspek) as sum_k1')
        ->selectRaw('AVG(sum_nilai_s_bobot_aspek) as sum_k2')
        ->selectRaw('AVG(sum_nilai_p_bobot_aspek) as sum_k3')
        ->groupBy('npp_dinilai')->get(); 
        return view('hc.rekap.penilai.export.group')->with([
            'data' => $rekap,
        ]);
    }
}
