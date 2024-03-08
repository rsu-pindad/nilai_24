<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\RelasiKaryawan as RK;
use App\Models\RekapNonBobot;
use App\Models\RekapNonBobotPerilaku;
use App\Models\RekapNonBobotSasaran;
use App\Models\RekapBobotKepemimpinan;
use App\Models\RekapBobotPerilaku;
use App\Models\RekapBobotSasaran;
use Illuminate\Support\Str;

class RekapBobotController extends Controller
{

    public function index_kepemimpinan()
    {
        $rekap_bobot_kepemimpinan_data = Cache::remember('rekap_bobot_kepemimpinan_data', now()->addMinutes(5), function(){
            return RekapBobotKepemimpinan::with('relasi_non_bobot')->get(); 
        });
        // dd($rekap_bobot_kepemimpinan_data);
        // dd($rekap_non_bobot_data);
        return view('hc.rekap.bobot.kepemimpinan')->with([
            'bobot_kepemimpinan_data' => $rekap_bobot_kepemimpinan_data,
        ]);
    }

    public function index_perilaku()
    {
        $rekap_bobot_perilaku_data = Cache::remember('rekap_bobot_perilaku_data', now()->addMinutes(5), function(){
            return RekapBobotPerilaku::get(); 
        });
        return view('hc.rekap.bobot.perilaku')->with([
            'bobot_perilaku_data' => $rekap_bobot_perilaku_data,
        ]);
    }

    public function index_sasaran()
    {
        $rekap_bobot_sasaran_data = Cache::remember('rekap_bobot_sasaran_data', now()->addMinutes(5), function(){
            return RekapBobotSasaran::get(); 
        });
        return view('hc.rekap.bobot.sasaran')->with([
            'bobot_sasaran_data' => $rekap_bobot_sasaran_data,
        ]);
    }

