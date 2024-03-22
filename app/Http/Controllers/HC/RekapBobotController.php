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
        // $rekap_bobot_kepemimpinan_data = Cache::remember('rekap_bobot_kepemimpinan_data', now()->addMinutes(5), function(){
            // return RekapBobotKepemimpinan::with('relasi_non_bobot')->get(); 
            // });
            // dd($rekap_bobot_kepemimpinan_data);
            // dd($rekap_non_bobot_data);
        $rekap_bobot_kepemimpinan_data = RekapBobotKepemimpinan::with('relasi_non_bobot')->get(); 
        return view('hc.rekap.bobot.kepemimpinan')->with([
            'bobot_kepemimpinan_data' => $rekap_bobot_kepemimpinan_data,
        ]);
    }

    public function index_perilaku()
    {
        // $rekap_bobot_perilaku_data = Cache::remember('rekap_bobot_perilaku_data', now()->addMinutes(5), function(){
        //     return RekapBobotPerilaku::get(); 
        // });
        $rekap_bobot_perilaku_data = RekapBobotPerilaku::with('relasi_non_bobot')->get();
        return view('hc.rekap.bobot.perilaku')->with([
            'bobot_perilaku_data' => $rekap_bobot_perilaku_data,
        ]);
    }

    public function index_sasaran()
    {
        // $rekap_bobot_sasaran_data = Cache::remember('rekap_bobot_sasaran_data', now()->addMinutes(5), function(){
        //     return RekapBobotSasaran::get(); 
        // });

        $rekap_bobot_sasaran_data = RekapBobotSasaran::get(); 

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
            // dd($val);
            $point1 = [];$point_kb_self = [];
            $point2 = [];$point_kb_atasan = [];
            $point3 = [];$point_kb_rekan = [];
            $point4 = [];$point_kb_staff = [];
            $point5 = [];
            // $sum_point_5 = [];
            $point6 = [];
            // $sum_point_6 = [];
            $jabatan_dinilai = Str::remove(' ',$val['jabatan_dinilai']);
            if($jabatan_dinilai != 'IVB' or $jabatan_dinilai != 'V'){
                // $bobotCollection[$key];
                // Kepemimpinan - Perencanaan
                // $point1['kb_1_self'] = round(collect($getPool[$key])->get('k_1_self') * 0.05,2);
                // $point1['kb_1_atasan'] = round(collect($getPool[$key])->get('k_1_atasan') * 0.60,2);
                // $point1['kb_1_rekan'] = round(collect($getPool[$key])->get('k_1_rekan') * 0.20,2);
                // $point1['kb_1_staff'] = round(collect($getPool[$key])->get('k_1_staff') * 0.15,2);
                // $sum_point_1['sum_kb_1'] = collect($point1)->sum();

                // $point2['kb_2_self'] = round(collect($getPool[$key])->get('k_2_self') * 0.05,2);
                // $point2['kb_2_atasan'] = round(collect($getPool[$key])->get('k_2_atasan') * 0.60,2);
                // $point2['kb_2_rekan'] = round(collect($getPool[$key])->get('k_2_rekan') * 0.20,2);
                // $point2['kb_2_staff'] = round(collect($getPool[$key])->get('k_2_staff') * 0.15,2);
                // $sum_point_2['sum_kb_2'] = collect($point2)->sum();

                // $point3['kb_3_self'] = round(collect($getPool[$key])->get('k_3_self') * 0.05,2);
                // $point3['kb_3_atasan'] = round(collect($getPool[$key])->get('k_3_atasan') * 0.60,2);
                // $point3['kb_3_rekan'] = round(collect($getPool[$key])->get('k_3_rekan') * 0.20,2);
                // $point3['kb_3_staff'] = round(collect($getPool[$key])->get('k_3_staff') * 0.15,2);
                // $sum_point_3['sum_kb_3'] = collect($point3)->sum();

                // $point4['kb_4_self'] = round(collect($getPool[$key])->get('k_4_self') * 0.05,2);
                // $point4['kb_4_atasan'] = round(collect($getPool[$key])->get('k_4_atasan') * 0.60,2);
                // $point4['kb_4_rekan'] = round(collect($getPool[$key])->get('k_4_rekan') * 0.20,2);
                // $point4['kb_4_staff'] = round(collect($getPool[$key])->get('k_4_staff') * 0.15,2);
                // $sum_point_4['sum_kb_4'] = collect($point4)->sum();
                
                // $point5['kb_5_self'] = round(collect($getPool[$key])->get('k_5_self') * 0.05,2);
                // $point5['kb_5_atasan'] = round(collect($getPool[$key])->get('k_5_atasan') * 0.60,2);
                // $point5['kb_5_rekan'] = round(collect($getPool[$key])->get('k_5_rekan') * 0.20,2);
                // $point5['kb_5_staff'] = round(collect($getPool[$key])->get('k_5_staff') * 0.15,2);
                // $sum_point_5['sum_kb_5'] = collect($point5)->sum();
                
                // $point6['kb_6_self'] = round(collect($getPool[$key])->get('k_6_self') * 0.05,2);
                // $point6['kb_6_atasan'] = round(collect($getPool[$key])->get('k_6_atasan') * 0.60,2);
                // $point6['kb_6_rekan'] = round(collect($getPool[$key])->get('k_6_rekan') * 0.20,2);
                // $point6['kb_6_staff'] = round(collect($getPool[$key])->get('k_6_staff') * 0.15,2);
                // $sum_point_6['sum_kb_6'] = collect($point6)->sum();

                $point_kb_self['kb_1_self'] = round(collect($getPool[$key])->get('k_1_self'),2);
                $point_kb_atasan['kb_1_atasan'] = round(collect($getPool[$key])->get('k_1_atasan'),2);
                $point_kb_rekan['kb_1_rekan'] = round(collect($getPool[$key])->get('k_1_rekan'),2);
                $point_kb_staff['kb_1_staff'] = round(collect($getPool[$key])->get('k_1_staff'),2);

                $point_kb_self['kb_2_self'] = round(collect($getPool[$key])->get('k_2_self'),2);
                $point_kb_atasan['kb_2_atasan'] = round(collect($getPool[$key])->get('k_2_atasan'),2);
                $point_kb_rekan['kb_2_rekan'] = round(collect($getPool[$key])->get('k_2_rekan'),2);
                $point_kb_staff['kb_2_staff'] = round(collect($getPool[$key])->get('k_2_staff'),2);

                $point_kb_self['kb_3_self'] = round(collect($getPool[$key])->get('k_3_self'),2);
                $point_kb_atasan['kb_3_atasan'] = round(collect($getPool[$key])->get('k_3_atasan'),2);
                $point_kb_rekan['kb_3_rekan'] = round(collect($getPool[$key])->get('k_3_rekan'),2);
                $point_kb_staff['kb_3_staff'] = round(collect($getPool[$key])->get('k_3_staff'),2);

                $point_kb_self['kb_4_self'] = round(collect($getPool[$key])->get('k_4_self'),2);
                $point_kb_atasan['kb_4_atasan'] = round(collect($getPool[$key])->get('k_4_atasan'),2);
                $point_kb_rekan['kb_4_rekan'] = round(collect($getPool[$key])->get('k_4_rekan'),2);
                $point_kb_staff['kb_4_staff'] = round(collect($getPool[$key])->get('k_4_staff'),2);
                
                $point_kb_self['kb_5_self'] = round(collect($getPool[$key])->get('k_5_self'),2);
                $point_kb_atasan['kb_5_atasan'] = round(collect($getPool[$key])->get('k_5_atasan'),2);
                $point_kb_rekan['kb_5_rekan'] = round(collect($getPool[$key])->get('k_5_rekan'),2);
                $point_kb_staff['kb_5_staff'] = round(collect($getPool[$key])->get('k_5_staff'),2);
                
                $point_kb_self['kb_6_self'] = round(collect($getPool[$key])->get('k_6_self'),2);
                $point_kb_atasan['kb_6_atasan'] = round(collect($getPool[$key])->get('k_6_atasan'),2);
                $point_kb_rekan['kb_6_rekan'] = round(collect($getPool[$key])->get('k_6_rekan'),2);
                $point_kb_staff['kb_6_staff'] = round(collect($getPool[$key])->get('k_6_staff'),2);
                
                $sum_point_kb_self['sum_kb_1_self'] = collect($point_kb_self)->sum();
                $sum_point_kb_atasan['sum_kb_1_atasan'] = collect($point_kb_atasan)->sum();
                $sum_point_kb_rekan['sum_kb_1_rekan'] = collect($point_kb_rekan)->sum();
                $sum_point_kb_staff['sum_kb_1_staff'] = collect($point_kb_staff)->sum();

            }else{
                // Kepemimpinan - Perencanaan
                // $point1['kb_1_self'] = round(collect($getPool[$key])->get('k_1_self') * 0.10,2);
                // $point1['kb_1_atasan'] = round(collect($getPool[$key])->get('k_1_atasan') * 0.65,2);
                // $point1['kb_1_rekan'] = round(collect($getPool[$key])->get('k_1_rekan') * 0.25,2);
                // $point1['kb_1_staff'] = 0;
                // $sum_point_1['sum_kb_1'] = collect($point1)->sum();

                // $point2['kb_2_self'] = round(collect($getPool[$key])->get('k_2_self') * 0.10,2);
                // $point2['kb_2_atasan'] = round(collect($getPool[$key])->get('k_2_atasan') * 0.65,2);
                // $point2['kb_2_rekan'] = round(collect($getPool[$key])->get('k_2_rekan') * 0.25,2);
                // $point2['kb_2_staff'] = 0;
                // $sum_point_2['sum_kb_2'] = collect($point2)->sum();

                // $point3['kb_3_self'] = round(collect($getPool[$key])->get('k_3_self') * 0.10,2);
                // $point3['kb_3_atasan'] = round(collect($getPool[$key])->get('k_3_atasan') * 0.65,2);
                // $point3['kb_3_rekan'] = round(collect($getPool[$key])->get('k_3_rekan') * 0.25,2);
                // $point3['kb_3_staff'] = 0;
                // $sum_point_3['sum_kb_3'] = collect($point3)->sum();

                // $point4['kb_4_self'] = round(collect($getPool[$key])->get('k_4_self') * 0.10,2);
                // $point4['kb_4_atasan'] = round(collect($getPool[$key])->get('k_4_atasan') * 0.65,2);
                // $point4['kb_4_rekan'] = round(collect($getPool[$key])->get('k_4_rekan') * 0.25,2);
                // $point4['kb_4_staff'] = 0;
                // $sum_point_4['sum_kb_4'] = collect($point4)->sum();
                
                // $point5['kb_5_self'] = round(collect($getPool[$key])->get('k_5_self') * 0.10,2);
                // $point5['kb_5_atasan'] = round(collect($getPool[$key])->get('k_5_atasan') * 0.65,2);
                // $point5['kb_5_rekan'] = round(collect($getPool[$key])->get('k_5_rekan') * 0.25,2);
                // $point5['kb_5_staff'] = 0;
                // $sum_point_5['sum_kb_5'] = collect($point5)->sum();
                
                // $point6['kb_6_self'] = round(collect($getPool[$key])->get('k_6_self') * 0.10,2);
                // $point6['kb_6_atasan'] = round(collect($getPool[$key])->get('k_6_atasan') * 0.65,2);
                // $point6['kb_6_rekan'] = round(collect($getPool[$key])->get('k_6_rekan') * 0.25,2);
                // $point6['kb_6_staff'] = 0;
                // $sum_point_6['sum_kb_6'] = collect($point6)->sum();

                $point_kb_self['kb_1_self'] = round(collect($getPool[$key])->get('k_1_self'),2);
                $point_kb_atasan['kb_1_atasan'] = round(collect($getPool[$key])->get('k_1_atasan'),2);
                $point_kb_rekan['kb_1_rekan'] = round(collect($getPool[$key])->get('k_1_rekan'),2);
                $point_kb_staff['kb_1_staff'] = 0;

                $point_kb_self['kb_2_self'] = round(collect($getPool[$key])->get('k_2_self'),2);
                $point_kb_atasan['kb_2_atasan'] = round(collect($getPool[$key])->get('k_2_atasan'),2);
                $point_kb_rekan['kb_2_rekan'] = round(collect($getPool[$key])->get('k_2_rekan'),2);
                $point_kb_staff['kb_2_staff'] = 0;

                $point_kb_self['kb_3_self'] = round(collect($getPool[$key])->get('k_3_self'),2);
                $point_kb_atasan['kb_3_atasan'] = round(collect($getPool[$key])->get('k_3_atasan'),2);
                $point_kb_rekan['kb_3_rekan'] = round(collect($getPool[$key])->get('k_3_rekan'),2);
                $point_kb_staff['kb_3_staff'] = 0;

                $point_kb_self['kb_4_self'] = round(collect($getPool[$key])->get('k_4_self'),2);
                $point_kb_atasan['kb_4_atasan'] = round(collect($getPool[$key])->get('k_4_atasan'),2);
                $point_kb_rekan['kb_4_rekan'] = round(collect($getPool[$key])->get('k_4_rekan'),2);
                $point_kb_staff['kb_4_staff'] = 0;
                
                $point_kb_self['kb_5_self'] = round(collect($getPool[$key])->get('k_5_self'),2);
                $point_kb_atasan['kb_5_atasan'] = round(collect($getPool[$key])->get('k_5_atasan'),2);
                $point_kb_rekan['kb_5_rekan'] = round(collect($getPool[$key])->get('k_5_rekan'),2);
                $point_kb_staff['kb_5_staff'] = 0;
                
                $point_kb_self['kb_6_self'] = round(collect($getPool[$key])->get('k_6_self'),2);
                $point_kb_atasan['kb_6_atasan'] = round(collect($getPool[$key])->get('k_6_atasan'),2);
                $point_kb_rekan['kb_6_rekan'] = round(collect($getPool[$key])->get('k_6_rekan'),2);
                $point_kb_staff['kb_6_staff'] = 0;
                
                $sum_point_kb_self['sum_kb_1_self'] = collect($point_kb_self)->sum();
                $sum_point_kb_atasan['sum_kb_1_atasan'] = collect($point_kb_atasan)->sum();
                $sum_point_kb_rekan['sum_kb_1_rekan'] = collect($point_kb_rekan)->sum();
                $sum_point_kb_staff['sum_kb_1_staff'] = 0;
            }
            // dd($sum_point_kb_staff);
            try {
                $store = RekapBobotKepemimpinan::updateOrCreate([
                    'tnb_kepemimpinan_id' => $val['id'],
                ],[
                    'npp_dinilai_id'=> $val['npp_karyawan_id'],
                    'kb_1_self'     => $point_kb_self['kb_1_self'] ?? 0,
                    'kb_1_atasan'   => $point_kb_atasan['kb_1_atasan'] ?? 0,
                    'kb_1_rekan'    => $point_kb_rekan['kb_1_rekan'] ?? 0,
                    'kb_1_staff'    => $point_kb_staff['kb_1_staff'] ?? 0,

                    'kb_2_self'     => $point_kb_self['kb_2_self'] ?? 0,
                    'kb_2_atasan'   => $point_kb_atasan['kb_2_atasan'] ?? 0,
                    'kb_2_rekan'    => $point_kb_rekan['kb_2_rekan'] ?? 0,
                    'kb_2_staff'    => $point_kb_staff['kb_2_staff'] ?? 0,

                    'kb_3_self'     => $point_kb_self['kb_3_self'] ?? 0,
                    'kb_3_atasan'   => $point_kb_atasan['kb_3_atasan'] ?? 0,
                    'kb_3_rekan'    => $point_kb_rekan['kb_3_rekan'] ?? 0,
                    'kb_3_staff'    => $point_kb_staff['kb_3_staff'] ?? 0,

                    'kb_4_self'     => $point_kb_self['kb_4_self'] ?? 0,
                    'kb_4_atasan'   => $point_kb_atasan['kb_4_atasan'] ?? 0,
                    'kb_4_rekan'    => $point_kb_rekan['kb_4_rekan'] ?? 0,
                    'kb_4_staff'    => $point_kb_staff['kb_4_staff'] ?? 0,

                    'kb_5_self'     => $point_kb_self['kb_5_self'] ?? 0,
                    'kb_5_atasan'   => $point_kb_atasan['kb_5_atasan'] ?? 0,
                    'kb_5_rekan'    => $point_kb_rekan['kb_5_rekan'] ?? 0,
                    'kb_5_staff'    => $point_kb_staff['kb_5_staff'] ?? 0,

                    'kb_6_self'     => $point_kb_self['kb_6_self'] ?? 0,
                    'kb_6_atasan'   => $point_kb_atasan['kb_6_atasan'] ?? 0,
                    'kb_6_rekan'    => $point_kb_rekan['kb_6_rekan'] ?? 0,
                    'kb_6_staff'    => $point_kb_staff['kb_6_staff'] ?? 0,

                    'sum_kb_1_self' => $sum_point_kb_self['sum_kb_1_self'],
                    'sum_kb_1_atasan' => $sum_point_kb_atasan['sum_kb_1_atasan'],
                    'sum_kb_1_rekan' => $sum_point_kb_rekan['sum_kb_1_rekan'],
                    'sum_kb_1_staff' => $sum_point_kb_staff['sum_kb_1_staff'],
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
                // $point1['pb_1_self'] = collect($getPool[$key])->get('p_1_self') * 0.05;
                // $point1['pb_1_atasan'] = collect($getPool[$key])->get('p_1_atasan') * 0.60;
                // $point1['pb_1_rekan'] = collect($getPool[$key])->get('p_1_rekan') * 0.20;
                // $point1['pb_1_staff'] = collect($getPool[$key])->get('p_1_staff') * 0.15;
                // $sum_point_1['sum_pb_1'] = collect($point1)->sum();

                // $point2['pb_2_self'] = collect($getPool[$key])->get('p_2_self') * 0.05;
                // $point2['pb_2_atasan'] = collect($getPool[$key])->get('p_2_atasan') * 0.60;
                // $point2['pb_2_rekan'] = collect($getPool[$key])->get('p_2_rekan') * 0.20;
                // $point2['pb_2_staff'] = collect($getPool[$key])->get('p_2_staff') * 0.15;
                // $sum_point_2['sum_pb_2'] = collect($point2)->sum();

                // $point3['pb_3_self'] = collect($getPool[$key])->get('p_3_self') * 0.05;
                // $point3['pb_3_atasan'] = collect($getPool[$key])->get('p_3_atasan') * 0.60;
                // $point3['pb_3_rekan'] = collect($getPool[$key])->get('p_3_rekan') * 0.20;
                // $point3['pb_3_staff'] = collect($getPool[$key])->get('p_3_staff') * 0.15;
                // $sum_point_3['sum_pb_3'] = collect($point3)->sum();

                // $point4['pb_4_self'] = collect($getPool[$key])->get('p_4_self') * 0.05;
                // $point4['pb_4_atasan'] = collect($getPool[$key])->get('p_4_atasan') * 0.60;
                // $point4['pb_4_rekan'] = collect($getPool[$key])->get('p_4_rekan') * 0.20;
                // $point4['pb_4_staff'] = collect($getPool[$key])->get('p_4_staff') * 0.15;
                // $sum_point_4['sum_pb_4'] = collect($point4)->sum();
                
                // $point5['pb_5_self'] = collect($getPool[$key])->get('p_5_self') * 0.05;
                // $point5['pb_5_atasan'] = collect($getPool[$key])->get('p_5_atasan') * 0.60;
                // $point5['pb_5_rekan'] = collect($getPool[$key])->get('p_5_rekan') * 0.20;
                // $point5['pb_5_staff'] = collect($getPool[$key])->get('p_5_staff') * 0.15;
                // $sum_point_5['sum_pb_5'] = collect($point5)->sum();

                $point_pb_self['pb_1_self'] = round(collect($getPool[$key])->get('p_1_self'),2);
                $point_pb_atasan['pb_1_atasan'] = round(collect($getPool[$key])->get('p_1_atasan'),2);
                $point_pb_rekan['pb_1_rekan'] = round(collect($getPool[$key])->get('p_1_rekan'),2);
                $point_pb_staff['pb_1_staff'] = round(collect($getPool[$key])->get('p_1_staff'),2);

                $point_pb_self['pb_2_self'] = round(collect($getPool[$key])->get('p_2_self'),2);
                $point_pb_atasan['pb_2_atasan'] = round(collect($getPool[$key])->get('p_2_atasan'),2);
                $point_pb_rekan['pb_2_rekan'] = round(collect($getPool[$key])->get('p_2_rekan'),2);
                $point_pb_staff['pb_2_staff'] = round(collect($getPool[$key])->get('p_2_staff'),2);

                $point_pb_self['pb_3_self'] = round(collect($getPool[$key])->get('p_3_self'),2);
                $point_pb_atasan['pb_3_atasan'] = round(collect($getPool[$key])->get('p_3_atasan'),2);
                $point_pb_rekan['pb_3_rekan'] = round(collect($getPool[$key])->get('p_3_rekan'),2);
                $point_pb_staff['pb_3_staff'] = round(collect($getPool[$key])->get('p_3_staff'),2);

                $point_pb_self['pb_4_self'] = round(collect($getPool[$key])->get('p_4_self'),2);
                $point_pb_atasan['pb_4_atasan'] = round(collect($getPool[$key])->get('p_4_atasan'),2);
                $point_pb_rekan['pb_4_rekan'] = round(collect($getPool[$key])->get('p_4_rekan'),2);
                $point_pb_staff['pb_4_staff'] = round(collect($getPool[$key])->get('p_4_staff'),2);
                
                $point_pb_self['pb_5_self'] = round(collect($getPool[$key])->get('p_5_self'),2);
                $point_pb_atasan['pb_5_atasan'] = round(collect($getPool[$key])->get('p_5_atasan'),2);
                $point_pb_rekan['pb_5_rekan'] = round(collect($getPool[$key])->get('p_5_rekan'),2);
                $point_pb_staff['pb_5_staff'] = round(collect($getPool[$key])->get('p_5_staff'),2);
                
                $sum_point_pb_self['sum_pb_1_self'] = collect($point_pb_self)->sum();
                $sum_point_pb_atasan['sum_pb_1_atasan'] = collect($point_pb_atasan)->sum();
                $sum_point_pb_rekan['sum_pb_1_rekan'] = collect($point_pb_rekan)->sum();
                $sum_point_pb_staff['sum_pb_1_staff'] = collect($point_pb_staff)->sum();
                
            }else{
                // Kepemimpinan - Perencanaan
                // $point1['pb_1_self'] = collect($getPool[$key])->get('p_1_self') * 0.10;
                // $point1['pb_1_atasan'] = collect($getPool[$key])->get('p_1_atasan') * 0.65;
                // $point1['pb_1_rekan'] = collect($getPool[$key])->get('p_1_rekan') * 0.25;
                // $point1['pb_1_staff'] = 0;
                // $sum_point_1['sum_pb_1'] = collect($point1)->sum();

                // $point2['pb_2_self'] = collect($getPool[$key])->get('p_2_self') * 0.10;
                // $point2['pb_2_atasan'] = collect($getPool[$key])->get('p_2_atasan') * 0.65;
                // $point2['pb_2_rekan'] = collect($getPool[$key])->get('p_2_rekan') * 0.25;
                // $point2['pb_2_staff'] = 0;
                // $sum_point_2['sum_pb_2'] = collect($point2)->sum();

                // $point3['pb_3_self'] = collect($getPool[$key])->get('p_3_self') * 0.10;
                // $point3['pb_3_atasan'] = collect($getPool[$key])->get('p_3_atasan') * 0.65;
                // $point3['pb_3_rekan'] = collect($getPool[$key])->get('p_3_rekan') * 0.25;
                // $point3['pb_3_staff'] = 0;
                // $sum_point_3['sum_pb_3'] = collect($point3)->sum();

                // $point4['pb_4_self'] = collect($getPool[$key])->get('p_4_self') * 0.10;
                // $point4['pb_4_atasan'] = collect($getPool[$key])->get('p_4_atasan') * 0.65;
                // $point4['pb_4_rekan'] = collect($getPool[$key])->get('p_4_rekan') * 0.25;
                // $point4['pb_4_staff'] = 0;
                // $sum_point_4['sum_pb_4'] = collect($point4)->sum();
                
                // $point5['pb_5_self'] = collect($getPool[$key])->get('p_5_self') * 0.10;
                // $point5['pb_5_atasan'] = collect($getPool[$key])->get('p_5_atasan') * 0.65;
                // $point5['pb_5_rekan'] = collect($getPool[$key])->get('p_5_rekan') * 0.25;
                // $point5['pb_5_staff'] = 0;
                // $sum_point_5['sum_pb_5'] = collect($point5)->sum();

                $point_pb_self['pb_1_self'] = round(collect($getPool[$key])->get('p_1_self'),2);
                $point_pb_atasan['pb_1_atasan'] = round(collect($getPool[$key])->get('p_1_atasan'),2);
                $point_pb_rekan['pb_1_rekan'] = round(collect($getPool[$key])->get('p_1_rekan'),2);
                $point_pb_staff['pb_1_staff'] = 0;

                $point_pb_self['pb_2_self'] = round(collect($getPool[$key])->get('p_2_self'),2);
                $point_pb_atasan['pb_2_atasan'] = round(collect($getPool[$key])->get('p_2_atasan'),2);
                $point_pb_rekan['pb_2_rekan'] = round(collect($getPool[$key])->get('p_2_rekan'),2);
                $point_pb_staff['pb_2_staff'] = 0;

                $point_pb_self['pb_3_self'] = round(collect($getPool[$key])->get('p_3_self'),2);
                $point_pb_atasan['pb_3_atasan'] = round(collect($getPool[$key])->get('p_3_atasan'),2);
                $point_pb_rekan['pb_3_rekan'] = round(collect($getPool[$key])->get('p_3_rekan'),2);
                $point_pb_staff['pb_3_staff'] = 0;

                $point_pb_self['pb_4_self'] = round(collect($getPool[$key])->get('p_4_self'),2);
                $point_pb_atasan['pb_4_atasan'] = round(collect($getPool[$key])->get('p_4_atasan'),2);
                $point_pb_rekan['pb_4_rekan'] = round(collect($getPool[$key])->get('p_4_rekan'),2);
                $point_pb_staff['pb_4_staff'] = 0;
                
                $point_pb_self['pb_5_self'] = round(collect($getPool[$key])->get('p_5_self'),2);
                $point_pb_atasan['pb_5_atasan'] = round(collect($getPool[$key])->get('p_5_atasan'),2);
                $point_pb_rekan['pb_5_rekan'] = round(collect($getPool[$key])->get('p_5_rekan'),2);
                $point_pb_staff['pb_5_staff'] = 0;
                
                $sum_point_pb_self['sum_pb_1_self'] = collect($point_pb_self)->sum();
                $sum_point_pb_atasan['sum_pb_1_atasan'] = collect($point_pb_atasan)->sum();
                $sum_point_pb_rekan['sum_pb_1_rekan'] = collect($point_pb_rekan)->sum();
                $sum_point_pb_staff['sum_pb_1_staff'] = 0;
            }

            try {
                $store = RekapBobotPerilaku::updateOrCreate([
                    'tnb_perilaku_id' => $val['id'],
                ],[
                    'npp_dinilai_id'=> $val['npp_karyawan_id'],
                    'pb_1_self'     => $point_pb_self['pb_1_self'] ?? 0,
                    'pb_1_atasan'   => $point_pb_atasan['pb_1_atasan'] ?? 0,
                    'pb_1_rekan'    => $point_pb_rekan['pb_1_rekan'] ?? 0,
                    'pb_1_staff'    => $point_pb_staff['pb_1_staff'] ?? 0,

                    'pb_2_self'     => $point_pb_self['pb_2_self'] ?? 0,
                    'pb_2_atasan'   => $point_pb_atasan['pb_2_atasan'] ?? 0,
                    'pb_2_rekan'    => $point_pb_rekan['pb_2_rekan'] ?? 0,
                    'pb_2_staff'    => $point_pb_staff['pb_2_staff'] ?? 0,

                    'pb_3_self'     => $point_pb_self['pb_3_self'] ?? 0,
                    'pb_3_atasan'   => $point_pb_atasan['pb_3_atasan'] ?? 0,
                    'pb_3_rekan'    => $point_pb_rekan['pb_3_rekan'] ?? 0,
                    'pb_3_staff'    => $point_pb_staff['pb_3_staff'] ?? 0,

                    'pb_4_self'     => $point_pb_self['pb_4_self'] ?? 0,
                    'pb_4_atasan'   => $point_pb_atasan['pb_4_atasan'] ?? 0,
                    'pb_4_rekan'    => $point_pb_rekan['pb_4_rekan'] ?? 0,
                    'pb_4_staff'    => $point_pb_staff['pb_4_staff'] ?? 0,

                    'pb_5_self'     => $point_pb_self['pb_5_self'] ?? 0,
                    'pb_5_atasan'   => $point_pb_atasan['pb_5_atasan'] ?? 0,
                    'pb_5_rekan'    => $point_pb_rekan['pb_5_rekan'] ?? 0,
                    'pb_5_staff'    => $point_pb_staff['pb_5_staff'] ?? 0,

                    'sum_pb_1_self' => $sum_point_pb_self['sum_pb_1_self'],
                    'sum_pb_1_atasan' => $sum_point_pb_atasan['sum_pb_1_atasan'],
                    'sum_pb_1_rekan' => $sum_point_pb_rekan['sum_pb_1_rekan'],
                    'sum_pb_1_staff' => $sum_point_pb_staff['sum_pb_1_staff'],
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
                // $point1['sb_1_self'] = collect($getPool[$key])->get('s_1_self') * 0.05;
                // $point1['sb_1_atasan'] = collect($getPool[$key])->get('s_1_atasan') * 0.60;
                // $point1['sb_1_rekan'] = collect($getPool[$key])->get('s_1_rekan') * 0.20;
                // $point1['sb_1_staff'] = collect($getPool[$key])->get('s_1_staff') * 0.15;
                // $sum_point_1['sum_sb_1'] = collect($point1)->sum();

                // $point2['sb_2_self'] = collect($getPool[$key])->get('s_2_self') * 0.05;
                // $point2['sb_2_atasan'] = collect($getPool[$key])->get('s_2_atasan') * 0.60;
                // $point2['sb_2_rekan'] = collect($getPool[$key])->get('s_2_rekan') * 0.20;
                // $point2['sb_2_staff'] = collect($getPool[$key])->get('s_2_staff') * 0.15;
                // $sum_point_2['sum_sb_2'] = collect($point2)->sum();

                // $point3['sb_3_self'] = collect($getPool[$key])->get('s_3_self') * 0.05;
                // $point3['sb_3_atasan'] = collect($getPool[$key])->get('s_3_atasan') * 0.60;
                // $point3['sb_3_rekan'] = collect($getPool[$key])->get('s_3_rekan') * 0.20;
                // $point3['sb_3_staff'] = collect($getPool[$key])->get('s_3_staff') * 0.15;
                // $sum_point_3['sum_sb_3'] = collect($point3)->sum();

                // $point4['sb_4_self'] = collect($getPool[$key])->get('s_4_self') * 0.05;
                // $point4['sb_4_atasan'] = collect($getPool[$key])->get('s_4_atasan') * 0.60;
                // $point4['sb_4_rekan'] = collect($getPool[$key])->get('s_4_rekan') * 0.20;
                // $point4['sb_4_staff'] = collect($getPool[$key])->get('s_4_staff') * 0.15;
                // $sum_point_4['sum_sb_4'] = collect($point4)->sum();
                
                // $point5['sb_5_self'] = collect($getPool[$key])->get('s_5_self') * 0.05;
                // $point5['sb_5_atasan'] = collect($getPool[$key])->get('s_5_atasan') * 0.60;
                // $point5['sb_5_rekan'] = collect($getPool[$key])->get('s_5_rekan') * 0.20;
                // $point5['sb_5_staff'] = collect($getPool[$key])->get('s_5_staff') * 0.15;
                // $sum_point_5['sum_sb_5'] = collect($point5)->sum();

                $point_sb_self['sb_1_self'] = round(collect($getPool[$key])->get('s_1_self'),2);
                $point_sb_atasan['sb_1_atasan'] = round(collect($getPool[$key])->get('s_1_atasan'),2);
                $point_sb_rekan['sb_1_rekan'] = round(collect($getPool[$key])->get('s_1_rekan'),2);
                $point_sb_staff['sb_1_staff'] = round(collect($getPool[$key])->get('s_1_staff'),2);

                $point_sb_self['sb_2_self'] = round(collect($getPool[$key])->get('s_2_self'),2);
                $point_sb_atasan['sb_2_atasan'] = round(collect($getPool[$key])->get('s_2_atasan'),2);
                $point_sb_rekan['sb_2_rekan'] = round(collect($getPool[$key])->get('s_2_rekan'),2);
                $point_sb_staff['sb_2_staff'] = round(collect($getPool[$key])->get('s_2_staff'),2);

                $point_sb_self['sb_3_self'] = round(collect($getPool[$key])->get('s_3_self'),2);
                $point_sb_atasan['sb_3_atasan'] = round(collect($getPool[$key])->get('s_3_atasan'),2);
                $point_sb_rekan['sb_3_rekan'] = round(collect($getPool[$key])->get('s_3_rekan'),2);
                $point_sb_staff['sb_3_staff'] = round(collect($getPool[$key])->get('s_3_staff'),2);

                $point_sb_self['sb_4_self'] = round(collect($getPool[$key])->get('s_4_self'),2);
                $point_sb_atasan['sb_4_atasan'] = round(collect($getPool[$key])->get('s_4_atasan'),2);
                $point_sb_rekan['sb_4_rekan'] = round(collect($getPool[$key])->get('s_4_rekan'),2);
                $point_sb_staff['sb_4_staff'] = round(collect($getPool[$key])->get('s_4_staff'),2);
                
                $point_sb_self['sb_5_self'] = round(collect($getPool[$key])->get('s_5_self'),2);
                $point_sb_atasan['sb_5_atasan'] = round(collect($getPool[$key])->get('s_5_atasan'),2);
                $point_sb_rekan['sb_5_rekan'] = round(collect($getPool[$key])->get('s_5_rekan'),2);
                $point_sb_staff['sb_5_staff'] = round(collect($getPool[$key])->get('s_5_staff'),2);
                
                $sum_point_sb_self['sum_sb_1_self'] = collect($point_sb_self)->sum();
                $sum_point_sb_atasan['sum_sb_1_atasan'] = collect($point_sb_atasan)->sum();
                $sum_point_sb_rekan['sum_sb_1_rekan'] = collect($point_sb_rekan)->sum();
                $sum_point_sb_staff['sum_sb_1_staff'] = collect($point_sb_staff)->sum();
                
            }else{
                // Kepemimpinan - Perencanaan
                // $point1['sb_1_self'] = collect($getPool[$key])->get('s_1_self') * 0.10;
                // $point1['sb_1_atasan'] = collect($getPool[$key])->get('s_1_atasan') * 0.65;
                // $point1['sb_1_rekan'] = collect($getPool[$key])->get('s_1_rekan') * 0.25;
                // $point1['sb_1_staff'] = 0;
                // $sum_point_1['sum_sb_1'] = collect($point1)->sum();

                // $point2['sb_2_self'] = collect($getPool[$key])->get('s_2_self') * 0.10;
                // $point2['sb_2_atasan'] = collect($getPool[$key])->get('s_2_atasan') * 0.65;
                // $point2['sb_2_rekan'] = collect($getPool[$key])->get('s_2_rekan') * 0.25;
                // $point2['sb_2_staff'] = 0;
                // $sum_point_2['sum_sb_2'] = collect($point2)->sum();

                // $point3['sb_3_self'] = collect($getPool[$key])->get('s_3_self') * 0.10;
                // $point3['sb_3_atasan'] = collect($getPool[$key])->get('s_3_atasan') * 0.65;
                // $point3['sb_3_rekan'] = collect($getPool[$key])->get('s_3_rekan') * 0.25;
                // $point3['sb_3_staff'] = 0;
                // $sum_point_3['sum_sb_3'] = collect($point3)->sum();

                // $point4['sb_4_self'] = collect($getPool[$key])->get('s_4_self') * 0.10;
                // $point4['sb_4_atasan'] = collect($getPool[$key])->get('s_4_atasan') * 0.65;
                // $point4['sb_4_rekan'] = collect($getPool[$key])->get('s_4_rekan') * 0.25;
                // $point4['sb_4_staff'] = 0;
                // $sum_point_4['sum_sb_4'] = collect($point4)->sum();
                
                // $point5['sb_5_self'] = collect($getPool[$key])->get('s_5_self') * 0.10;
                // $point5['sb_5_atasan'] = collect($getPool[$key])->get('s_5_atasan') * 0.65;
                // $point5['sb_5_rekan'] = collect($getPool[$key])->get('s_5_rekan') * 0.25;
                // $point5['sb_5_staff'] = 0;
                // $sum_point_5['sum_pb_5'] = collect($point5)->sum();

                $point_sb_self['sb_1_self'] = round(collect($getPool[$key])->get('s_1_self'),2);
                $point_sb_atasan['sb_1_atasan'] = round(collect($getPool[$key])->get('s_1_atasan'),2);
                $point_sb_rekan['sb_1_rekan'] = round(collect($getPool[$key])->get('s_1_rekan'),2);
                $point_sb_staff['sb_1_staff'] = 0;

                $point_sb_self['sb_2_self'] = round(collect($getPool[$key])->get('s_2_self'),2);
                $point_sb_atasan['sb_2_atasan'] = round(collect($getPool[$key])->get('s_2_atasan'),2);
                $point_sb_rekan['sb_2_rekan'] = round(collect($getPool[$key])->get('s_2_rekan'),2);
                $point_sb_staff['sb_2_staff'] = 0;

                $point_sb_self['sb_3_self'] = round(collect($getPool[$key])->get('s_3_self'),2);
                $point_sb_atasan['sb_3_atasan'] = round(collect($getPool[$key])->get('s_3_atasan'),2);
                $point_sb_rekan['sb_3_rekan'] = round(collect($getPool[$key])->get('s_3_rekan'),2);
                $point_sb_staff['sb_3_staff'] = 0;

                $point_sb_self['sb_4_self'] = round(collect($getPool[$key])->get('s_4_self'),2);
                $point_sb_atasan['sb_4_atasan'] = round(collect($getPool[$key])->get('s_4_atasan'),2);
                $point_sb_rekan['sb_4_rekan'] = round(collect($getPool[$key])->get('s_4_rekan'),2);
                $point_sb_staff['sb_4_staff'] = 0;
                
                $point_sb_self['sb_5_self'] = round(collect($getPool[$key])->get('s_5_self'),2);
                $point_sb_atasan['sb_5_atasan'] = round(collect($getPool[$key])->get('s_5_atasan'),2);
                $point_sb_rekan['sb_5_rekan'] = round(collect($getPool[$key])->get('s_5_rekan'),2);
                $point_sb_staff['sb_5_staff'] = 0;
                
                $sum_point_sb_self['sum_sb_1_self'] = collect($point_sb_self)->sum();
                $sum_point_sb_atasan['sum_sb_1_atasan'] = collect($point_sb_atasan)->sum();
                $sum_point_sb_rekan['sum_sb_1_rekan'] = collect($point_sb_rekan)->sum();
                $sum_point_sb_staff['sum_sb_1_staff'] = 0;
            }

            try {
                $store = RekapBobotSasaran::updateOrCreate([
                    'tnb_sasaran_id' => $val['id'],
                ],[
                    'npp_dinilai_id'=> $val['npp_karyawan_id'],
                    'sb_1_self'     => $point_sb_self['sb_1_self'] ?? 0,
                    'sb_1_atasan'   => $point_sb_atasan['sb_1_atasan'] ?? 0,
                    'sb_1_rekan'    => $point_sb_rekan['sb_1_rekan'] ?? 0,
                    'sb_1_staff'    => $point_sb_staff['sb_1_staff'] ?? 0,

                    'sb_2_self'     => $point_sb_self['sb_2_self'] ?? 0,
                    'sb_2_atasan'   => $point_sb_atasan['sb_2_atasan'] ?? 0,
                    'sb_2_rekan'    => $point_sb_rekan['sb_2_rekan'] ?? 0,
                    'sb_2_staff'    => $point_sb_staff['sb_2_staff'] ?? 0,

                    'sb_3_self'     => $point_sb_self['sb_3_self'] ?? 0,
                    'sb_3_atasan'   => $point_sb_atasan['sb_3_atasan'] ?? 0,
                    'sb_3_rekan'    => $point_sb_rekan['sb_3_rekan'] ?? 0,
                    'sb_3_staff'    => $point_sb_staff['sb_3_staff'] ?? 0,

                    'sb_4_self'     => $point_sb_self['sb_4_self'] ?? 0,
                    'sb_4_atasan'   => $point_sb_atasan['sb_4_atasan'] ?? 0,
                    'sb_4_rekan'    => $point_sb_rekan['sb_4_rekan'] ?? 0,
                    'sb_4_staff'    => $point_sb_staff['sb_4_staff'] ?? 0,

                    'sb_5_self'     => $point_sb_self['sb_5_self'] ?? 0,
                    'sb_5_atasan'   => $point_sb_atasan['sb_5_atasan'] ?? 0,
                    'sb_5_rekan'    => $point_sb_rekan['sb_5_rekan'] ?? 0,
                    'sb_5_staff'    => $point_sb_staff['sb_5_staff'] ?? 0,

                    'sum_sb_1_self' => $sum_point_sb_self['sum_sb_1_self'],
                    'sum_sb_1_atasan' => $sum_point_sb_atasan['sum_sb_1_atasan'],
                    'sum_sb_1_rekan' => $sum_point_sb_rekan['sum_sb_1_rekan'],
                    'sum_sb_1_staff' => $sum_point_sb_staff['sum_sb_1_staff'],
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
    }
}
