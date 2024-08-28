<?php

namespace App\Http\Controllers\DP3;

use App\Http\Controllers\Controller;
use App\Models\RekapPenilai;
use App\Models\RelasiKaryawan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailSkorDP3Controller extends Controller
{
    public function index($dinilai)
    {
        return view('hc.dp3.detail')->with([
            'person_nilai' => RelasiKaryawan::where('npp_karyawan', $dinilai)->first() ?? '',
            'detail_nilai' => RekapPenilai::where('npp_dinilai', $dinilai)
                                  ->select(
                                      '*',
                                      DB::raw('avg(strategi_perencanaan_bobot_aspek) as k1'),
                                      DB::raw('avg(strategi_pengawasan_bobot_aspek) as k2'),
                                      DB::raw('avg(strategi_inovasi_bobot_aspek) as k3'),
                                      DB::raw('avg(kepemimpinan_bobot_aspek) as k4'),
                                      DB::raw('avg(membimbing_membangun_bobot_aspek) as k5'),
                                      DB::raw('avg(pengambilan_keputusan_bobot_aspek) as k6'),
                                      DB::raw('avg(sum_nilai_k_bobot_aspek) as tk'),
                                      DB::raw('avg(kerjasama_bobot_aspek) as p1'),
                                      DB::raw('avg(komunikasi_bobot_aspek) as p2'),
                                      DB::raw('avg(absensi_bobot_aspek) as p3'),
                                      DB::raw('avg(integritas_bobot_aspek) as p4'),
                                      DB::raw('avg(etika_bobot_aspek) as p5'),
                                      DB::raw('avg(sum_nilai_p_bobot_aspek) as tp'),
                                      DB::raw('avg(goal_kinerja_bobot_aspek) as s1'),
                                      DB::raw('avg(error_kinerja_bobot_aspek) as s2'),
                                      DB::raw('avg(proses_dokumen_bobot_aspek) as s3'),
                                      DB::raw('avg(proses_inisiatif_bobot_aspek) as s4'),
                                      DB::raw('avg(proses_polapikir_bobot_aspek) as s5'),
                                      DB::raw('avg(sum_nilai_s_bobot_aspek) as ts'),
                                      DB::raw('avg(sum_nilai_dp3) as avg_nilai_dp3'),
                                      DB::raw('count(relasi) as jumlah_relasi')
                                  )
                                  ->orderBy('relasi')
                                  ->groupBy('relasi')
                                  ->get()
        ]);
    }

    public function viewPdf($dinilai)
    {
        // return view('hc.dp3.detail-pdf')->with([]);
        $pdf = Pdf::loadView('hc.dp3.detail-pdf', [
            'person_nilai'        => RelasiKaryawan::where('npp_karyawan', $dinilai)->first() ?? [],
            'jumlah_relasi_nilai' => RekapPenilai::where('npp_dinilai', $dinilai)
                                         ->select(
                                             'relasi',
                                             DB::raw('count(relasi) as jumlah_relasi')
                                         )
                                         ->groupBy('relasi')
                                         ->get(),
            'detail_nilai'        => RekapPenilai::where('npp_dinilai', $dinilai)
                                         ->select(
                                             '*',
                                             DB::raw('avg(strategi_perencanaan_bobot_aspek) as k1'),
                                             DB::raw('avg(strategi_pengawasan_bobot_aspek) as k2'),
                                             DB::raw('avg(strategi_inovasi_bobot_aspek) as k3'),
                                             DB::raw('avg(kepemimpinan_bobot_aspek) as k4'),
                                             DB::raw('avg(membimbing_membangun_bobot_aspek) as k5'),
                                             DB::raw('avg(pengambilan_keputusan_bobot_aspek) as k6'),
                                             DB::raw('avg(sum_nilai_k_bobot_aspek) as tk'),
                                             DB::raw('avg(kerjasama_bobot_aspek) as p1'),
                                             DB::raw('avg(komunikasi_bobot_aspek) as p2'),
                                             DB::raw('avg(absensi_bobot_aspek) as p3'),
                                             DB::raw('avg(integritas_bobot_aspek) as p4'),
                                             DB::raw('avg(etika_bobot_aspek) as p5'),
                                             DB::raw('avg(sum_nilai_p_bobot_aspek) as tp'),
                                             DB::raw('avg(goal_kinerja_bobot_aspek) as s1'),
                                             DB::raw('avg(error_kinerja_bobot_aspek) as s2'),
                                             DB::raw('avg(proses_dokumen_bobot_aspek) as s3'),
                                             DB::raw('avg(proses_inisiatif_bobot_aspek) as s4'),
                                             DB::raw('avg(proses_polapikir_bobot_aspek) as s5'),
                                             DB::raw('avg(sum_nilai_s_bobot_aspek) as ts'),
                                             DB::raw('avg(sum_nilai_dp3) as avg_nilai_dp3'),
                                             DB::raw('count(relasi) as jumlah_relasi')
                                         )
                                         ->orderBy('relasi')
                                         ->groupBy('relasi')
                                         ->get()
        ]);

        if (Auth::user()->level != 1) {
            $password = '123';
            // $users    = User::where('npp', $request->npp)->first();
            $users = Auth::user()->npp;
            if ($users) {
                $user     = $users->toArray();
                $password = $user['no_hp'];
            }
            $pdf->getCanvas()
                ->get_cpdf()
                ->setEncryption($password, $password, ['print', 'modify', 'copy', 'add']);
        }

        $pdf->setPaper('A4');

        return $pdf->stream();
    }

    public function viewPdfSimple($dinilai)
    {
        // return view('hc.dp3.detail-pdf')->with([]);
        $pdf = Pdf::loadView('hc.dp3.detail-pdf-simple', [
            'person_nilai'        => RelasiKaryawan::where('npp_karyawan', $dinilai)->first() ?? [],
            'jumlah_relasi_nilai' => RekapPenilai::where('npp_dinilai', $dinilai)
                                         ->select(
                                             'relasi',
                                             DB::raw('count(relasi) as jumlah_relasi')
                                         )
                                         ->groupBy('relasi')
                                         ->get(),
            'detail_nilai'        => RekapPenilai::where('npp_dinilai', $dinilai)
                                         ->select(
                                             '*',
                                             DB::raw('avg(strategi_perencanaan_bobot_aspek) as k1'),
                                             DB::raw('avg(strategi_pengawasan_bobot_aspek) as k2'),
                                             DB::raw('avg(strategi_inovasi_bobot_aspek) as k3'),
                                             DB::raw('avg(kepemimpinan_bobot_aspek) as k4'),
                                             DB::raw('avg(membimbing_membangun_bobot_aspek) as k5'),
                                             DB::raw('avg(pengambilan_keputusan_bobot_aspek) as k6'),
                                             DB::raw('avg(sum_nilai_k_bobot_aspek) as tk'),
                                             DB::raw('avg(kerjasama_bobot_aspek) as p1'),
                                             DB::raw('avg(komunikasi_bobot_aspek) as p2'),
                                             DB::raw('avg(absensi_bobot_aspek) as p3'),
                                             DB::raw('avg(integritas_bobot_aspek) as p4'),
                                             DB::raw('avg(etika_bobot_aspek) as p5'),
                                             DB::raw('avg(sum_nilai_p_bobot_aspek) as tp'),
                                             DB::raw('avg(goal_kinerja_bobot_aspek) as s1'),
                                             DB::raw('avg(error_kinerja_bobot_aspek) as s2'),
                                             DB::raw('avg(proses_dokumen_bobot_aspek) as s3'),
                                             DB::raw('avg(proses_inisiatif_bobot_aspek) as s4'),
                                             DB::raw('avg(proses_polapikir_bobot_aspek) as s5'),
                                             DB::raw('avg(sum_nilai_s_bobot_aspek) as ts'),
                                             DB::raw('avg(sum_nilai_dp3) as avg_nilai_dp3'),
                                             DB::raw('count(relasi) as jumlah_relasi')
                                         )
                                         ->orderBy('relasi')
                                         ->groupBy('relasi')
                                         ->get()
        ]);

        if (Auth::user()->level != 1) {
            $password = '123';
            // $users    = User::where('npp', $request->npp)->first();
            $users = Auth::user()->npp;
            if ($users) {
                $user     = $users->toArray();
                $password = $user['no_hp'];
            }
            $pdf->getCanvas()
                ->get_cpdf()
                ->setEncryption($password, $password, ['print', 'modify', 'copy', 'add']);
        }

        $pdf->setPaper('A4');

        return $pdf->stream();
    }
}
