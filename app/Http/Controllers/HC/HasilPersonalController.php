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
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class HasilPersonalController extends Controller
{
    public function index()
    {
        $rekap_personal_data = HasilPersonal::get(); 
        return view('hc.rekap.personal.index')->with([
            'rekap_personal_data' => $rekap_personal_data,
        ]);
    }

    public function detailPersonal(Request $request)
    {
        $personal = HasilPersonal::with([
            'identitas_dinilai',
            'identitas_penilai',
            'karyawan_atasan',
            'karyawan_selevel',
            'karyawan_staff',
            ])
            ->where('hasil_personal.id', $request->detail)
            ->first() ?? [];
        
        // dd($personal);
        
        $atasan = RelasiKaryawan::where('npp_karyawan',$personal->karyawan_atasan[0]->npp_atasan)->first();
        $rekan = RelasiKaryawan::where('npp_karyawan',$personal->karyawan_selevel[0]->npp_selevel)->first();
        $staff = [];
        $statusPenilai = [];
        

        if($personal->karyawan_staff != null){
            // dd($personal->karyawan_staff->toArray());
            $karyawan_staff = $personal->karyawan_staff->toArray();
            foreach($karyawan_staff as $key => $val){
                // dd($val);
                $staff[] = RelasiKaryawan::where('npp_karyawan',$val['npp_staff'])->first();
            }
        }else{
            $staff = [];
        }
        // dd($staff);
        $statusAtasan = PoolRespon::where([
            ['npp_dinilai', $personal->identitas_dinilai->npp_karyawan], // Dinilai
            ['npp_penilai', $personal->karyawan_atasan[0]->id], // Penilai * pake id
            ])->first();
            // dd($status[$keys]->id);
        if($statusAtasan == true){
            $statusPenilai['atasan'] = 'OK';
        }else{
            $statusPenilai['atasan'] = 'Belum Menilai';
        }

        $statusRekan = PoolRespon::where([
            ['npp_dinilai', $personal->identitas_dinilai->npp_karyawan], // Dinilai
            ['npp_penilai', $personal->karyawan_selevel[0]->id], // Penilai * pake id
            ])->first();
        if($statusRekan == true){
            $statusPenilai['rekanan'] = 'OK';
        }else{
            $statusPenilai['rekanan'] = 'Belum Menilai';
        }

        foreach($personal->karyawan_staff as $keys => $items){
            $status[] = PoolRespon::where([
                ['npp_dinilai', $personal->identitas_dinilai->npp_karyawan], // Dinilai
                ['npp_penilai', $items->id], // Penilai * pake id
                ])->first();
            $statusPenilai['staff'] = $status;
            // return false;
        }
        // $statusPenilai->toBase();
        // return $personal;
        // dd($statusPenilai);

        return view('hc.rekap.personal.list-personal')->with([
            'detail_data' => $personal,
            'atasan' => $atasan,
            'rekan' => $rekan,
            'staff' => $staff,
            'statusPenilai' => $statusPenilai,
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
            // dd($rekapbobot->toArray());
            // dd($val->sum_kb_1);
            // if()
            $find_jabatan_dinilai = RelasiKaryawan::where('id',$val->npp_dinilai_id)->first()->toArray();
            // dd($find_jabatan_dinilai);
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
                // dd($kali_k);
                $collection['mutator_k_avg_1'] = round(($val->sum_kb_1 / 30) * $kali_k,2);
                $collection['mutator_k_avg_2'] = round(($val->sum_kb_2 / 30) * $kali_k,2);
                $collection['mutator_k_avg_3'] = round(($val->sum_kb_3 / 30) * $kali_k,2); 
                $collection['mutator_k_avg_4'] = round(($val->sum_kb_4 / 30) * $kali_k,2);
                $collection['mutator_k_avg_5'] = round(($val->sum_kb_5 / 30) * $kali_k,2);
                $collection['mutator_k_avg_6'] = round(($val->sum_kb_6 / 30) * $kali_k,2);
                $collection['sum_point_1'] =    $collection['mutator_k_avg_1'] + 
                                                $collection['mutator_k_avg_2'] + 
                                                $collection['mutator_k_avg_3'] + 
                                                $collection['mutator_k_avg_4'] +
                                                $collection['mutator_k_avg_5'] +
                                                $collection['mutator_k_avg_6'];

                $collection['mutator_p_avg_1'] = round(($val->sum_pb_1 / 25) * $kali_p,2);
                $collection['mutator_p_avg_2'] = round(($val->sum_pb_2 / 25) * $kali_p,2);
                $collection['mutator_p_avg_3'] = round(($val->sum_pb_3 / 25) * $kali_p,2); 
                $collection['mutator_p_avg_4'] = round(($val->sum_pb_4 / 25) * $kali_p,2);
                $collection['mutator_p_avg_5'] = round(($val->sum_pb_5 / 25) * $kali_p,2);
                $collection['sum_point_2'] =    $collection['mutator_p_avg_1'] + 
                                                $collection['mutator_p_avg_2'] + 
                                                $collection['mutator_p_avg_3'] + 
                                                $collection['mutator_p_avg_4'] +
                                                $collection['mutator_p_avg_5'];

                $collection['mutator_s_avg_1'] = round(($val->sum_sb_1 / 25) * $kali_s,2);
                $collection['mutator_s_avg_2'] = round(($val->sum_sb_2 / 25) * $kali_s,2);
                $collection['mutator_s_avg_3'] = round(($val->sum_sb_3 / 25) * $kali_s,2); 
                $collection['mutator_s_avg_4'] = round(($val->sum_sb_4 / 25) * $kali_s,2);
                $collection['mutator_s_avg_5'] = round(($val->sum_sb_5 / 25) * $kali_s,2);
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
                // dd($collection);
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
                // if($store)
                // {
                //     return response()->json([
                //         'status' => true,
                //         'message' => 'berhasil menambahkan data'
                //     ]);
                // }else{
                //     return response()->json([
                //         'status' => false,
                //         'message' => 'gagal menambahkan data'
                //     ]);
                // }
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

    public function ajaxDatatable(Request $request)
    {
        // $request->RecordsStart;
        // $request->PageSize;
        $s = $request->Search['value'] ?? '%';
        $data = new Collection(
            HasilPersonal::with([
                'identitas_dinilai' => function($dinilai) use ($s){
                    $dinilai->where('npp_karyawan', 'LIKE', $s);
                },
                'identitas_penilai' => function($penilai) use ($s){
                    $penilai->where('npp_karyawan', 'LIKE', $s);
                },
            ])
            ->offset($request->RecordsStart)
            ->limit($request->PageSize)
            ->get()
            ->toArray());

        // dd($data);

        $records = [];
        $result = [];

        // $records = $data->each(function ($items, $key)
        $no = $request->RecordsStart+1;
        foreach($data as $keys => $items)
        {
            $record['number'] = $no++ ?? '';
            $record['npp_dinilai_id'] = $items['identitas_dinilai']['npp_karyawan'] ?? '';
            $record['npp_penilai_id'] = $items['identitas_penilai']['npp_karyawan'] ?? '';
            $record['sum_rekap'] = $items['sum_rekap'] ?? '';
            $record['id'] = "<button type='button' class='btn btn-info btn-sm btn-personal' data-toggle='modal' data-target='#staticBackdrop' data-id=".$items['id']."><i class='far fa-eye'></i></button>";
            $records[] = $record;
        };
        // });

        // dd($records->toArray());

        $result = [
            "draw" => $request->Draw,
            "recordsTotal" => count($records),
            "recordsFiltered" => HasilPersonal::count(),
            "data" => $records,
        ];

        return response()->json($result);
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
        }
        else
        {
            return response()->json([
                'detail' => 'terjadi kesalahan',
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
mohon untuk melakukan penilaian sdr 
$nama_dinilai
Terimakasih";
        // dd($npp_dinilai,$npp_penilai);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => 'UTF-8',
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

    public function getSelevelAtasan(Request $request)
    {
        $id = $request->dinilai;
        $atasan = $request->atasan;

        $findAtasan = RelasiAtasan::with('parent_atasan')
                ->where('npp_atasan', $atasan)
                ->whereNot('relasi_karyawan_id', $id)
                ->get();
        
        if($findAtasan == true){
            return response()->json($findAtasan);
        }
        return response()->json($findAtasan);
    }

    public function calculate_dp3()
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

                'rekap_bobot_kepemimpinan.sum_kb_1_self', 
                'rekap_bobot_kepemimpinan.sum_kb_1_atasan', 
                'rekap_bobot_kepemimpinan.sum_kb_1_rekan', 
                'rekap_bobot_kepemimpinan.sum_kb_1_staff', 

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

                'rekap_bobot_perilaku.sum_pb_1_self', 
                'rekap_bobot_perilaku.sum_pb_1_atasan', 
                'rekap_bobot_perilaku.sum_pb_1_rekan', 
                'rekap_bobot_perilaku.sum_pb_1_staff', 

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

                'rekap_bobot_sasaran.sum_sb_1_self',
                'rekap_bobot_sasaran.sum_sb_1_atasan',
                'rekap_bobot_sasaran.sum_sb_1_rekan',
                'rekap_bobot_sasaran.sum_sb_1_staff',
                
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
            // dd($rekapbobot->toArray());
            // dd($val->sum_kb_1);
            // if()
            $find_jabatan_dinilai = RelasiKaryawan::where('id',$val->npp_dinilai_id)->first()->toArray();
            // dd($find_jabatan_dinilai);
            $kali_k = 0;
            $kali_p = 0;
            $kali_s = 0;
            if(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IA' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IC'){
                // Bobot Dinilai Level
                $dinilai_atasan = 0.60; 
                $dinilai_rekan = 0.20;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                // Bobot Aspek Level
                $kali_k = 0.40; // Kepemimpinan
                $kali_p = 0.25; // Perilaku
                $kali_s = 0.35; // Sasaran
                // End Bobot Aspek Level
            }elseif(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'II' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IINS'){
                // Bobot Dinilai Level
                $dinilai_atasan = 0.60; 
                $dinilai_rekan = 0.20;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 0.35;
                $kali_p = 0.25;
                $kali_s = 0.40;
            }elseif(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'III'){
                // Bobot Dinilai Level
                $dinilai_atasan = 0.60; 
                $dinilai_rekan = 0.20;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 0.30;
                $kali_p = 0.25;
                $kali_s = 0.45;
            }elseif(Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IV' || Str::remove(' ',$find_jabatan_dinilai['level_jabatan']) == 'IVA'){
                // Bobot Dinilai Level
                $dinilai_atasan = 0.60; 
                $dinilai_rekan = 0.20;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 0.10;
                $kali_p = 0.30;
                $kali_s = 0.60;
            }else{
                // Bobot Dinilai Level
                $dinilai_atasan = 0.65; 
                $dinilai_rekan = 0.25;
                $dinilai_staff = 0;
                $dinilai_self = 0.10;
                // Bobot End Level
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
                // dd($kali_k);
                $collection['mutator_k_avg_1'] = round(($collection['k_avg_1'] / 30) * $kali_k,2);
                $collection['mutator_k_avg_2'] = round(($collection['k_avg_2'] / 30) * $kali_k,2);
                $collection['mutator_k_avg_3'] = round(($collection['k_avg_3'] / 30) * $kali_k,2); 
                $collection['mutator_k_avg_4'] = round(($collection['k_avg_4'] / 30) * $kali_k,2);
                $collection['mutator_k_avg_5'] = round(($collection['k_avg_5'] / 30) * $kali_k,2);
                $collection['mutator_k_avg_6'] = round(($collection['k_avg_6'] / 30) * $kali_k,2);
                $collection['sum_point_1'] =    ($collection['mutator_k_avg_1'] + 
                                                $collection['mutator_k_avg_2'] + 
                                                $collection['mutator_k_avg_3'] + 
                                                $collection['mutator_k_avg_4'] +
                                                $collection['mutator_k_avg_5'] +
                                                $collection['mutator_k_avg_6']);

                $collection['mutator_p_avg_1'] = round(($collection['p_avg_1'] / 25) * $kali_p,2);
                $collection['mutator_p_avg_2'] = round(($collection['p_avg_2'] / 25) * $kali_p,2);
                $collection['mutator_p_avg_3'] = round(($collection['p_avg_3'] / 25) * $kali_p,2); 
                $collection['mutator_p_avg_4'] = round(($collection['p_avg_4'] / 25) * $kali_p,2);
                $collection['mutator_p_avg_5'] = round(($collection['p_avg_5'] / 25) * $kali_p,2);
                $collection['sum_point_2'] =    $collection['mutator_p_avg_1'] + 
                                                $collection['mutator_p_avg_2'] + 
                                                $collection['mutator_p_avg_3'] + 
                                                $collection['mutator_p_avg_4'] +
                                                $collection['mutator_p_avg_5'];

                $collection['mutator_s_avg_1'] = round(($collection['s_avg_1'] / 25) * $kali_s,2);
                $collection['mutator_s_avg_2'] = round(($collection['s_avg_2'] / 25) * $kali_s,2);
                $collection['mutator_s_avg_3'] = round(($collection['s_avg_3'] / 25) * $kali_s,2); 
                $collection['mutator_s_avg_4'] = round(($collection['s_avg_4'] / 25) * $kali_s,2);
                $collection['mutator_s_avg_5'] = round(($collection['s_avg_5'] / 25) * $kali_s,2);
                $collection['sum_point_3'] =    $collection['mutator_s_avg_1'] + 
                                                $collection['mutator_s_avg_2'] + 
                                                $collection['mutator_s_avg_3'] + 
                                                $collection['mutator_s_avg_4'] +
                                                $collection['mutator_s_avg_5'];

                $collection['sum_rekap_self'] = $collection['sum_point_1'] + $collection['sum_point_2'] + $collection['sum_point_3'] * $dinilai_self;
                $collection['sum_rekap_atasan'] = $collection['sum_point_1'] + $collection['sum_point_2'] + $collection['sum_point_3'] * $dinilai_atasan;
                $collection['sum_rekap_rekan'] = $collection['sum_point_1'] + $collection['sum_point_2'] + $collection['sum_point_3'] * $dinilai_staff;
                $collection['sum_rekap_staff'] = $collection['sum_point_1'] + $collection['sum_point_2'] + $collection['sum_point_3'] * $dinilai_self;

                $findAtasanDinilai = RelasiAtasan::where('relasi_karyawan_id',$val->npp_dinilai_id)->first()->toArray();
            // }
                // echo '<pre>';
                // print_r($findAtasanDinilai);
                // echo '</pre>';
                // dd($collection);
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

                        'sum_rekap_self' => round($collection['sum_rekap_self'],3),
                        'sum_rekap_atasan' => round($collection['sum_rekap_atasan'],3),
                        'sum_rekap_rekan' => round($collection['sum_rekap_rekan'],3),
                        'sum_rekap_staff' => round($collection['sum_rekap_staff'],3),
                        'keterangan_nilai' => null,
                    ]
                );
                if($store)
                {
                    return response()->json([
                        'status' => true,
                        'message' => 'berhasil menambahkan data'
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'gagal menambahkan data'
                    ]);
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                return response()->json($exception->getMessage());
            }
        }
        // dd($findAtasanDinilai);
    }

}
