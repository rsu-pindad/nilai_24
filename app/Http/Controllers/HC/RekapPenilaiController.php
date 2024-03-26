<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\FinalDp3;
use App\Models\PoolRespon;
use App\Models\RelasiKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RekapPenilai;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapPenilaiController extends Controller
{

    public function index()
    {
        $penilai = RekapPenilai::select()
        ->selectRaw('AVG(sum_nilai_k_bobot_aspek) as sum_k1')
        ->selectRaw('AVG(sum_nilai_s_bobot_aspek) as sum_k2')
        ->selectRaw('AVG(sum_nilai_p_bobot_aspek) as sum_k3')
        ->groupBy('npp_dinilai')->get(); 
        return view('hc.rekap.penilai.index')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_self()
    {
        $penilai = RekapPenilai::where('relasi','self')->get(); 
        return view('hc.rekap.penilai.index-self')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_atasan()
    {
        $penilai = RekapPenilai::where('relasi','atasan')->get(); 
        return view('hc.rekap.penilai.index-atasan')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_rekanan()
    {
        $penilai = RekapPenilai::where('relasi','rekanan')->get(); 
        return view('hc.rekap.penilai.index-rekanan')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_staff()
    {
        $penilai = RekapPenilai::where('relasi','staff')->get(); 
        return view('hc.rekap.penilai.index-staff')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function show(Request $request)
    {
        $penilai = RekapPenilai::with(
            [
            'relasi_karyawan',
            'relasi_respon',
            ]
            )->where('id', $request->id)->first();

        // dd($penilai);
        return view('hc.rekap.penilai.index-detail')->with([
            'data_penilai' => $penilai,
        ]);
    }
    public function showRelasi(Request $request)
    {
        $penilai = RekapPenilai::with([
            'relasi_karyawan',
            'relasi_respon',
            ])
            ->where('npp_dinilai', $request->dinilai)
            ->where('relasi', $request->relasi)
            ->first();
        
        if($penilai){
            return view('hc.rekap.penilai.index-detail')->with([
                'data_penilai' => $penilai,
            ]);
        }else{
            return abort(404);
        }
    }

    public function index_personal()
    {
        $personal = FinalDp3::with([
            'relasi_karyawan'
        ])
        ->select('id','npp_dinilai_id')
        ->selectRaw('SUM(avg_dp3) as total')
        ->groupBy('npp_dinilai_id')
        ->get();

        // return $personal->toArray();

        return view('hc.rekap.penilai.index-personal')->with([
            'personal' => $personal,
        ]);
    }

    public function report(Request $request)
    {
        $personal = RekapPenilai::select(
            "strategi_perencanaan_bobot_aspek",
            "strategi_pengawasan_bobot_aspek" ,
            "strategi_inovasi_bobot_aspek" ,
            "kepemimpinan_bobot_aspek" ,
            "membimbing_membangun_bobot_aspek" ,
            "pengambilan_keputusan_bobot_aspek" ,
            "kerjasama_bobot_aspek" ,
            "komunikasi_bobot_aspek" ,
            "absensi_bobot_aspek" ,
            "integritas_bobot_aspek" ,
            "etika_bobot_aspek" ,
            "goal_kinerja_bobot_aspek" ,
            "error_kinerja_bobot_aspek" ,
            "proses_dokumen_bobot_aspek" ,
            "proses_inisiatif_bobot_aspek" ,
            "proses_polapikir_bobot_aspek" ,
            "sum_nilai_k_bobot_aspek" ,
            "sum_nilai_s_bobot_aspek" ,
            "sum_nilai_p_bobot_aspek" ,
            "sum_nilai_dp3" ,
            "relasi" ,
        )
        ->where('npp_dinilai', $request->npp)
        ->orderBy('npp_dinilai')
        ->get();

        $dp3 = FinalDp3::with(['relasi_karyawan'])
        ->select('npp_dinilai_id')->selectRaw('sum(avg_dp3) as total')
        ->where('npp_dinilai_id', $request->id)
        ->groupBy('npp_dinilai_id')
        ->get();

        $collectionDp3 = $dp3->sortBy('relasi');
        $collectionDp3->values()->all();

        // dd($collectionDp3);
        
        $collectionPersonal = $personal->sortBy('relasi');
        $collectionPersonal->values()->all();

        $data_karyawan = collect($collectionDp3)->unique('npp_dinilai_id');
        $data_karyawan = Arr::flatten($data_karyawan->toArray());
        // dd($collectionPersonal->toArray());
        $nama = $data_karyawan[6];
        $unit = $data_karyawan[5];
        $level = $data_karyawan[4];
        $npp = $data_karyawan[3];

        // dd($collectionPersonal);
        // YANG INI DULU
        // $k1 = collect($collectionPersonal)->avg('strategi_perencanaan_bobot_aspek');
        // $k2 = collect($collectionPersonal)->avg('strategi_pengawasan_bobot_aspek');
        // $k3 = collect($collectionPersonal)->avg('strategi_inovasi_bobot_aspek');
        // $k4 = collect($collectionPersonal)->avg('kepemimpinan_bobot_aspek');
        // $k5 = collect($collectionPersonal)->avg('membimbing_membangun_bobot_aspek');
        // $k6 = collect($collectionPersonal)->avg('pengambilan_keputusan_bobot_aspek');
        
        // $p1 = collect($collectionPersonal)->avg('kerjasama_bobot_aspek');
        // $p2 = collect($collectionPersonal)->avg('komunikasi_bobot_aspek');
        // $p3 = collect($collectionPersonal)->avg('absensi_bobot_aspek');
        // $p4 = collect($collectionPersonal)->avg('integritas_bobot_aspek');
        // $p5 = collect($collectionPersonal)->avg('etika_bobot_aspek');

        // $s1 = collect($collectionPersonal)->avg('goal_kinerja_bobot_aspek');
        // $s2 = collect($collectionPersonal)->avg('error_kinerja_bobot_aspek');
        // $s3 = collect($collectionPersonal)->avg('proses_dokumen_bobot_aspek');
        // $s4 = collect($collectionPersonal)->avg('proses_inisiatif_bobot_aspek');
        // $s5 = collect($collectionPersonal)->avg('proses_polapikir_bobot_aspek');

        // $raspek_k = collect($collectionPersonal)->avg('sum_nilai_k_bobot_aspek');
        // $raspek_s = collect($collectionPersonal)->avg('sum_nilai_s_bobot_aspek');
        // $raspek_p = collect($collectionPersonal)->avg('sum_nilai_p_bobot_aspek');
        // $avg_dp3 = collect($collectionPersonal)->avg('sum_nilai_dp3');
        // $total_raspek = round(($raspek_k + $raspek_s + $raspek_p) * 100,2);

        // dd($avg_dp3 * 100);
        // dd(collect($collectionPersonal)->pluck('sum_nilai_dp3'));
        // dd(collect($collectionPersonal)->sum('sum_nilai_dp3') * 100);
        $avg_dp3_staff = [];
        $avg_dp3_non_staff = [];

        $k1_staff = [];
        $k2_staff = [];
        $k3_staff = [];
        $k4_staff = [];
        $k5_staff = [];
        $k6_staff = [];
        
        $p1_staff = [];
        $p2_staff = [];
        $p3_staff = [];
        $p4_staff = [];
        $p5_staff = [];

        $s1_staff = [];
        $s2_staff = [];
        $s3_staff = [];
        $s4_staff = [];
        $s5_staff = [];

        $raspek_k_staff = [];
        $raspek_s_staff = [];
        $raspek_p_staff = [];

        $k1_non = [];
        $k2_non = [];
        $k3_non = [];
        $k4_non = [];
        $k5_non = [];
        $k6_non = [];
        
        $p1_non = [];
        $p2_non = [];
        $p3_non = [];
        $p4_non = [];
        $p5_non = [];

        $s1_non = [];
        $s2_non = [];
        $s3_non = [];
        $s4_non = [];
        $s5_non = [];

        $raspek_k_non = [];
        $raspek_s_non = [];
        $raspek_p_non = [];
        $divider = 0;

        foreach($collectionPersonal as $keys => $item){
            if($item['relasi'] == 'staff'){
                $avg_dp3_staff[$keys]['sum_nilai_dp3'] = $item['sum_nilai_dp3'];
                $k1_staff[$keys]['k1'] = $item['strategi_perencanaan_bobot_aspek'];
                $k2_staff[$keys]['k2'] = $item['strategi_pengawasan_bobot_aspek'];
                $k3_staff[$keys]['k3'] = $item['strategi_inovasi_bobot_aspek'];
                $k4_staff[$keys]['k4'] = $item['kepemimpinan_bobot_aspek'];
                $k5_staff[$keys]['k5'] = $item['membimbing_membangun_bobot_aspek'];
                $k6_staff[$keys]['k6'] = $item['pengambilan_keputusan_bobot_aspek'];
                
                $p1_staff[$keys]['p1'] = $item['kerjasama_bobot_aspek'];
                $p2_staff[$keys]['p2'] = $item['komunikasi_bobot_aspek'];
                $p3_staff[$keys]['p3'] = $item['absensi_bobot_aspek'];
                $p4_staff[$keys]['p4'] = $item['integritas_bobot_aspek'];
                $p5_staff[$keys]['p5'] = $item['etika_bobot_aspek'];

                $s1_staff[$keys]['s1'] = $item['goal_kinerja_bobot_aspek'];
                $s2_staff[$keys]['s2'] = $item['error_kinerja_bobot_aspek'];
                $s3_staff[$keys]['s3'] = $item['proses_dokumen_bobot_aspek'];
                $s4_staff[$keys]['s4'] = $item['proses_inisiatif_bobot_aspek'];
                $s5_staff[$keys]['s5'] = $item['proses_polapikir_bobot_aspek'];

                $raspek_k_staff[$keys]['raspek_k'] = $item['sum_nilai_k_bobot_aspek'];
                $raspek_s_staff[$keys]['raspek_s'] = $item['sum_nilai_s_bobot_aspek'];
                $raspek_p_staff[$keys]['raspek_p'] = $item['sum_nilai_p_bobot_aspek'];
            }else{
                $avg_dp3_non_staff[$keys]['sum_nilai_dp3'] = $item['sum_nilai_dp3'];
                $k1_non[$keys]['k1'] = $item['strategi_perencanaan_bobot_aspek'];
                $k2_non[$keys]['k2'] = $item['strategi_pengawasan_bobot_aspek'];
                $k3_non[$keys]['k3'] = $item['strategi_inovasi_bobot_aspek'];
                $k4_non[$keys]['k4'] = $item['kepemimpinan_bobot_aspek'];
                $k5_non[$keys]['k5'] = $item['membimbing_membangun_bobot_aspek'];
                $k6_non[$keys]['k6'] = $item['pengambilan_keputusan_bobot_aspek'];
                
                $p1_non[$keys]['p1'] = $item['kerjasama_bobot_aspek'];
                $p2_non[$keys]['p2'] = $item['komunikasi_bobot_aspek'];
                $p3_non[$keys]['p3'] = $item['absensi_bobot_aspek'];
                $p4_non[$keys]['p4'] = $item['integritas_bobot_aspek'];
                $p5_non[$keys]['p5'] = $item['etika_bobot_aspek'];

                $s1_non[$keys]['s1'] = $item['goal_kinerja_bobot_aspek'];
                $s2_non[$keys]['s2'] = $item['error_kinerja_bobot_aspek'];
                $s3_non[$keys]['s3'] = $item['proses_dokumen_bobot_aspek'];
                $s4_non[$keys]['s4'] = $item['proses_inisiatif_bobot_aspek'];
                $s5_non[$keys]['s5'] = $item['proses_polapikir_bobot_aspek'];

                $raspek_k_non[$keys]['raspek_k'] = $item['sum_nilai_k_bobot_aspek'];
                $raspek_s_non[$keys]['raspek_s'] = $item['sum_nilai_s_bobot_aspek'];
                $raspek_p_non[$keys]['raspek_p'] = $item['sum_nilai_p_bobot_aspek'];
                $divider++;
            }
        }
        $bil1 = collect($avg_dp3_staff)->avg('sum_nilai_dp3');
        $bil2 = collect($avg_dp3_non_staff)->sum('sum_nilai_dp3');
        $total_raspek = round(($bil1 + $bil2) * 100,2);
        // $total_raspek = ($bil1 + $bil2);
        // dd($total_raspek);

        $k1_mentah = collect($k1_staff)->avg('k1') + collect($k1_non)->sum('k1');
        $k2_mentah = collect($k2_staff)->avg('k2') + collect($k2_non)->sum('k2');
        $k3_mentah = collect($k3_staff)->avg('k3') + collect($k3_non)->sum('k3');
        $k4_mentah = collect($k4_staff)->avg('k4') + collect($k4_non)->sum('k4');
        $k5_mentah = collect($k5_staff)->avg('k5') + collect($k5_non)->sum('k5');
        $k6_mentah = collect($k6_staff)->avg('k6') + collect($k6_non)->sum('k6');
        
        $p1_mentah = collect($p1_staff)->avg('p1') + collect($p1_non)->sum('p1');
        $p2_mentah = collect($p2_staff)->avg('p2') + collect($p2_non)->sum('p2');
        $p3_mentah = collect($p3_staff)->avg('p3') + collect($p3_non)->sum('p3');
        $p4_mentah = collect($p4_staff)->avg('p4') + collect($p4_non)->sum('p4');
        $p5_mentah = collect($p5_staff)->avg('p5') + collect($p5_non)->sum('p5');

        $s1_mentah = collect($s1_staff)->avg('s1') + collect($s1_non)->sum('s1');
        $s2_mentah = collect($s2_staff)->avg('s2') + collect($s2_non)->sum('s2');
        $s3_mentah = collect($s3_staff)->avg('s3') + collect($s3_non)->sum('s3');
        $s4_mentah = collect($s4_staff)->avg('s4') + collect($s4_non)->sum('s4');
        $s5_mentah = collect($s5_staff)->avg('s5') + collect($s5_non)->sum('s5');

        $raspek_k_mentah = collect($raspek_k_staff)->avg('raspek_k') + collect($raspek_k_non)->sum('raspek_k');
        $raspek_s_mentah = collect($raspek_s_staff)->avg('raspek_s') + collect($raspek_s_non)->sum('raspek_s');
        $raspek_p_mentah = collect($raspek_p_staff)->avg('raspek_p') + collect($raspek_p_non)->sum('raspek_p');

        $k1 = $k1_mentah / ($divider+1);
        $k2 = $k2_mentah / ($divider+1);
        $k3 = $k3_mentah / ($divider+1);
        $k4 = $k4_mentah / ($divider+1);
        $k5 = $k5_mentah / ($divider+1);
        $k6 = $k6_mentah / ($divider+1);
        
        $p1 = $p1_mentah / ($divider+1);
        $p2 = $p2_mentah / ($divider+1);
        $p3 = $p3_mentah / ($divider+1);
        $p4 = $p4_mentah / ($divider+1);
        $p5 = $p5_mentah / ($divider+1);

        $s1 = $s1_mentah / ($divider+1);
        $s2 = $s2_mentah / ($divider+1);
        $s3 = $s3_mentah / ($divider+1);
        $s4 = $s4_mentah / ($divider+1);
        $s5 = $s5_mentah / ($divider+1);

        $raspek_k = $raspek_k_mentah / ($divider+1);
        $raspek_s = $raspek_s_mentah / ($divider+1);
        $raspek_p = $raspek_p_mentah / ($divider+1);

        // dd($divider);

        $point_dp3 = 0;
        $kriteria_dp3 = '';
        // dd($total_raspek);
        if ($total_raspek > 95) {
            $kriteria_dp3 = 'Sangat Baik';
            $point_dp3 = 4;
        } elseif ($total_raspek > 85 && $total_raspek <= 95) {
            $kriteria_dp3 = 'Baik';
            $point_dp3 = 3;
        } elseif ($total_raspek > 65 && $total_raspek <= 85) {
            $kriteria_dp3 = 'Cukup';
            $point_dp3 = 2;
        } elseif ($total_raspek > 50 && $total_raspek <= 65) {
            $kriteria_dp3 = 'Kurang';
            $point_dp3 = 1;
        } else {
            $kriteria_dp3 = 'Sangat Kurang';
        }
        setlocale(LC_TIME, 'id_ID');
        // $nows = Carbon::setLocale('id');
        // $nows = Carbon::now()->formatLocalized("%A, %d %B %Y");

        $nows = Carbon::now()->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('hc.rekap.penilai.pdf-personal', [
            'nama' => $nama,
            'unit' => $unit,
            'level' => $level,
            'npp' => $npp,
            'k1' => $k1,
            'k2' => $k2,
            'k3' => $k3,
            'k4' => $k4,
            'k5' => $k5,
            'k6' => $k6,

            'p1' => $p1,
            'p2' => $p2,
            'p3' => $p3,
            'p4' => $p4,
            'p5' => $p5,

            's1' => $s1,
            's2' => $s2,
            's3' => $s3,
            's4' => $s4,
            's5' => $s5,

            'raspek_k' => $raspek_k,
            'raspek_p' => $raspek_p,
            'raspek_s' => $raspek_s,
            'total_raspek' => $total_raspek,

            'point_dp3' => $point_dp3,
            'kriteria_dp3' => $kriteria_dp3,
            'nows' => $nows,
        ]);

        $pdf->setPaper('A4');

        return $pdf->stream();
        // return $pdf->download("LAPORAN HASIL PENILAIAN KINERJA".$npp."-".$nama."-".$nows.".pdf");
    }

    public function rekapitulasi(Request $request)
    {
        // $self = RekapPenilai::where('npp_dinilai', $request->npp)->where('relasi', 'self')->orderBy('relasi')->get();
        // $atasan = RekapPenilai::where('npp_dinilai', $request->npp)->where('relasi', 'atasan')->orderBy('relasi')->get();
        // $rekanan = RekapPenilai::where('npp_dinilai', $request->npp)->where('relasi', 'rekanan')->orderBy('relasi')->get();
        // $staff = RekapPenilai::where('npp_dinilai', $request->npp)->where('relasi', 'staff')->orderBy('relasi')->get();
        // dd($staff);
        $karyawan = RelasiKaryawan::where('npp_karyawan', $request->npp)->first()->toArray();
        // dd($karyawan->toArray());
        $nilai = FinalDp3::with([
            'relasi_karyawan'
        ])
        ->select('id', 'npp_dinilai_id')
        ->selectRaw('SUM(avg_dp3) as total')
        ->where('npp_dinilai_id',  $karyawan['id'])
        ->groupBy('npp_dinilai_id')->get();

        // dd($nilai);
        return view('rekap-nilai')->with([
            'nilai' => $nilai,
            // 'nilai_self' => $self,
            // 'nilai_atasan' => $atasan,
            // 'nilai_rekanan' => $rekanan,
            // 'nilai_staff' => $staff,
        ]);
    }

    public function calculate(Request $request)
    {
        $getPoolRespon = [];
        if($request->relasi != 'all'){
            $getPoolRespon = PoolRespon::where('relasi', $request->relasi)->orderBy('npp_dinilai')->get();
        }else{
            $getPoolRespon = PoolRespon::orderby('npp_dinilai')->get();
        }

        // dd($getPoolRespon);
        
        $bobot_penilai = 0;

        $collection = [];
        $aspek_k = 0; // 3
        $aspek_p = 0; // 1
        $aspek_s = 0; // 2

        $penilai_atasan = 0;
        $penilai_rekanan = 0;
        $penilai_staff = 0;
        $penilai_self = 0;
        foreach($getPoolRespon as $key => $items)
        {
            // Cari data penilai karyawan 
            $penilaiKaryawan = RelasiKaryawan::where('id',$items['npp_penilai'])->first();
            if($penilaiKaryawan){
                $penilaiKaryawan->toArray();
                // Untuk Pengkalian Bobot setelah skor di dapat
                if(Str::remove(' ',$items['jabatan_dinilai']) == 'IA' || Str::remove(' ',$items['jabatan_dinilai']) == 'IC'){
                    $aspek_k = 0.40; // 3
                    $aspek_p = 0.25; // 1
                    $aspek_s = 0.35; // 2

                    $penilai_atasan = 0.60;
                    $penilai_rekanan = 0.20;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                }elseif(Str::remove(' ',$items['jabatan_dinilai']) == 'II' || Str::remove(' ',$items['jabatan_dinilai']) == 'IINS'){
                    $aspek_k = 0.35;
                    $aspek_p = 0.25;
                    $aspek_s = 0.40;

                    $penilai_atasan = 0.60;
                    $penilai_rekanan = 0.20;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                }elseif(Str::remove(' ',$items['jabatan_dinilai']) == 'III'){
                    $aspek_k = 0.30;
                    $aspek_p = 0.25;
                    $aspek_s = 0.45;

                    $penilai_atasan = 0.60;
                    $penilai_rekanan = 0.20;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                }elseif(Str::remove(' ',$items['jabatan_dinilai']) == 'IV' || Str::remove(' ',$items['jabatan_dinilai']) == 'IVA'){
                    $aspek_k = 0.10;
                    $aspek_p = 0.30;
                    $aspek_s = 0.60;

                    $penilai_atasan = 0.60;
                    $penilai_rekanan = 0.20;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                }else{
                    $aspek_k = 0;
                    $aspek_p = 0.35;
                    $aspek_s = 0.65;

                    $penilai_atasan = 0.65;
                    $penilai_rekanan = 0.25;
                    $penilai_staff = 0;
                    $penilai_self = 0.10;
                }

                if($items['relasi'] == 'self'){
                    $bobot_penilai = $penilai_self;
                }
                elseif($items['relasi'] == 'atasan')
                {
                    $bobot_penilai = $penilai_atasan;
                }
                elseif($items['relasi'] == 'rekanan')
                {
                    $bobot_penilai = $penilai_rekanan;
                }
                elseif($items['relasi'] == 'staff')
                {
                    $bobot_penilai = $penilai_staff;
                }

                // $collection['pool_respon_id'] = $items['id'];
                // Kepemimpinan
                $collection['strategi_perencanaan_bobot_aspek'] = round(round($items['strategi_perencanaan'] / 30, 4) * $aspek_k,4);
                $collection['strategi_pengawasan_bobot_aspek'] = round(round($items['strategi_pengawasan'] / 30, 4) * $aspek_k,4);
                $collection['strategi_inovasi_bobot_aspek'] = round(round($items['strategi_inovasi'] / 30, 4) * $aspek_k,4);
                $collection['kepemimpinan_bobot_aspek'] = round(round($items['kepemimpinan'] / 30, 4) * $aspek_k,4);
                $collection['membimbing_membangun_bobot_aspek'] = round(round($items['membimbing_membangun'] / 30, 4) * $aspek_k,4);
                $collection['pengambilan_keputusan_bobot_aspek'] = round(round($items['pengambilan_keputusan'] / 30, 4) * $aspek_k,4);
                
                // $collection['strategi_perencanaan_bobot_penilai'] = round($collection['strategi_perencanaan_bobot_aspek'] * $bobot_penilai,4);
                // $collection['strategi_pengawasan_bobot_penilai'] = round($collection['strategi_pengawasan_bobot_aspek'] * $bobot_penilai,4);
                // $collection['strategi_inovasi_bobot_penilai'] = round($collection['strategi_inovasi_bobot_aspek'] * $bobot_penilai,4);
                // $collection['kepemimpinan_bobot_penilai'] = round($collection['kepemimpinan_bobot_aspek'] * $bobot_penilai,4);
                // $collection['membimbing_membangun_bobot_penilai'] = round($collection['membimbing_membangun_bobot_aspek'] * $bobot_penilai,4);
                // $collection['pengambilan_keputusan_bobot_penilai'] = round($collection['pengambilan_keputusan_bobot_aspek'] * $bobot_penilai,4);

                $collection['sum_nilai_k_bobot_aspek'] = 
                $collection['strategi_perencanaan_bobot_aspek'] +
                $collection['strategi_pengawasan_bobot_aspek'] +
                $collection['strategi_inovasi_bobot_aspek'] +
                $collection['kepemimpinan_bobot_aspek'] +
                $collection['membimbing_membangun_bobot_aspek'] +
                $collection['pengambilan_keputusan_bobot_aspek'];

                // Perilaku
                $collection['kerjasama_bobot_aspek'] = round(round($items['kerjasama'] / 25, 4) * $aspek_p,4);
                $collection['komunikasi_bobot_aspek'] = round(round($items['komunikasi'] / 25, 4) * $aspek_p,4);
                $collection['absensi_bobot_aspek'] = round(round($items['absensi'] / 25, 4) * $aspek_p,4);
                $collection['integritas_bobot_aspek'] = round(round($items['integritas'] / 25, 4) * $aspek_p,4);
                $collection['etika_bobot_aspek'] = round(round($items['etika'] / 25, 4) * $aspek_p,4);

                // $collection['kerjasama_bobot_penilai'] = round($collection['kerjasama_bobot_aspek'] * $bobot_penilai,4);
                // $collection['komunikasi_bobot_penilai'] = round($collection['komunikasi_bobot_aspek'] * $bobot_penilai,4);
                // $collection['absensi_bobot_penilai'] = round($collection['absensi_bobot_aspek'] * $bobot_penilai,4);
                // $collection['integritas_bobot_penilai'] = round($collection['integritas_bobot_aspek'] * $bobot_penilai,4);
                // $collection['etika_bobot_penilai'] = round($collection['etika_bobot_aspek'] * $bobot_penilai,4);

                $collection['sum_nilai_p_bobot_aspek'] = 
                $collection['kerjasama_bobot_aspek'] +
                $collection['komunikasi_bobot_aspek'] +
                $collection['absensi_bobot_aspek'] +
                $collection['integritas_bobot_aspek'] +
                $collection['etika_bobot_aspek'];

                // Sasaran
                $collection['goal_kinerja_bobot_aspek'] = round(round($items['goal_kinerja'] / 25, 4) * $aspek_s,4);
                $collection['error_kinerja_bobot_aspek'] = round(round($items['error_kinerja'] / 25, 4) * $aspek_s,4);
                $collection['proses_dokumen_bobot_aspek'] = round(round($items['proses_dokumen'] / 25, 4) * $aspek_s,4);
                $collection['proses_inisiatif_bobot_aspek'] = round(round($items['proses_inisiatif'] / 25, 4) * $aspek_s,4);
                $collection['proses_polapikir_bobot_aspek'] = round(round($items['proses_polapikir'] / 25, 4) * $aspek_s,4);

                // $collection['goal_kinerja_bobot_penilai'] = round($collection['goal_kinerja_bobot_aspek'] * $bobot_penilai,4);
                // $collection['error_kinerja_bobot_penilai'] = round($collection['error_kinerja_bobot_aspek'] * $bobot_penilai,4);
                // $collection['proses_dokumen_bobot_penilai'] = round($collection['proses_dokumen_bobot_aspek'] * $bobot_penilai,4);
                // $collection['proses_inisiatif_bobot_penilai'] = round($collection['proses_inisiatif_bobot_aspek'] * $bobot_penilai,4);
                // $collection['proses_polapikir_bobot_penilai'] = round($collection['proses_polapikir_bobot_aspek'] * $bobot_penilai,4);

                $collection['sum_nilai_s_bobot_aspek'] = 
                $collection['goal_kinerja_bobot_aspek'] +
                $collection['error_kinerja_bobot_aspek'] +
                $collection['proses_dokumen_bobot_aspek'] +
                $collection['proses_inisiatif_bobot_aspek'] +
                $collection['proses_polapikir_bobot_aspek'];
                
                // Kepemimpinan
                // $collection['sum_nilai_k_bobot_penilai'] =
                // $collection['strategi_perencanaan_bobot_penilai'] +
                // $collection['strategi_pengawasan_bobot_penilai'] +
                // $collection['strategi_inovasi_bobot_penilai'] +
                // $collection['kepemimpinan_bobot_penilai'] +
                // $collection['membimbing_membangun_bobot_penilai'] +
                // $collection['pengambilan_keputusan_bobot_penilai'];

                // Perilaku
                // $collection['sum_nilai_p_bobot_penilai'] =
                // $collection['kerjasama_bobot_penilai'] +
                // $collection['komunikasi_bobot_penilai'] +
                // $collection['absensi_bobot_penilai'] +
                // $collection['integritas_bobot_penilai'] +
                // $collection['etika_bobot_penilai'];

                // Sasaran  
                // $collection['sum_nilai_s_bobot_penilai'] = 
                // $collection['goal_kinerja_bobot_penilai'] +
                // $collection['error_kinerja_bobot_penilai'] +
                // $collection['proses_dokumen_bobot_penilai'] +
                // $collection['proses_inisiatif_bobot_penilai'] +
                // $collection['proses_polapikir_bobot_penilai'];

                $collection['sum_nilai_dp3'] = round((
                    $collection['sum_nilai_k_bobot_aspek'] + 
                    $collection['sum_nilai_s_bobot_aspek'] +
                    $collection['sum_nilai_p_bobot_aspek']
                    ) * $bobot_penilai,4);
                try {
                    $store = RekapPenilai::updateOrCreate(
                        [
                            'pool_respon_id' => $items['id'],
                        ],
                        [
                            'npp_penilai' => $penilaiKaryawan['id'],
                            'npp_dinilai' => $items['npp_dinilai'],
                            'jabatan_penilai' => $penilaiKaryawan['level_jabatan'],
                            'jabatan_dinilai' => $items['jabatan_dinilai'],
                            'strategi_perencanaan_bobot_aspek' => $collection['strategi_perencanaan_bobot_aspek'],
                            // 'strategi_perencanaan_bobot_penilai' => $collection['strategi_perencanaan_bobot_penilai'],
                            'strategi_pengawasan_bobot_aspek' => $collection['strategi_pengawasan_bobot_aspek'],
                            // 'strategi_pengawasan_bobot_penilai' => $collection['strategi_pengawasan_bobot_penilai'],
                            'strategi_inovasi_bobot_aspek' => $collection['strategi_inovasi_bobot_aspek'],
                            // 'strategi_inovasi_bobot_penilai' => $collection['strategi_inovasi_bobot_penilai'],
                            'kepemimpinan_bobot_aspek' => $collection['kepemimpinan_bobot_aspek'],
                            // 'kepemimpinan_bobot_penilai' => $collection['kepemimpinan_bobot_penilai'],
                            'membimbing_membangun_bobot_aspek' => $collection['membimbing_membangun_bobot_aspek'],
                            // 'membimbing_membangun_bobot_penilai' => $collection['membimbing_membangun_bobot_penilai'],
                            'pengambilan_keputusan_bobot_aspek' => $collection['pengambilan_keputusan_bobot_aspek'],
                            // 'pengambilan_keputusan_bobot_penilai' => $collection['pengambilan_keputusan_bobot_penilai'],

                            'kerjasama_bobot_aspek' => $collection['kerjasama_bobot_aspek'],
                            // 'kerjasama_bobot_penilai' => $collection['kerjasama_bobot_penilai'],
                            'komunikasi_bobot_aspek' => $collection['komunikasi_bobot_aspek'],
                            // 'komunikasi_bobot_penilai' => $collection['komunikasi_bobot_penilai'],
                            'absensi_bobot_aspek' => $collection['absensi_bobot_aspek'],
                            // 'absensi_bobot_penilai' => $collection['absensi_bobot_penilai'],
                            'integritas_bobot_aspek' => $collection['integritas_bobot_aspek'],
                            // 'integritas_bobot_penilai' => $collection['integritas_bobot_penilai'],
                            'etika_bobot_aspek' => $collection['etika_bobot_aspek'],
                            // 'etika_bobot_penilai' => $collection['etika_bobot_penilai'],

                            'goal_kinerja_bobot_aspek' => $collection['goal_kinerja_bobot_aspek'],
                            // 'goal_kinerja_bobot_penilai' => $collection['goal_kinerja_bobot_penilai'],
                            'error_kinerja_bobot_aspek' => $collection['error_kinerja_bobot_aspek'],
                            // 'error_kinerja_bobot_penilai' => $collection['error_kinerja_bobot_penilai'],
                            'proses_dokumen_bobot_aspek' => $collection['proses_dokumen_bobot_aspek'],
                            // 'proses_dokumen_bobot_penilai' => $collection['proses_dokumen_bobot_penilai'],
                            'proses_inisiatif_bobot_aspek' => $collection['proses_inisiatif_bobot_aspek'],
                            // 'proses_inisiatif_bobot_penilai' => $collection['proses_inisiatif_bobot_penilai'],
                            'proses_polapikir_bobot_aspek' => $collection['proses_polapikir_bobot_aspek'],
                            // 'proses_polapikir_bobot_penilai' => $collection['proses_polapikir_bobot_penilai'],

                            'sum_nilai_k_bobot_aspek' => $collection['sum_nilai_k_bobot_aspek'],
                            // 'sum_nilai_k_bobot_penilai' => $collection['sum_nilai_k_bobot_penilai'],
                            'sum_nilai_s_bobot_aspek' => $collection['sum_nilai_s_bobot_aspek'],
                            // 'sum_nilai_s_bobot_penilai' => $collection['sum_nilai_s_bobot_penilai'],
                            'sum_nilai_p_bobot_aspek' => $collection['sum_nilai_p_bobot_aspek'],
                            // 'sum_nilai_p_bobot_penilai' => $collection['sum_nilai_p_bobot_penilai'],
                            'sum_nilai_dp3' => $collection['sum_nilai_dp3'],

                            'relasi' => $items['relasi'],
                        ]
                    );
                } catch (\Throwable $th) {
                    // return response()->json($th);
                    continue;
                }
            }
        }

    }

    public function final_calculate()
    {   
        $personal = RekapPenilai::select('id','relasi','npp_dinilai')
        ->selectRaw('AVG(sum_nilai_dp3) as avg_dp3')
        ->groupBy('npp_dinilai','relasi')
        ->get();

        $personals = $personal->toArray();
        // if($personal > 0){
        //     FinalDp3::truncate();
        // }
        foreach($personals as $key => $items)
        {
            $idKaryawan = RelasiKaryawan::where('npp_karyawan', $items['npp_dinilai'])->first();
            if($idKaryawan){
                $idKaryawan->toArray();
                // FinalDp3::truncate();
                try {
                    $store = FinalDp3::updateOrCreate([
                            'npp_dinilai_id' => $idKaryawan['id'],
                            'avg_dp3' => round(($items['avg_dp3'] * 100),4),
                            'relasi' => $items['relasi'],
                        ]);
                    // if($store){
                    //     logger($items->id);
                    // }
                } catch (\Throwable $th) {
                    // return response()->json($th);
                    // logger($items->id);
                    continue;
                }
            }
        }
        
        return response()->json([
            'title' => 'calculate dp3',
            'message' => 'berhasil, sip',
            'icon' => 'success',
        ], 200);
    }
}