    public function rb_kepemimpinan(Request $request)
    {
        // $params = $request->boolean('refresh');
        // dd($params);
        // if($params == true)
        // {
        //     Cache::forget('rekap_bobot_kepemimpinan_data');
        // }

        $getPool = [];
        $getPool = RekapNonBobot::with([
            'relasi_karyawan:id,level_jabatan',
            'relasi_respon:id,relasi'
            ])->orderBy('jabatan_dinilai')->get()->toArray();

        // dd($getPool);

        foreach($getPool as $key =>$val){
            $point1 = [];$sum_point_1 = [];
            $point2 = [];$sum_point_2 = [];
            $point3 = [];$sum_point_3 = [];
            $point4 = [];$sum_point_4 = [];
            $point5 = [];$sum_point_5 = [];
            $point6 = [];$sum_point_6 = [];
            $jabatan_dinilai = Str::remove(' ',$val['jabatan_dinilai']);
            if($jabatan_dinilai != 'IVB' or $jabatan_dinilai != 'V'){
                // $bobotCollection[$key];
                // Kepemimpinan - Perencanaan
                $point1['kb_1_self'] = collect($getPool[$key])->get('k_1_self') * 0.05;
                $point1['kb_1_atasan'] = collect($getPool[$key])->get('k_1_atasan') * 0.60;
                $point1['kb_1_rekan'] = collect($getPool[$key])->get('k_1_rekan') * 0.20;
                $point1['kb_1_staff'] = collect($getPool[$key])->get('k_1_staff') * 0.15;
                $sum_point_1['sum_kb_1'] = collect($point1)->sum();

                $point2['kb_2_self'] = collect($getPool[$key])->get('k_2_self') * 0.05;
                $point2['kb_2_atasan'] = collect($getPool[$key])->get('k_2_atasan') * 0.60;
                $point2['kb_2_rekan'] = collect($getPool[$key])->get('k_2_rekan') * 0.20;
                $point2['kb_2_staff'] = collect($getPool[$key])->get('k_2_staff') * 0.15;
                $sum_point_2['sum_kb_2'] = collect($point2)->sum();

                $point3['kb_3_self'] = collect($getPool[$key])->get('k_3_self') * 0.05;
                $point3['kb_3_atasan'] = collect($getPool[$key])->get('k_3_atasan') * 0.60;
                $point3['kb_3_rekan'] = collect($getPool[$key])->get('k_3_rekan') * 0.20;
                $point3['kb_3_staff'] = collect($getPool[$key])->get('k_3_staff') * 0.15;
                $sum_point_3['sum_kb_3'] = collect($point3)->sum();

                $point4['kb_4_self'] = collect($getPool[$key])->get('k_4_self') * 0.05;
                $point4['kb_4_atasan'] = collect($getPool[$key])->get('k_4_atasan') * 0.60;
                $point4['kb_4_rekan'] = collect($getPool[$key])->get('k_4_rekan') * 0.20;
                $point4['kb_4_staff'] = collect($getPool[$key])->get('k_4_staff') * 0.15;
                $sum_point_4['sum_kb_4'] = collect($point4)->sum();
                
                $point5['kb_5_self'] = collect($getPool[$key])->get('k_5_self') * 0.05;
                $point5['kb_5_atasan'] = collect($getPool[$key])->get('k_5_atasan') * 0.60;
                $point5['kb_5_rekan'] = collect($getPool[$key])->get('k_5_rekan') * 0.20;
                $point5['kb_5_staff'] = collect($getPool[$key])->get('k_5_staff') * 0.15;
                $sum_point_5['sum_kb_5'] = collect($point5)->sum();
                
                $point6['kb_6_self'] = collect($getPool[$key])->get('k_6_self') * 0.05;
                $point6['kb_6_atasan'] = collect($getPool[$key])->get('k_6_atasan') * 0.60;
                $point6['kb_6_rekan'] = collect($getPool[$key])->get('k_6_rekan') * 0.20;
                $point6['kb_6_staff'] = collect($getPool[$key])->get('k_6_staff') * 0.15;
                $sum_point_6['sum_kb_6'] = collect($point6)->sum();
            }else{
                // Kepemimpinan - Perencanaan
                $point1['kb_1_self'] = collect($getPool[$key])->get('k_1_self') * 0.10;
                $point1['kb_1_atasan'] = collect($getPool[$key])->get('k_1_atasan') * 0.65;
                $point1['kb_1_rekan'] = collect($getPool[$key])->get('k_1_rekan') * 0.25;
                $point1['kb_1_staff'] = 0;
                $sum_point_1['sum_kb_1'] = collect($point1)->sum();

                $point2['kb_2_self'] = collect($getPool[$key])->get('k_2_self') * 0.10;
                $point2['kb_2_atasan'] = collect($getPool[$key])->get('k_2_atasan') * 0.65;
                $point2['kb_2_rekan'] = collect($getPool[$key])->get('k_2_rekan') * 0.25;
                $point2['kb_2_staff'] = 0;
                $sum_point_2['sum_kb_2'] = collect($point2)->sum();

                $point3['kb_3_self'] = collect($getPool[$key])->get('k_3_self') * 0.10;
                $point3['kb_3_atasan'] = collect($getPool[$key])->get('k_3_atasan') * 0.65;
                $point3['kb_3_rekan'] = collect($getPool[$key])->get('k_3_rekan') * 0.25;
                $point3['kb_3_staff'] = 0;
                $sum_point_3['sum_kb_3'] = collect($point3)->sum();

                $point4['kb_4_self'] = collect($getPool[$key])->get('k_4_self') * 0.10;
                $point4['kb_4_atasan'] = collect($getPool[$key])->get('k_4_atasan') * 0.65;
                $point4['kb_4_rekan'] = collect($getPool[$key])->get('k_4_rekan') * 0.25;
                $point4['kb_4_staff'] = 0;
                $sum_point_4['sum_kb_4'] = collect($point4)->sum();
                
                $point5['kb_5_self'] = collect($getPool[$key])->get('k_5_self') * 0.10;
                $point5['kb_5_atasan'] = collect($getPool[$key])->get('k_5_atasan') * 0.65;
                $point5['kb_5_rekan'] = collect($getPool[$key])->get('k_5_rekan') * 0.25;
                $point5['kb_5_staff'] = 0;
                $sum_point_5['sum_kb_5'] = collect($point5)->sum();
                
                $point6['kb_6_self'] = collect($getPool[$key])->get('k_6_self') * 0.10;
                $point6['kb_6_atasan'] = collect($getPool[$key])->get('k_6_atasan') * 0.65;
                $point6['kb_6_rekan'] = collect($getPool[$key])->get('k_6_rekan') * 0.25;
                $point6['kb_6_staff'] = 0;
                $sum_point_6['sum_kb_6'] = collect($point6)->sum();
            }

            try {
                $store = RekapBobotKepemimpinan::updateOrCreate([
                    'tnb_kepemimpinan_id' => $val['id'],
                ],[
                    'npp_dinilai_id'=> $val['npp_karyawan_id'],
                    'kb_1_self'     => $point1['kb_1_self'] ?? 0,
                    'kb_1_atasan'   => $point1['kb_1_atasan'] ?? 0,
                    'kb_1_rekan'    => $point1['kb_1_rekan'] ?? 0,
                    'kb_1_staff'    => $point1['kb_1_staff'] ?? 0,
                    'sum_kb_1'      => $sum_point_1['sum_kb_1'] ?? 0,

                    'kb_2_self'     => $point2['kb_2_self'] ?? 0,
                    'kb_2_atasan'   => $point2['kb_2_atasan'] ?? 0,
                    'kb_2_rekan'    => $point2['kb_2_rekan'] ?? 0,
                    'kb_2_staff'    => $point2['kb_2_staff'] ?? 0,
                    'sum_kb_2'      => $sum_point_2['sum_kb_2'] ?? 0,

                    'kb_3_self'     => $point3['kb_3_self'] ?? 0,
                    'kb_3_atasan'   => $point3['kb_3_atasan'] ?? 0,
                    'kb_3_rekan'    => $point3['kb_3_rekan'] ?? 0,
                    'kb_3_staff'    => $point3['kb_3_staff'] ?? 0,
                    'sum_kb_3'      => $sum_point_3['sum_kb_3'] ?? 0,

                    'kb_4_self'     => $point4['kb_4_self'] ?? 0,
                    'kb_4_atasan'   => $point4['kb_4_atasan'] ?? 0,
                    'kb_4_rekan'    => $point4['kb_4_rekan'] ?? 0,
                    'kb_4_staff'    => $point4['kb_4_staff'] ?? 0,
                    'sum_kb_4'      => $sum_point_4['sum_kb_4'] ?? 0,

                    'kb_5_self'     => $point5['kb_5_self'] ?? 0,
                    'kb_5_atasan'   => $point5['kb_5_atasan'] ?? 0,
                    'kb_5_rekan'    => $point5['kb_5_rekan'] ?? 0,
                    'kb_5_staff'    => $point5['kb_5_staff'] ?? 0,
                    'sum_kb_5'      => $sum_point_5['sum_kb_5'] ?? 0,

                    'kb_6_self'     => $point6['kb_5_self'] ?? 0,
                    'kb_6_atasan'   => $point6['kb_5_atasan'] ?? 0,
                    'kb_6_rekan'    => $point6['kb_5_rekan'] ?? 0,
                    'kb_6_staff'    => $point6['kb_5_staff'] ?? 0,
                    'sum_kb_6'      => $sum_point_6['sum_kb_6'] ?? 0,
                ]
                );
            } catch (\Illuminate\Database\QueryException $exception) {
                return response()->json($exception->getMessage());
            }
        }
    }

