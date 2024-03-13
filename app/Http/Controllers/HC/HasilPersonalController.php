<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\HasilPersonal;
use App\Models\RelasiAtasan;
use App\Models\RelasiKaryawan;
use App\Models\PoolRespon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HasilPersonalController extends Controller
{
    public function index()
    {
        $rekap_personal_data = HasilPersonal::get(); 
        return view('hc.rekap.personal.index')->with([
            'rekap_personal_data' => $rekap_personal_data,
        ]);
    }

    public function calculate()
    {
        $rekapbobot = DB::table('rekap_bobot_kepemimpinan')
            ->join('rekap_non_bobot_kepemimpinan', 'rekap_bobot_kepemimpinan.tnb_kepemimpinan_id', '=', 'rekap_non_bobot_kepemimpinan.id')

            ->join('rekap_bobot_perilaku', 'rekap_bobot_kepemimpinan.npp_dinilai_id', '=', 'rekap_bobot_perilaku.npp_dinilai_id')
            
            ->join('rekap_non_bobot_perilaku', 'rekap_bobot_perilaku.tnb_perilaku_id', '=', 'rekap_non_bobot_perilaku.id')

            ->join('rekap_bobot_sasaran', 'rekap_bobot_kepemimpinan.npp_dinilai_id', '=', 'rekap_bobot_sasaran.npp_dinilai_id')

            ->join('rekap_non_bobot_sasaran', 'rekap_bobot_sasaran.tnb_sasaran_id', '=', 'rekap_non_bobot_sasaran.id')
            ->join('pool_respon', 'rekap_non_bobot_kepemimpinan.pool_respon_id', '=', 'pool_respon.id')
            ->select(
                'pool_respon.id',
                'pool_respon.npp_penilai',
                'rekap_bobot_kepemimpinan.id', 
                'rekap_bobot_kepemimpinan.tnb_kepemimpinan_id',
                'rekap_bobot_kepemimpinan.npp_dinilai_id', 
                'rekap_bobot_kepemimpinan.sum_kb_1', 
                'rekap_bobot_kepemimpinan.sum_kb_2', 
                'rekap_bobot_kepemimpinan.sum_kb_3', 
                'rekap_bobot_kepemimpinan.sum_kb_4', 
                'rekap_bobot_kepemimpinan.sum_kb_5', 
                'rekap_bobot_kepemimpinan.sum_kb_6', 
                'rekap_non_bobot_kepemimpinan.k_1_self',
                'rekap_non_bobot_kepemimpinan.k_2_self',
                'rekap_non_bobot_kepemimpinan.k_3_self',
                'rekap_non_bobot_kepemimpinan.k_4_self',
                'rekap_non_bobot_kepemimpinan.k_5_self',
                'rekap_non_bobot_kepemimpinan.k_6_self',
                'rekap_non_bobot_kepemimpinan.k_1_atasan',
                'rekap_non_bobot_kepemimpinan.k_2_atasan',
                'rekap_non_bobot_kepemimpinan.k_3_atasan',
                'rekap_non_bobot_kepemimpinan.k_4_atasan',
                'rekap_non_bobot_kepemimpinan.k_5_atasan',
                'rekap_non_bobot_kepemimpinan.k_6_atasan',
                'rekap_non_bobot_kepemimpinan.k_1_rekan',
                'rekap_non_bobot_kepemimpinan.k_2_rekan',
                'rekap_non_bobot_kepemimpinan.k_3_rekan',
                'rekap_non_bobot_kepemimpinan.k_4_rekan',
                'rekap_non_bobot_kepemimpinan.k_5_rekan',
                'rekap_non_bobot_kepemimpinan.k_6_rekan',
                'rekap_non_bobot_kepemimpinan.k_1_staff',
                'rekap_non_bobot_kepemimpinan.k_2_staff',
                'rekap_non_bobot_kepemimpinan.k_3_staff',
                'rekap_non_bobot_kepemimpinan.k_4_staff',
                'rekap_non_bobot_kepemimpinan.k_5_staff',
                'rekap_non_bobot_kepemimpinan.k_6_staff',
                'rekap_bobot_perilaku.sum_pb_1', 
                'rekap_bobot_perilaku.sum_pb_2', 
                'rekap_bobot_perilaku.sum_pb_3', 
                'rekap_bobot_perilaku.sum_pb_4', 
                'rekap_bobot_perilaku.sum_pb_5', 
                'rekap_non_bobot_perilaku.p_1_self',
                'rekap_non_bobot_perilaku.p_2_self',
                'rekap_non_bobot_perilaku.p_3_self',
                'rekap_non_bobot_perilaku.p_4_self',
                'rekap_non_bobot_perilaku.p_5_self',
                'rekap_non_bobot_perilaku.p_1_atasan',
                'rekap_non_bobot_perilaku.p_2_atasan',
                'rekap_non_bobot_perilaku.p_3_atasan',
                'rekap_non_bobot_perilaku.p_4_atasan',
                'rekap_non_bobot_perilaku.p_5_atasan',
                'rekap_non_bobot_perilaku.p_1_rekan',
                'rekap_non_bobot_perilaku.p_2_rekan',
                'rekap_non_bobot_perilaku.p_3_rekan',
                'rekap_non_bobot_perilaku.p_4_rekan',
                'rekap_non_bobot_perilaku.p_5_rekan',
                'rekap_non_bobot_perilaku.p_1_staff',
                'rekap_non_bobot_perilaku.p_2_staff',
                'rekap_non_bobot_perilaku.p_3_staff',
                'rekap_non_bobot_perilaku.p_4_staff',
                'rekap_non_bobot_perilaku.p_5_staff',
                'rekap_bobot_sasaran.sum_sb_1',
                'rekap_bobot_sasaran.sum_sb_2',
                'rekap_bobot_sasaran.sum_sb_3',
                'rekap_bobot_sasaran.sum_sb_4',
                'rekap_bobot_sasaran.sum_sb_5',
                'rekap_non_bobot_sasaran.s_1_self',
                'rekap_non_bobot_sasaran.s_2_self',
                'rekap_non_bobot_sasaran.s_3_self',
                'rekap_non_bobot_sasaran.s_4_self',
                'rekap_non_bobot_sasaran.s_5_self',
                'rekap_non_bobot_sasaran.s_1_atasan',
                'rekap_non_bobot_sasaran.s_2_atasan',
                'rekap_non_bobot_sasaran.s_3_atasan',
                'rekap_non_bobot_sasaran.s_4_atasan',
                'rekap_non_bobot_sasaran.s_5_atasan',
                'rekap_non_bobot_sasaran.s_1_rekan',
                'rekap_non_bobot_sasaran.s_2_rekan',
                'rekap_non_bobot_sasaran.s_3_rekan',
                'rekap_non_bobot_sasaran.s_4_rekan',
                'rekap_non_bobot_sasaran.s_5_rekan',
                'rekap_non_bobot_sasaran.s_1_staff',
                'rekap_non_bobot_sasaran.s_2_staff',
                'rekap_non_bobot_sasaran.s_3_staff',
                'rekap_non_bobot_sasaran.s_4_staff',
                'rekap_non_bobot_sasaran.s_5_staff',
                )
            ->get()->toBase();
        // dd($rekapbobot);

        $collection = [];

        foreach($rekapbobot as $key => $val){
            // dd($val->sum_sb_5);
            // if()
            $find_jabatan_dinilai = RelasiKaryawan::find($val->npp_dinilai_id)->select('level_jabatan')->first()->toArray();
            // dd($val);
            $kali_k = 0;
            $kali_p = 0;
            $kali_s = 0;
            if(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IA' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IC'){
                $kali_k = 0.50;
                $kali_p = 0.25;
                $kali_s = 0.25;
            }elseif(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'II' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IINS'){
                $kali_k = 0.45;
                $kali_p = 0.25;
                $kali_s = 0.30;
            }elseif(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'III'){
                $kali_k = 0.40;
                $kali_p = 0.25;
                $kali_s = 0.35;
            }elseif(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IV' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IVA'){
                $kali_k = 0.10;
                $kali_p = 0.30;
                $kali_s = 0.60;
            }else{
                $kali_k = 0;
                $kali_p = 0.35;
                $kali_s = 0.65;
            }
            // dd($find_jabatan_dinilai);
            // if(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) != 'IVB' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) != 'V'){
                $collection['npp_dinilai_id'] = $val->npp_dinilai_id;
                $collection['k_avg_1'] = (  
                                            $val->k_1_self + 
                                            $val->k_1_atasan +
                                            $val->k_1_rekan +
                                            $val->k_1_staff
                                        );
                $collection['k_avg_2'] = (  
                                            $val->k_2_self + 
                                            $val->k_2_atasan +
                                            $val->k_2_rekan +
                                            $val->k_2_staff
                                        );
                $collection['k_avg_3'] = (  
                                            $val->k_3_self + 
                                            $val->k_3_atasan +
                                            $val->k_3_rekan +
                                            $val->k_3_staff
                                        );
                $collection['k_avg_4'] = (  
                                            $val->k_4_self + 
                                            $val->k_4_atasan +
                                            $val->k_4_rekan +
                                            $val->k_4_staff
                                        );
                $collection['k_avg_5'] = (  
                                            $val->k_5_self + 
                                            $val->k_5_atasan +
                                            $val->k_5_rekan +
                                            $val->k_5_staff
                                        );
                $collection['k_avg_6'] = (  
                                            $val->k_6_self + 
                                            $val->k_6_atasan +
                                            $val->k_6_rekan +
                                            $val->k_6_staff
                                        );
                
                $collection['p_avg_1'] = (  
                                            $val->p_1_self + 
                                            $val->p_1_atasan +
                                            $val->p_1_rekan +
                                            $val->p_1_staff
                                        );
                $collection['p_avg_2'] = (  
                                            $val->p_2_self + 
                                            $val->p_2_atasan +
                                            $val->p_2_rekan +
                                            $val->p_2_staff
                                        );
                $collection['p_avg_3'] = (  
                                            $val->p_3_self + 
                                            $val->p_3_atasan +
                                            $val->p_3_rekan +
                                            $val->p_3_staff
                                        );
                $collection['p_avg_4'] = (  
                                            $val->p_4_self + 
                                            $val->p_4_atasan +
                                            $val->p_4_rekan +
                                            $val->p_4_staff
                                        );
                $collection['p_avg_5'] = (  
                                            $val->p_5_self + 
                                            $val->p_5_atasan +
                                            $val->p_5_rekan +
                                            $val->p_5_staff
                                        );

                $collection['s_avg_1'] = (  
                                            $val->s_1_self + 
                                            $val->s_1_atasan +
                                            $val->s_1_rekan +
                                            $val->s_1_staff
                                        );
                $collection['s_avg_2'] = (  
                                            $val->s_2_self + 
                                            $val->s_2_atasan +
                                            $val->s_2_rekan +
                                            $val->s_2_staff
                                        );
                $collection['s_avg_3'] = (  
                                            $val->s_3_self + 
                                            $val->s_3_atasan +
                                            $val->s_3_rekan +
                                            $val->s_3_staff
                                        );
                $collection['s_avg_4'] = (  
                                            $val->s_4_self + 
                                            $val->s_4_atasan +
                                            $val->s_4_rekan +
                                            $val->s_4_staff
                                        );
                $collection['s_avg_5'] = (  
                                            $val->s_5_self + 
                                            $val->s_5_atasan +
                                            $val->s_5_rekan +
                                            $val->s_5_staff
                                        );

                $collection['mutator_k_avg_1'] = ($val->sum_kb_1 / 30) * $kali_k;
                $collection['mutator_k_avg_2'] = ($val->sum_kb_2 / 30) * $kali_k;
                $collection['mutator_k_avg_3'] = ($val->sum_kb_3 / 30) * $kali_k; 
                $collection['mutator_k_avg_4'] = ($val->sum_kb_4 / 30) * $kali_k;
                $collection['mutator_k_avg_5'] = ($val->sum_kb_5 / 30) * $kali_k;
                $collection['mutator_k_avg_6'] = ($val->sum_kb_6 / 30) * $kali_k;
                $collection['sum_point_1'] =    $collection['mutator_k_avg_1'] + 
                                                $collection['mutator_k_avg_2'] + 
                                                $collection['mutator_k_avg_3'] + 
                                                $collection['mutator_k_avg_4'] +
                                                $collection['mutator_k_avg_5'] +
                                                $collection['mutator_k_avg_6'];

                $collection['mutator_p_avg_1'] = ($val->sum_pb_1 / 25) * $kali_p;
                $collection['mutator_p_avg_2'] = ($val->sum_pb_2 / 25) * $kali_p;
                $collection['mutator_p_avg_3'] = ($val->sum_pb_3 / 25) * $kali_p; 
                $collection['mutator_p_avg_4'] = ($val->sum_pb_4 / 25) * $kali_p;
                $collection['mutator_p_avg_5'] = ($val->sum_pb_5 / 25) * $kali_p;
                $collection['sum_point_2'] =    $collection['mutator_p_avg_1'] + 
                                                $collection['mutator_p_avg_2'] + 
                                                $collection['mutator_p_avg_3'] + 
                                                $collection['mutator_p_avg_4'] +
                                                $collection['mutator_p_avg_5'];

                $collection['mutator_s_avg_1'] = ($val->sum_sb_1 / 25) * $kali_s;
                $collection['mutator_s_avg_2'] = ($val->sum_sb_2 / 25) * $kali_s;
                $collection['mutator_s_avg_3'] = ($val->sum_sb_3 / 25) * $kali_s; 
                $collection['mutator_s_avg_4'] = ($val->sum_sb_4 / 25) * $kali_s;
                $collection['mutator_s_avg_5'] = ($val->sum_sb_5 / 25) * $kali_s;
                $collection['sum_point_3'] =    $collection['mutator_s_avg_1'] + 
                                                $collection['mutator_s_avg_2'] + 
                                                $collection['mutator_s_avg_3'] + 
                                                $collection['mutator_s_avg_4'] +
                                                $collection['mutator_s_avg_5'];

                $collection['sum_rekap'] = $collection['sum_point_1'] + $collection['sum_point_2'] + $collection['sum_point_3'];

                $findAtasanDinilai = RelasiAtasan::where('relasi_karyawan_id',$val->npp_dinilai_id)->first()->toArray();
            // }
                // echo '<pre>';
                // print_r($findAtasanDinilai);
                // echo '</pre>';
            try {
                $store = HasilPersonal::updateOrCreate(
                    [
                        'npp_dinilai_id' => $val->npp_dinilai_id
                    ],
                    [
                        // 'npp_penilai_id' => $findAtasanDinilai['id'],
                        'npp_penilai_id' => $val->npp_penilai,
                        'k_avg_1' => round($collection['k_avg_1'],3),
                        'k_avg_2' => round($collection['k_avg_2'],3),
                        'k_avg_3' => round($collection['k_avg_3'],3),
                        'k_avg_4' => round($collection['k_avg_4'],3),
                        'k_avg_5' => round($collection['k_avg_5'],3),
                        'k_avg_6' => round($collection['k_avg_6'],3),
                        
                        'mutator_k_avg_1' => round($collection['mutator_k_avg_1'],3),
                        'mutator_k_avg_2' => round($collection['mutator_k_avg_2'],3),
                        'mutator_k_avg_3' => round($collection['mutator_k_avg_3'],3),
                        'mutator_k_avg_4' => round($collection['mutator_k_avg_4'],3),
                        'mutator_k_avg_5' => round($collection['mutator_k_avg_5'],3),
                        'mutator_k_avg_6' => round($collection['mutator_k_avg_6'],3),
                        
                        'p_avg_1' => round($collection['p_avg_1'],3),
                        'p_avg_2' => round($collection['p_avg_2'],3),
                        'p_avg_3' => round($collection['p_avg_3'],3),
                        'p_avg_4' => round($collection['p_avg_4'],3),
                        'p_avg_5' => round($collection['p_avg_5'],3),

                        'mutator_p_avg_1' => round($collection['mutator_p_avg_1'],3),
                        'mutator_p_avg_2' => round($collection['mutator_p_avg_2'],3),
                        'mutator_p_avg_3' => round($collection['mutator_p_avg_3'],3),
                        'mutator_p_avg_4' => round($collection['mutator_p_avg_4'],3),
                        'mutator_p_avg_5' => round($collection['mutator_p_avg_5'],3),

                        's_avg_1' => round($collection['s_avg_1'],3),
                        's_avg_2' => round($collection['s_avg_2'],3),
                        's_avg_3' => round($collection['s_avg_3'],3),
                        's_avg_4' => round($collection['s_avg_4'],3),
                        's_avg_5' => round($collection['s_avg_5'],3),

                        'mutator_s_avg_1' => round($collection['mutator_s_avg_1'],3),
                        'mutator_s_avg_2' => round($collection['mutator_s_avg_2'],3),
                        'mutator_s_avg_3' => round($collection['mutator_s_avg_3'],3),
                        'mutator_s_avg_4' => round($collection['mutator_s_avg_4'],3),
                        'mutator_s_avg_5' => round($collection['mutator_s_avg_5'],3),

                        'sum_rekap' => round($collection['sum_rekap'],3),
                        'keterangan_nilai' => null,
                    ]
                );
            } catch (\Illuminate\Database\QueryException $exception) {
                return response()->json($exception->getMessage());
            }
        }
        // dd($findAtasanDinilai);
    }

    public function getDetailAjax(Request $request)
    {
        $params = $request->detail;
        // $findDetailRekap = HasilPersonal::with([
        //     'relasi_karyawan:id,npp_karyawan,level_jabatan,unit_jabatan,nama_karyawan',
        //     'relasi_penilai:id,npp_karyawan,level_jabatan,unit_jabatan,nama_karyawan',
        //     'relasi_atasan_penilai:id',
        // ])->where('id',$params)->first() ?? [];

        // $find_npp_dinilai = $findDetailRekap->toArray();
        // $id_karyawan = $find_npp_dinilai['relasi_karyawan']['id'];
        // Cari id karyawan
        // $rk = RelasiKaryawan::with([
        //     'karyawan_atasan.parent_atasan',
        //     'karyawan_selevel.parent_selevel',
        //     'karyawan_staff.parent_staff',
        //     // 'karyawan_atasan.parent_atasan' => function($ka){
        //     //     $ka->get();
        //     // },
        //     // 'karyawan_selevel.parent_selevel' => function($ks){
        //     //     $ks->get();
        //     // },
        //     // 'karyawan_staff.parent_staff' => function($kst){
        //     //     $kst->get();
        //     // },
        // ])->where('id',$id_karyawan)->first()->toArray();
        // $result = $find_npp_dinilai + $rk;
        
        $result = HasilPersonal::with([
            'identitas_dinilai',
            'identitas_penilai',
            'karyawan_atasan',
            'karyawan_selevel',
            'karyawan_staff',
            ])
            ->where('hasil_personal.id', $params)
            ->first() ?? [];

        if($result != ''){
            return response()->json($result);
        }
        return response()->json($result);
    }

    public function getPenilaiDetailAjax(Request $request)
    {
        $params = $request->detail;

        $result = RelasiKaryawan::where('npp_karyawan',$params)->first();

        if($result != ''){
            return response()->json($result);
        }
        return response()->json($result);

    }

    public function checkStatus(Request $request)
    {
        $dinilai = $request->dinilai;

        $penilai = $request->penilai;

        $findStatus = PoolRespon::where([
            ['npp_dinilai', $dinilai],
            ['npp_penilai', $penilai],
            ])->first();

        if($findStatus == true){
            return response()->json([
                'status' => 'Sudah Menilai'
            ]);
        }
        return response()->json([
            'status' => 'Follow up'
        ]);

    }

    public function followUp(Request $request)
    {
        $dinilai = $request->dinilai;

        $penilai = $request->penilai;

        $findDinilai = [];
        $findPenilai = [];

        if($dinilai != ''){

            $findDinilai = User::where([
                ['npp', $dinilai],
                ])->first();
                
            if($findDinilai)
            {
                $findDinilai = $findDinilai->toArray();
            }else{
                $findDinilai = null;
            }
        }

        if($penilai != ''){

            $findPenilai = User::where([
                ['npp', $penilai],
                ])->first();

            if($findPenilai)
            {
                $findPenilai = $findPenilai->toArray();
            }else{
                $findPenilai = null;
            }
        }

        // if(findDinilai)
        // dd($findDinilai, $findPenilai);

        if($findDinilai != null && $findPenilai != null){
            return $this->sendWhatsapp($findDinilai, $findPenilai);
        }else{
            return response()->json([
                'detail' => 'error',
                'status' => false,
            ]);
        }

        // if($findPenilai == true){
        //     return response()->json('ok');
        // }
        // return response()->json('error');
    }

    private function sendWhatsapp(Array $npp_dinilai, Array $npp_penilai)
    {
        $nama_penilai = $npp_penilai['nama'];
        $nama_dinilai = $npp_dinilai['nama'];
        $pesan = 
        "Yth $nama_penilai
mohon untuk melakukan penilaian untuk
$nama_dinilai
Terimakasih";
        // dd($npp_dinilai,$npp_penilai);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => '08562160039',
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 2qB#yoP6MKX2Z3_pDZfj' //change TOKEN to your actual token
        ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
        echo $error_msg;
        }
        echo $response;
    }

}
