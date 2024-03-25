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

    public function index_personal()
    {
        $personal = FinalDp3::with([
            'relasi_karyawan'
        ])
        ->select('id','npp_dinilai_id')
        ->selectRaw('SUM(avg_dp3) as total')->groupBy('npp_dinilai_id')->get();

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
        
        $collectionPersonal = $personal->sortBy('relasi');
        $collectionPersonal->values()->all();

        $data_karyawan = collect($collectionDp3)->unique('npp_dinilai_id');
        $data_karyawan = Arr::flatten($data_karyawan->toArray());
        // dd($collectionPersonal);
        $nama = $data_karyawan[6];
        $unit = $data_karyawan[5];
        $level = $data_karyawan[4];
        $npp = $data_karyawan[3];

        $k1 = collect($collectionPersonal)->avg('strategi_perencanaan_bobot_aspek');
        $k2 = collect($collectionPersonal)->avg('strategi_pengawasan_bobot_aspek');
        $k3 = collect($collectionPersonal)->avg('strategi_inovasi_bobot_aspek');
        $k4 = collect($collectionPersonal)->avg('kepemimpinan_bobot_aspek');
        $k5 = collect($collectionPersonal)->avg('membimbing_membangun_bobot_aspek');
        $k6 = collect($collectionPersonal)->avg('pengambilan_keputusan_bobot_aspek');
        
        $p1 = collect($collectionPersonal)->avg('kerjasama_bobot_aspek');
        $p2 = collect($collectionPersonal)->avg('komunikasi_bobot_aspek');
        $p3 = collect($collectionPersonal)->avg('absensi_bobot_aspek');
        $p4 = collect($collectionPersonal)->avg('integritas_bobot_aspek');
        $p5 = collect($collectionPersonal)->avg('etika_bobot_aspek');

        $s1 = collect($collectionPersonal)->avg('goal_kinerja_bobot_aspek');
        $s2 = collect($collectionPersonal)->avg('error_kinerja_bobot_aspek');
        $s3 = collect($collectionPersonal)->avg('proses_dokumen_bobot_aspek');
        $s4 = collect($collectionPersonal)->avg('proses_inisiatif_bobot_aspek');
        $s5 = collect($collectionPersonal)->avg('proses_polapikir_bobot_aspek');

        $raspek_k = collect($collectionPersonal)->avg('sum_nilai_k_bobot_aspek');
        $raspek_s = collect($collectionPersonal)->avg('sum_nilai_s_bobot_aspek');
        $raspek_p = collect($collectionPersonal)->avg('sum_nilai_p_bobot_aspek');

        $total_raspek = round(($raspek_k + $raspek_s + $raspek_p) * 100,2);
        
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
        $nows = Carbon::setLocale('id');
        $nows = Carbon::now()->formatLocalized("%A, %d %B %Y");

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

            'point_dp3' => $point_dp3,
            'kriteria_dp3' => $kriteria_dp3,
            'nows' => $nows,
        ]);

        $pdf->setPaper('A4');

        // return $pdf->stream();
        return $pdf->download("LAPORAN HASIL PENILAIAN KINERJA".$npp."-".$nama."-".$nows.".pdf");
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
        $getPoolRespon = PoolRespon::where('relasi', $request->relasi)->orderBy('npp_dinilai')->get();
        
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
                    return response()->json($th);
                }
            }
        }

    }

    public function final_calculate()
    {   
        $personal = RekapPenilai::select('id','relasi','npp_dinilai')
        ->selectRaw('AVG(sum_nilai_dp3) as avg_dp3')
        ->groupBy('npp_dinilai','relasi','jabatan_dinilai')
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
                            'avg_dp3' => ($items['avg_dp3'] * 100),
                            'relasi' => $items['relasi'],
                        ]);
                } catch (\Throwable $th) {
                    return response()->json($th);
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