    public function rb_perilaku(Request $request)
    {
        // $params = $request->boolean('refresh');
        // dd($params);
        // if($params == true)
        // {
        //     Cache::forget('rekap_bobot_kepemimpinan_data');
        // }

        $getPool = [];
        $getPool = RekapNonBobotPerilaku::with([
            'relasi_karyawan:id,level_jabatan',
            'relasi_respon:id,relasi'
            ])->orderBy('jabatan_dinilai')->get()->toArray();

        // dd($getPool);

        foreach($getPool as $key =>$val){
            $point1 = [];$sum_point_1 = [];
            $point2 = [];$sum_point_2 = [];
            $point3 = [];$sum_point_3 = [];
            $point4 = [];$sum_point_4 = [];
            $point5 = [];$sum_point_5 = [];
            $jabatan_dinilai = Str::remove(' ',$val['jabatan_dinilai']);
            if($jabatan_dinilai != 'IVB' or $jabatan_dinilai != 'V'){
                // $bobotCollection[$key];
                // Kepemimpinan - Perencanaan
                $point1['pb_1_self'] = collect($getPool[$key])->get('p_1_self') * 0.05;
                $point1['pb_1_atasan'] = collect($getPool[$key])->get('p_1_atasan') * 0.60;
                $point1['pb_1_rekan'] = collect($getPool[$key])->get('p_1_rekan') * 0.20;
                $point1['pb_1_staff'] = collect($getPool[$key])->get('p_1_staff') * 0.15;
                $sum_point_1['sum_pb_1'] = collect($point1)->sum();

                $point2['pb_2_self'] = collect($getPool[$key])->get('p_2_self') * 0.05;
                $point2['pb_2_atasan'] = collect($getPool[$key])->get('p_2_atasan') * 0.60;
                $point2['pb_2_rekan'] = collect($getPool[$key])->get('p_2_rekan') * 0.20;
                $point2['pb_2_staff'] = collect($getPool[$key])->get('p_2_staff') * 0.15;
                $sum_point_2['sum_pb_2'] = collect($point2)->sum();

                $point3['pb_3_self'] = collect($getPool[$key])->get('p_3_self') * 0.05;
                $point3['pb_3_atasan'] = collect($getPool[$key])->get('p_3_atasan') * 0.60;
                $point3['pb_3_rekan'] = collect($getPool[$key])->get('p_3_rekan') * 0.20;
                $point3['pb_3_staff'] = collect($getPool[$key])->get('p_3_staff') * 0.15;
                $sum_point_3['sum_pb_3'] = collect($point3)->sum();

                $point4['pb_4_self'] = collect($getPool[$key])->get('p_4_self') * 0.05;
                $point4['pb_4_atasan'] = collect($getPool[$key])->get('p_4_atasan') * 0.60;
                $point4['pb_4_rekan'] = collect($getPool[$key])->get('p_4_rekan') * 0.20;
                $point4['pb_4_staff'] = collect($getPool[$key])->get('p_4_staff') * 0.15;
                $sum_point_4['sum_pb_4'] = collect($point4)->sum();
                
                $point5['pb_5_self'] = collect($getPool[$key])->get('p_5_self') * 0.05;
                $point5['pb_5_atasan'] = collect($getPool[$key])->get('p_5_atasan') * 0.60;
                $point5['pb_5_rekan'] = collect($getPool[$key])->get('p_5_rekan') * 0.20;
                $point5['pb_5_staff'] = collect($getPool[$key])->get('p_5_staff') * 0.15;
                $sum_point_5['sum_pb_5'] = collect($point5)->sum();
                
            }else{
                // Kepemimpinan - Perencanaan
                $point1['pb_1_self'] = collect($getPool[$key])->get('p_1_self') * 0.10;
                $point1['pb_1_atasan'] = collect($getPool[$key])->get('p_1_atasan') * 0.65;
                $point1['pb_1_rekan'] = collect($getPool[$key])->get('p_1_rekan') * 0.25;
                $point1['pb_1_staff'] = 0;
                $sum_point_1['sum_pb_1'] = collect($point1)->sum();

                $point2['pb_2_self'] = collect($getPool[$key])->get('p_2_self') * 0.10;
                $point2['pb_2_atasan'] = collect($getPool[$key])->get('p_2_atasan') * 0.65;
                $point2['pb_2_rekan'] = collect($getPool[$key])->get('p_2_rekan') * 0.25;
                $point2['pb_2_staff'] = 0;
                $sum_point_2['sum_pb_2'] = collect($point2)->sum();

                $point3['pb_3_self'] = collect($getPool[$key])->get('p_3_self') * 0.10;
                $point3['pb_3_atasan'] = collect($getPool[$key])->get('p_3_atasan') * 0.65;
                $point3['pb_3_rekan'] = collect($getPool[$key])->get('p_3_rekan') * 0.25;
                $point3['pb_3_staff'] = 0;
                $sum_point_3['sum_pb_3'] = collect($point3)->sum();

                $point4['pb_4_self'] = collect($getPool[$key])->get('p_4_self') * 0.10;
                $point4['pb_4_atasan'] = collect($getPool[$key])->get('p_4_atasan') * 0.65;
                $point4['pb_4_rekan'] = collect($getPool[$key])->get('p_4_rekan') * 0.25;
                $point4['pb_4_staff'] = 0;
                $sum_point_4['sum_pb_4'] = collect($point4)->sum();
                
                $point5['pb_5_self'] = collect($getPool[$key])->get('p_5_self') * 0.10;
                $point5['pb_5_atasan'] = collect($getPool[$key])->get('p_5_atasan') * 0.65;
                $point5['pb_5_rekan'] = collect($getPool[$key])->get('p_5_rekan') * 0.25;
                $point5['pb_5_staff'] = 0;
                $sum_point_5['sum_pb_5'] = collect($point5)->sum();
            }

            try {
                $store = RekapBobotPerilaku::updateOrCreate([
                    'tnb_perilaku_id' => $val['id'],
                ],[
                    'npp_dinilai_id'=> $val['npp_karyawan_id'],
                    'pb_1_self'     => $point1['pb_1_self'] ?? 0,
                    'pb_1_atasan'   => $point1['pb_1_atasan'] ?? 0,
                    'pb_1_rekan'    => $point1['pb_1_rekan'] ?? 0,
                    'pb_1_staff'    => $point1['pb_1_staff'] ?? 0,
                    'sum_pb_1'      => $sum_point_1['sum_pb_1'] ?? 0,

                    'pb_2_self'     => $point2['pb_2_self'] ?? 0,
                    'pb_2_atasan'   => $point2['pb_2_atasan'] ?? 0,
                    'pb_2_rekan'    => $point2['pb_2_rekan'] ?? 0,
                    'pb_2_staff'    => $point2['pb_2_staff'] ?? 0,
                    'sum_pb_2'      => $sum_point_2['sum_pb_2'] ?? 0,

                    'pb_3_self'     => $point3['pb_3_self'] ?? 0,
                    'pb_3_atasan'   => $point3['pb_3_atasan'] ?? 0,
                    'pb_3_rekan'    => $point3['pb_3_rekan'] ?? 0,
                    'pb_3_staff'    => $point3['pb_3_staff'] ?? 0,
                    'sum_pb_3'      => $sum_point_3['sum_pb_3'] ?? 0,

                    'pb_4_self'     => $point4['pb_4_self'] ?? 0,
                    'pb_4_atasan'   => $point4['pb_4_atasan'] ?? 0,
                    'pb_4_rekan'    => $point4['pb_4_rekan'] ?? 0,
                    'pb_4_staff'    => $point4['pb_4_staff'] ?? 0,
                    'sum_pb_4'      => $sum_point_4['sum_pb_4'] ?? 0,

                    'pb_5_self'     => $point5['pb_5_self'] ?? 0,
                    'pb_5_atasan'   => $point5['pb_5_atasan'] ?? 0,
                    'pb_5_rekan'    => $point5['pb_5_rekan'] ?? 0,
                    'pb_5_staff'    => $point5['pb_5_staff'] ?? 0,
                    'sum_pb_5'      => $sum_point_5['sum_pb_5'] ?? 0,

                ]
                );
            } catch (\Illuminate\Database\QueryException $exception) {
                return response()->json($exception->getMessage());
            }
        }
    }

    
    public function rb_sasaran(Request $request)
    {
        // $params = $request->boolean('refresh');
        // dd($params);
        // if($params == true)
        // {
        //     Cache::forget('rekap_bobot_kepemimpinan_data');
        // }

        $getPool = [];
        $getPool = RekapNonBobotSasaran::with([
            'relasi_karyawan:id,level_jabatan',
            'relasi_respon:id,relasi'
            ])->orderBy('jabatan_dinilai')->get()->toArray();

        // dd($getPool);

        foreach($getPool as $key =>$val){
            $point1 = [];$sum_point_1 = [];
            $point2 = [];$sum_point_2 = [];
            $point3 = [];$sum_point_3 = [];
            $point4 = [];$sum_point_4 = [];
            $point5 = [];$sum_point_5 = [];
            $jabatan_dinilai = Str::remove(' ',$val['jabatan_dinilai']);
            if($jabatan_dinilai != 'IVB' or $jabatan_dinilai != 'V'){
                // $bobotCollection[$key];
                // Kepemimpinan - Perencanaan
                $point1['sb_1_self'] = collect($getPool[$key])->get('s_1_self') * 0.05;
                $point1['sb_1_atasan'] = collect($getPool[$key])->get('s_1_atasan') * 0.60;
                $point1['sb_1_rekan'] = collect($getPool[$key])->get('s_1_rekan') * 0.20;
                $point1['sb_1_staff'] = collect($getPool[$key])->get('s_1_staff') * 0.15;
                $sum_point_1['sum_sb_1'] = collect($point1)->sum();

                $point2['sb_2_self'] = collect($getPool[$key])->get('s_2_self') * 0.05;
                $point2['sb_2_atasan'] = collect($getPool[$key])->get('s_2_atasan') * 0.60;
                $point2['sb_2_rekan'] = collect($getPool[$key])->get('s_2_rekan') * 0.20;
                $point2['sb_2_staff'] = collect($getPool[$key])->get('s_2_staff') * 0.15;
                $sum_point_2['sum_sb_2'] = collect($point2)->sum();

                $point3['sb_3_self'] = collect($getPool[$key])->get('s_3_self') * 0.05;
                $point3['sb_3_atasan'] = collect($getPool[$key])->get('s_3_atasan') * 0.60;
                $point3['sb_3_rekan'] = collect($getPool[$key])->get('s_3_rekan') * 0.20;
                $point3['sb_3_staff'] = collect($getPool[$key])->get('s_3_staff') * 0.15;
                $sum_point_3['sum_sb_3'] = collect($point3)->sum();

                $point4['sb_4_self'] = collect($getPool[$key])->get('s_4_self') * 0.05;
                $point4['sb_4_atasan'] = collect($getPool[$key])->get('s_4_atasan') * 0.60;
                $point4['sb_4_rekan'] = collect($getPool[$key])->get('s_4_rekan') * 0.20;
                $point4['sb_4_staff'] = collect($getPool[$key])->get('s_4_staff') * 0.15;
                $sum_point_4['sum_sb_4'] = collect($point4)->sum();
                
                $point5['sb_5_self'] = collect($getPool[$key])->get('s_5_self') * 0.05;
                $point5['sb_5_atasan'] = collect($getPool[$key])->get('s_5_atasan') * 0.60;
                $point5['sb_5_rekan'] = collect($getPool[$key])->get('s_5_rekan') * 0.20;
                $point5['sb_5_staff'] = collect($getPool[$key])->get('s_5_staff') * 0.15;
                $sum_point_5['sum_sb_5'] = collect($point5)->sum();
                
            }else{
                // Kepemimpinan - Perencanaan
                $point1['sb_1_self'] = collect($getPool[$key])->get('s_1_self') * 0.10;
                $point1['sb_1_atasan'] = collect($getPool[$key])->get('s_1_atasan') * 0.65;
                $point1['sb_1_rekan'] = collect($getPool[$key])->get('s_1_rekan') * 0.25;
                $point1['sb_1_staff'] = 0;
                $sum_point_1['sum_sb_1'] = collect($point1)->sum();

                $point2['sb_2_self'] = collect($getPool[$key])->get('s_2_self') * 0.10;
                $point2['sb_2_atasan'] = collect($getPool[$key])->get('s_2_atasan') * 0.65;
                $point2['sb_2_rekan'] = collect($getPool[$key])->get('s_2_rekan') * 0.25;
                $point2['sb_2_staff'] = 0;
                $sum_point_2['sum_sb_2'] = collect($point2)->sum();

                $point3['sb_3_self'] = collect($getPool[$key])->get('s_3_self') * 0.10;
                $point3['sb_3_atasan'] = collect($getPool[$key])->get('s_3_atasan') * 0.65;
                $point3['sb_3_rekan'] = collect($getPool[$key])->get('s_3_rekan') * 0.25;
                $point3['sb_3_staff'] = 0;
                $sum_point_3['sum_sb_3'] = collect($point3)->sum();

                $point4['sb_4_self'] = collect($getPool[$key])->get('s_4_self') * 0.10;
                $point4['sb_4_atasan'] = collect($getPool[$key])->get('s_4_atasan') * 0.65;
                $point4['sb_4_rekan'] = collect($getPool[$key])->get('s_4_rekan') * 0.25;
                $point4['sb_4_staff'] = 0;
                $sum_point_4['sum_sb_4'] = collect($point4)->sum();
                
                $point5['sb_5_self'] = collect($getPool[$key])->get('s_5_self') * 0.10;
                $point5['sb_5_atasan'] = collect($getPool[$key])->get('s_5_atasan') * 0.65;
                $point5['sb_5_rekan'] = collect($getPool[$key])->get('s_5_rekan') * 0.25;
                $point5['sb_5_staff'] = 0;
                $sum_point_5['sum_pb_5'] = collect($point5)->sum();
            }

            try {
                $store = RekapBobotSasaran::updateOrCreate([
                    'tnb_sasaran_id' => $val['id'],
                ],[
                    'npp_dinilai_id'=> $val['npp_karyawan_id'],
                    'sb_1_self'     => $point1['sb_1_self'] ?? 0,
                    'sb_1_atasan'   => $point1['sb_1_atasan'] ?? 0,
                    'sb_1_rekan'    => $point1['sb_1_rekan'] ?? 0,
                    'sb_1_staff'    => $point1['sb_1_staff'] ?? 0,
                    'sum_sb_1'      => $sum_point_1['sum_sb_1'] ?? 0,

                    'sb_2_self'     => $point2['sb_2_self'] ?? 0,
                    'sb_2_atasan'   => $point2['sb_2_atasan'] ?? 0,
                    'sb_2_rekan'    => $point2['sb_2_rekan'] ?? 0,
                    'sb_2_staff'    => $point2['sb_2_staff'] ?? 0,
                    'sum_sb_2'      => $sum_point_2['sum_sb_2'] ?? 0,

                    'sb_3_self'     => $point3['sb_3_self'] ?? 0,
                    'sb_3_atasan'   => $point3['sb_3_atasan'] ?? 0,
                    'sb_3_rekan'    => $point3['sb_3_rekan'] ?? 0,
                    'sb_3_staff'    => $point3['sb_3_staff'] ?? 0,
                    'sum_sb_3'      => $sum_point_3['sum_sb_3'] ?? 0,

                    'sb_4_self'     => $point4['sb_4_self'] ?? 0,
                    'sb_4_atasan'   => $point4['sb_4_atasan'] ?? 0,
                    'sb_4_rekan'    => $point4['sb_4_rekan'] ?? 0,
                    'sb_4_staff'    => $point4['sb_4_staff'] ?? 0,
                    'sum_sb_4'      => $sum_point_4['sum_sb_4'] ?? 0,

                    'sb_5_self'     => $point5['sb_5_self'] ?? 0,
                    'sb_5_atasan'   => $point5['sb_5_atasan'] ?? 0,
                    'sb_5_rekan'    => $point5['sb_5_rekan'] ?? 0,
                    'sb_5_staff'    => $point5['sb_5_staff'] ?? 0,
                    'sum_sb_5'      => $sum_point_5['sum_sb_5'] ?? 0,
                ]
                );
            } catch (\Illuminate\Database\QueryException $exception) {
                return response()->json($exception->getMessage());
            }
        }
    }
}
