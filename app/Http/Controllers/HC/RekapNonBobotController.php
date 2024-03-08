<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Google\Service\AndroidPublisher\RegionalBasePlanConfig;
use Illuminate\Http\Request;

use App\Models\PoolRespon;
use App\Models\RelasiKaryawan as RK;
use App\Models\RekapNonBobot as RNB;
use App\Models\RekapNonBobotPerilaku as RNBP;
use App\Models\RekapNonBobotSasaran as RNBS;
use Illuminate\Support\Facades\Cache;

class RekapNonBobotController extends Controller
{

    public function index()
    {
        $rekap_non_bobot_data = Cache::remember('rekap_non_bobot_kepemimpinan_data', now()->addMinutes(5), function(){
            return RNB::with('relasi_karyawan')->get(); 
        });
        // dd($rekap_non_bobot_data);
        return view('hc.rekap.bobot-non')->with([
            'non_bobot_data' => $rekap_non_bobot_data,
        ]);
    }
    public function index_perilaku()
    {
        $rekap_non_bobot_perilaku_data = Cache::remember('rekap_non_bobot_perilaku_data', now()->addMinutes(5), function(){
            return RNBP::with('relasi_karyawan')->get(); 
        });
        // dd($rekap_non_bobot_data);
        return view('hc.rekap.bobot-non-perilaku')->with([
            'non_bobot_perilaku_data' => $rekap_non_bobot_perilaku_data,
        ]);
    }

    public function index_sasaran()
    {
        $rekap_non_bobot_sasaran_data = Cache::remember('rekap_non_bobot_sasaran_data', now()->addMinutes(5), function(){
            return RNBS::with('relasi_karyawan')->get(); 
        });
        // dd($rekap_non_bobot_data);
        return view('hc.rekap.bobot-non-sasaran')->with([
            'non_bobot_sasaran_data' => $rekap_non_bobot_sasaran_data,
        ]);
    }

    public function rekap_kepemimpinan(Request $request)
    {
        $params = $request->boolean('refresh');
        // dd($params);
        if($params == true)
        {
            Cache::forget('rekap_non_bobot_kepemimpinan_data');
        }

        $getPool = [];
        $getPool = PoolRespon::select(
            'id',
            'npp_dinilai',
            'jabatan_dinilai',
        )->orderBy('npp_dinilai')->get()->toArray();
        
        $rekapKepemimpinanSelf = [];
        $rekapKepemimpinanAtasan = [];
        $rekapKepemimpinanSelevel = [];
        $rekapKepemimpinanStaff = [];

        // dd($getPool);

        foreach($getPool as $key =>$val){
            // dd($val['npp_dinilai']);
            // print_r($key);
            // get relasi self
            $rekapKepemimpinanSelf[$key] = PoolRespon::select(
                'strategi_perencanaan',
                'strategi_pengawasan',
                'strategi_inovasi',
                'kepemimpinan',
                'membimbing_membangun',
                'pengambilan_keputusan',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'self')->orderBy('npp_dinilai')->get()->toArray();
            // Self
            $summarySelf = [];
            if($rekapKepemimpinanSelf != null){
                // foreach($rekapKepemimpinanSelf as $key_self => $val_self){
                $summarySelf['k_1_self'] = collect($rekapKepemimpinanSelf[$key])->avg('strategi_perencanaan');
                $summarySelf['k_2_self'] = collect($rekapKepemimpinanSelf[$key])->avg('strategi_pengawasan');
                $summarySelf['k_3_self'] = collect($rekapKepemimpinanSelf[$key])->avg('strategi_inovasi');
                $summarySelf['k_4_self'] = collect($rekapKepemimpinanSelf[$key])->avg('kepemimpinan');
                $summarySelf['k_5_self'] = collect($rekapKepemimpinanSelf[$key])->avg('membimbing_membangun');
                $summarySelf['k_6_self'] = collect($rekapKepemimpinanSelf[$key])->avg('pengambilan_keputusan');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNB::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'k_1_self' => $summarySelf['k_1_self'] ?? 0,
                            'k_2_self' => $summarySelf['k_2_self'] ?? 0,
                            'k_3_self' => $summarySelf['k_3_self'] ?? 0,
                            'k_4_self' => $summarySelf['k_4_self'] ?? 0,
                            'k_5_self' => $summarySelf['k_5_self'] ?? 0,
                            'k_6_self' => $summarySelf['k_6_self'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
                
            }

            $rekapKepemimpinanAtasan[$key] = PoolRespon::select(
                'strategi_perencanaan',
                'strategi_pengawasan',
                'strategi_inovasi',
                'kepemimpinan',
                'membimbing_membangun',
                'pengambilan_keputusan'
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'atasan')->orderBy('npp_dinilai')->get()->toArray();

            $summaryAtasan = [];
            if($rekapKepemimpinanAtasan != null){
                // foreach ($rekapKepemimpinanAtasan as $key_selevel => $val_selevel) {
                    // dd($rekapKepemimpinanAtasan);
                    $summaryAtasan['k_1_atasan'] = collect($rekapKepemimpinanAtasan[$key])->avg('strategi_perencanaan');
                    $summaryAtasan['k_2_atasan'] = collect($rekapKepemimpinanAtasan[$key])->avg('strategi_pengawasan');
                    $summaryAtasan['k_3_atasan'] = collect($rekapKepemimpinanAtasan[$key])->avg('strategi_inovasi');
                    $summaryAtasan['k_4_atasan'] = collect($rekapKepemimpinanAtasan[$key])->avg('kepemimpinan');
                    $summaryAtasan['k_5_atasan'] = collect($rekapKepemimpinanAtasan[$key])->avg('membimbing_membangun');
                    $summaryAtasan['k_6_atasan'] = collect($rekapKepemimpinanAtasan[$key])->avg('pengambilan_keputusan');
                    // dd($summaryRekan);
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNB::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'k_1_atasan' => $summaryAtasan['k_1_atasan'] ?? 0,
                            'k_2_atasan' => $summaryAtasan['k_2_atasan'] ?? 0,
                            'k_3_atasan' => $summaryAtasan['k_3_atasan'] ?? 0,
                            'k_4_atasan' => $summaryAtasan['k_4_atasan'] ?? 0,
                            'k_5_atasan' => $summaryAtasan['k_5_atasan'] ?? 0,
                            'k_6_atasan' => $summaryAtasan['k_6_atasan'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }
    
            $rekapKepemimpinanSelevel[$key] = PoolRespon::select(
                'strategi_perencanaan',
                'strategi_pengawasan',
                'strategi_inovasi',
                'kepemimpinan',
                'membimbing_membangun',
                'pengambilan_keputusan'
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'rekanan')->orderBy('npp_dinilai')->get()->toArray();
            // dd($rekapKepemimpinanSelevel);
            
            // Rekanan / Selevel
            $summaryRekan = [];
            if($rekapKepemimpinanSelevel != null){
                // foreach ($rekapKepemimpinanSelevel as $key_selevel => $val_selevel) {
                    // dd($rekapKepemimpinanSelevel);
                    $summaryRekan['k_1_rekan'] = collect($rekapKepemimpinanSelevel[$key])->avg('strategi_perencanaan');
                    $summaryRekan['k_2_rekan'] = collect($rekapKepemimpinanSelevel[$key])->avg('strategi_pengawasan');
                    $summaryRekan['k_3_rekan'] = collect($rekapKepemimpinanSelevel[$key])->avg('strategi_inovasi');
                    $summaryRekan['k_4_rekan'] = collect($rekapKepemimpinanSelevel[$key])->avg('kepemimpinan');
                    $summaryRekan['k_5_rekan'] = collect($rekapKepemimpinanSelevel[$key])->avg('membimbing_membangun');
                    $summaryRekan['k_6_rekan'] = collect($rekapKepemimpinanSelevel[$key])->avg('pengambilan_keputusan');
                    // dd($summaryRekan);
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNB::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'k_1_rekan' => $summaryRekan['k_1_rekan'] ?? 0,
                            'k_2_rekan' => $summaryRekan['k_2_rekan'] ?? 0,
                            'k_3_rekan' => $summaryRekan['k_3_rekan'] ?? 0,
                            'k_4_rekan' => $summaryRekan['k_4_rekan'] ?? 0,
                            'k_5_rekan' => $summaryRekan['k_5_rekan'] ?? 0,
                            'k_6_rekan' => $summaryRekan['k_6_rekan'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }
    
            $rekapKepemimpinanStaff[$key] = PoolRespon::select(
                'strategi_perencanaan',
                'strategi_pengawasan',
                'strategi_inovasi',
                'kepemimpinan',
                'membimbing_membangun',
                'pengambilan_keputusan'
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'staff')->orderBy('npp_dinilai')->get()->toArray();
            // Staff
            $summaryStaff = [];
            if($rekapKepemimpinanStaff != null){
                // foreach ($rekapKepemimpinanSelevel as $key_selevel => $val_selevel) {
                    // dd($val_selevel);
                    $summaryStaff['k_1_staff'] = collect($rekapKepemimpinanStaff[$key])->avg('strategi_perencanaan');
                    $summaryStaff['k_2_staff'] = collect($rekapKepemimpinanStaff[$key])->avg('strategi_pengawasan');
                    $summaryStaff['k_3_staff'] = collect($rekapKepemimpinanStaff[$key])->avg('strategi_inovasi');
                    $summaryStaff['k_4_staff'] = collect($rekapKepemimpinanStaff[$key])->avg('kepemimpinan');
                    $summaryStaff['k_5_staff'] = collect($rekapKepemimpinanStaff[$key])->avg('membimbing_membangun');
                    $summaryStaff['k_6_staff'] = collect($rekapKepemimpinanStaff[$key])->avg('pengambilan_keputusan');
                    // dd($summaryRekan);
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNB::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'k_1_staff' => $summaryStaff['k_1_staff'] ?? 0,
                            'k_2_staff' => $summaryStaff['k_2_staff'] ?? 0,
                            'k_3_staff' => $summaryStaff['k_3_staff'] ?? 0,
                            'k_4_staff' => $summaryStaff['k_4_staff'] ?? 0,
                            'k_5_staff' => $summaryStaff['k_5_staff'] ?? 0,
                            'k_6_staff' => $summaryStaff['k_6_staff'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }

            // dd($summarySelf);

            //  dd($rekapKepemimpinanSelf); 

            //  // Rekanan / Selvel
            //  $summaryStaff = [];
            //  if($rekapKepemimpinanStaff != null){
            //     foreach($rekapKepemimpinanStaff as $keys => $vals){
            //     $summaryStaff['k_1_staff'] = collect($rekapKepemimpinanStaff)->avg('strategi_perencanaan');
            //     $summaryStaff['k_2_staff'] = collect($rekapKepemimpinanStaff)->avg('strategi_pengawasan');
            //     $summaryStaff['k_3_staff'] = collect($rekapKepemimpinanStaff)->avg('strategi_inovasi');
            //     $summaryStaff['k_4_staff'] = collect($rekapKepemimpinanStaff)->avg('kepemimpinan');
            //     $summaryStaff['k_5_staff'] = collect($rekapKepemimpinanStaff)->avg('membimbing_membangun');
            //     $summaryStaff['k_6_staff'] = collect($rekapKepemimpinanStaff)->avg('pengambilan_keputusan');
            //     }
            //  }
            //  dd($summarySelf,$summaryAtasan,$summaryRekan,$summaryStaff);

            // try {
            //     $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
            //     // dd($findIdKaryawan['id']);
            //     $store = RNB::updateOrCreate([
            //         'npp_karyawan_id' => $findIdKaryawan['id'],
            //     ],[
            //         'jabatan_dinilai' => $val['jabatan_dinilai'],
    
            //         'k_1_self' => $summarySelf['k_1_self'] ?? null,
            //         'k_2_self' => $summarySelf['k_2_self'] ?? null,
            //         'k_3_self' => $summarySelf['k_3_self'] ?? null,
            //         'k_4_self' => $summarySelf['k_4_self'] ?? null,
            //         'k_5_self' => $summarySelf['k_5_self'] ?? null,
            //         'k_6_self' => $summarySelf['k_6_self'] ?? null,
    
            //         'k_1_atasan' => $summaryAtasan['k_1_atasan'] ?? null,
            //         'k_2_atasan' => $summaryAtasan['k_2_atasan'] ?? null,
            //         'k_3_atasan' => $summaryAtasan['k_3_atasan'] ?? null,
            //         'k_4_atasan' => $summaryAtasan['k_4_atasan'] ?? null,
            //         'k_5_atasan' => $summaryAtasan['k_5_atasan'] ?? null,
            //         'k_6_atasan' => $summaryAtasan['k_6_atasan'] ?? null,
    
            //         'k_1_rekan' => $summaryRekan['k_1_rekan'] ?? null,
            //         'k_2_rekan' => $summaryRekan['k_2_rekan'] ?? null,
            //         'k_3_rekan' => $summaryRekan['k_3_rekan'] ?? null,
            //         'k_4_rekan' => $summaryRekan['k_4_rekan'] ?? null,
            //         'k_5_rekan' => $summaryRekan['k_5_rekan'] ?? null,
            //         'k_6_rekan' => $summaryRekan['k_6_rekan'] ?? null,
                    
            //         'k_1_staff' => $summaryStaff['k_1_staff'] ?? null,
            //         'k_2_staff' => $summaryStaff['k_2_staff'] ?? null,
            //         'k_3_staff' => $summaryStaff['k_3_staff'] ?? null,
            //         'k_4_staff' => $summaryStaff['k_4_staff'] ?? null,
            //         'k_5_staff' => $summaryStaff['k_5_staff'] ?? null,
            //         'k_6_staff' => $summaryStaff['k_6_staff'] ?? null,
            //     ]
            //     );
            //     dd($store);
            // } catch (\Illuminate\Database\QueryException $exception) {
            //     return response()->json($exception->getMessage());
            // }
            // echo '<pre>';
            // print_r($val['npp_dinilai']);
            // echo '</pre>';

        }

        // return $rekapKepemimpinan;
        // dd($rekapKepemimpinanSelf, $rekapKepemimpinanAtasan, $rekapKepemimpinanSelevel, $rekapKepemimpinanStaff);
    }

    public function rekap_perilaku(Request $request)
    {
        $params = $request->boolean('refresh');
        // dd($params);
        if($params == true)
        {
            Cache::forget('rekap_non_bobot_perilaku_data');
        }
        $getPool = [];
        $getPool = PoolRespon::select(
            'id',
            'npp_dinilai',
            'jabatan_dinilai',
        )->orderBy('npp_dinilai')->get()->toArray();
        
        $rekapPerilakuSelf = [];
        $rekapPerilakuAtasan = [];
        $rekapPerilakuSelevel = [];
        $rekapPerilakuStaff = [];
        // dd($getPool);
        foreach($getPool as $key =>$val){
            $rekapPerilakuSelf[$key] = PoolRespon::select(
                'kerjasama',
                'komunikasi',
                'absensi',
                'integritas',
                'etika',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'self')->orderBy('npp_dinilai')->get()->toArray();
            $summarySelf = [];
            if($rekapPerilakuSelf != null){
                $summarySelf['p_1_self'] = collect($rekapPerilakuSelf[$key])->avg('kerjasama');
                $summarySelf['p_2_self'] = collect($rekapPerilakuSelf[$key])->avg('komunikasi');
                $summarySelf['p_3_self'] = collect($rekapPerilakuSelf[$key])->avg('absensi');
                $summarySelf['p_4_self'] = collect($rekapPerilakuSelf[$key])->avg('integritas');
                $summarySelf['p_5_self'] = collect($rekapPerilakuSelf[$key])->avg('etika');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        $store = RNBP::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'p_1_self' => $summarySelf['p_1_self'] ?? 0,
                            'p_2_self' => $summarySelf['p_2_self'] ?? 0,
                            'p_3_self' => $summarySelf['p_3_self'] ?? 0,
                            'p_4_self' => $summarySelf['p_4_self'] ?? 0,
                            'p_5_self' => $summarySelf['p_5_self'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
            }

            $rekapPerilakuAtasan[$key] = PoolRespon::select(
                'kerjasama',
                'komunikasi',
                'absensi',
                'integritas',
                'etika',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'atasan')->orderBy('npp_dinilai')->get()->toArray();
            // dd($rekapPerilakuAtasan);
            $summaryAtasan = [];
            if($rekapPerilakuAtasan != null){
                    $summaryAtasan['p_1_atasan'] = collect($rekapPerilakuAtasan[$key])->avg('kerjasama');
                    $summaryAtasan['p_2_atasan'] = collect($rekapPerilakuAtasan[$key])->avg('komunikasi');
                    $summaryAtasan['p_3_atasan'] = collect($rekapPerilakuAtasan[$key])->avg('absensi');
                    $summaryAtasan['p_4_atasan'] = collect($rekapPerilakuAtasan[$key])->avg('integritas');
                    $summaryAtasan['p_5_atasan'] = collect($rekapPerilakuAtasan[$key])->avg('etika');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNBP::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'p_1_atasan' => $summaryAtasan['p_1_atasan'] ?? 0,
                            'p_2_atasan' => $summaryAtasan['p_2_atasan'] ?? 0,
                            'p_3_atasan' => $summaryAtasan['p_3_atasan'] ?? 0,
                            'p_4_atasan' => $summaryAtasan['p_4_atasan'] ?? 0,
                            'p_5_atasan' => $summaryAtasan['p_5_atasan'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }
    
            $rekapPerilakuSelevel[$key] = PoolRespon::select(
                'kerjasama',
                'komunikasi',
                'absensi',
                'integritas',
                'etika',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'rekanan')->orderBy('npp_dinilai')->get()->toArray();
            // dd($rekapPerilakuSelevel);
            // Rekanan / Selevel
            $summaryRekan = [];
            if($rekapPerilakuSelevel != null){
                    $summaryRekan['p_1_rekan'] = collect($rekapPerilakuSelevel[$key])->avg('kerjasama');
                    $summaryRekan['p_2_rekan'] = collect($rekapPerilakuSelevel[$key])->avg('komunikasi');
                    $summaryRekan['p_3_rekan'] = collect($rekapPerilakuSelevel[$key])->avg('absensi');
                    $summaryRekan['p_4_rekan'] = collect($rekapPerilakuSelevel[$key])->avg('integritas');
                    $summaryRekan['p_5_rekan'] = collect($rekapPerilakuSelevel[$key])->avg('etika');
                    // dd($summaryRekan);
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNBP::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'p_1_rekan' => $summaryRekan['p_1_rekan'] ?? 0,
                            'p_2_rekan' => $summaryRekan['p_2_rekan'] ?? 0,
                            'p_3_rekan' => $summaryRekan['p_3_rekan'] ?? 0,
                            'p_4_rekan' => $summaryRekan['p_4_rekan'] ?? 0,
                            'p_5_rekan' => $summaryRekan['p_5_rekan'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }
    
            $rekapPerilakuStaff[$key] = PoolRespon::select(
                'kerjasama',
                'komunikasi',
                'absensi',
                'integritas',
                'etika',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'staff')->orderBy('npp_dinilai')->get()->toArray();
            // Staff
            $summaryStaff = [];
            if($rekapPerilakuStaff != null){
                    $summaryStaff['p_1_staff'] = collect($rekapPerilakuStaff[$key])->avg('kerjasama');
                    $summaryStaff['p_2_staff'] = collect($rekapPerilakuStaff[$key])->avg('komunikasi');
                    $summaryStaff['p_3_staff'] = collect($rekapPerilakuStaff[$key])->avg('absensi');
                    $summaryStaff['p_4_staff'] = collect($rekapPerilakuStaff[$key])->avg('integritas');
                    $summaryStaff['p_5_staff'] = collect($rekapPerilakuStaff[$key])->avg('etika');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        $store = RNBP::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            'p_1_staff' => $summaryStaff['p_1_staff'] ?? 0,
                            'p_2_staff' => $summaryStaff['p_2_staff'] ?? 0,
                            'p_3_staff' => $summaryStaff['p_3_staff'] ?? 0,
                            'p_4_staff' => $summaryStaff['p_4_staff'] ?? 0,
                            'p_5_staff' => $summaryStaff['p_5_staff'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
            }
        }
    }

    public function rekap_sasaran(Request $request)
    {
        $params = $request->boolean('refresh');
        if($params == true)
        {
            Cache::forget('rekap_non_bobot_sasaran_data');
        }
        $getPool = [];
        $getPool = PoolRespon::select(
            'id',
            'npp_dinilai',
            'jabatan_dinilai',
        )->orderBy('npp_dinilai')->get()->toArray();
        
        $rekapSasaranStaff = [];
        $rekapSasaranAtasan = [];
        $rekapSasaranSelevel = [];
        $rekapSasaranStaff = [];
        // dd($getPool);
        foreach($getPool as $key =>$val){
            $rekapSasaranStaff[$key] = PoolRespon::select(
                'goal_kinerja',
                'error_kinerja',
                'proses_dokumen',
                'proses_inisiatif',
                'proses_polapikir',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'self')->orderBy('npp_dinilai')->get()->toArray();
            // dd($getPool);
            $summarySelf = [];
            if($rekapSasaranStaff != null){
                $summarySelf['s_1_self'] = collect($rekapSasaranStaff[$key])->avg('goal_kinerja');
                $summarySelf['s_2_self'] = collect($rekapSasaranStaff[$key])->avg('error_kinerja');
                $summarySelf['s_3_self'] = collect($rekapSasaranStaff[$key])->avg('proses_dokumen');
                $summarySelf['s_4_self'] = collect($rekapSasaranStaff[$key])->avg('proses_inisiatif');
                $summarySelf['s_5_self'] = collect($rekapSasaranStaff[$key])->avg('proses_polapikir');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        $store = RNBS::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            's_1_self' => $summarySelf['s_1_self'] ?? 0,
                            's_2_self' => $summarySelf['s_2_self'] ?? 0,
                            's_3_self' => $summarySelf['s_3_self'] ?? 0,
                            's_4_self' => $summarySelf['s_4_self'] ?? 0,
                            's_5_self' => $summarySelf['s_5_self'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
            }

            $rekapSasaranAtasan[$key] = PoolRespon::select(
                'goal_kinerja',
                'error_kinerja',
                'proses_dokumen',
                'proses_inisiatif',
                'proses_polapikir',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'atasan')->orderBy('npp_dinilai')->get()->toArray();
            // dd($rekapSasaranAtasan);
            $summaryAtasan = [];
            if($rekapSasaranAtasan != null){
                    $summaryAtasan['s_1_atasan'] = collect($rekapSasaranAtasan[$key])->avg('goal_kinerja');
                    $summaryAtasan['s_2_atasan'] = collect($rekapSasaranAtasan[$key])->avg('error_kinerja');
                    $summaryAtasan['s_3_atasan'] = collect($rekapSasaranAtasan[$key])->avg('proses_dokumen');
                    $summaryAtasan['s_4_atasan'] = collect($rekapSasaranAtasan[$key])->avg('proses_inisiatif');
                    $summaryAtasan['s_5_atasan'] = collect($rekapSasaranAtasan[$key])->avg('proses_polapikir');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNBS::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            's_1_atasan' => $summaryAtasan['s_1_atasan'] ?? 0,
                            's_2_atasan' => $summaryAtasan['s_2_atasan'] ?? 0,
                            's_3_atasan' => $summaryAtasan['s_3_atasan'] ?? 0,
                            's_4_atasan' => $summaryAtasan['s_4_atasan'] ?? 0,
                            's_5_atasan' => $summaryAtasan['s_5_atasan'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }
    
            $rekapSasaranSelevel[$key] = PoolRespon::select(
                'goal_kinerja',
                'error_kinerja',
                'proses_dokumen',
                'proses_inisiatif',
                'proses_polapikir',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'rekanan')->orderBy('npp_dinilai')->get()->toArray();
            // dd($rekapSasaranSelevel);
            // Rekanan / Selevel
            $summaryRekan = [];
            if($rekapSasaranSelevel != null){
                    $summaryRekan['s_1_rekan'] = collect($rekapSasaranSelevel[$key])->avg('goal_kinerja');
                    $summaryRekan['s_2_rekan'] = collect($rekapSasaranSelevel[$key])->avg('error_kinerja');
                    $summaryRekan['s_3_rekan'] = collect($rekapSasaranSelevel[$key])->avg('proses_dokumen');
                    $summaryRekan['s_4_rekan'] = collect($rekapSasaranSelevel[$key])->avg('proses_inisiatif');
                    $summaryRekan['s_5_rekan'] = collect($rekapSasaranSelevel[$key])->avg('proses_polapikir');
                    // dd($summaryRekan);
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        // dd($findIdKaryawan);
                        $store = RNBS::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            's_1_rekan' => $summaryRekan['s_1_rekan'] ?? 0,
                            's_2_rekan' => $summaryRekan['s_2_rekan'] ?? 0,
                            's_3_rekan' => $summaryRekan['s_3_rekan'] ?? 0,
                            's_4_rekan' => $summaryRekan['s_4_rekan'] ?? 0,
                            's_5_rekan' => $summaryRekan['s_5_rekan'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
                // }
            }
    
            $rekapSasaranStaff[$key] = PoolRespon::select(
                'goal_kinerja',
                'error_kinerja',
                'proses_dokumen',
                'proses_inisiatif',
                'proses_polapikir',
            )
            ->where('npp_dinilai', $val['npp_dinilai'])
            ->where('relasi', 'staff')->orderBy('npp_dinilai')->get()->toArray();
            // Staff
            $summaryStaff = [];
            if($rekapSasaranStaff != null){
                    $summaryStaff['s_1_staff'] = collect($rekapSasaranStaff[$key])->avg('goal_kinerja');
                    $summaryStaff['s_2_staff'] = collect($rekapSasaranStaff[$key])->avg('error_kinerja');
                    $summaryStaff['s_3_staff'] = collect($rekapSasaranStaff[$key])->avg('proses_dokumen');
                    $summaryStaff['s_4_staff'] = collect($rekapSasaranStaff[$key])->avg('proses_inisiatif');
                    $summaryStaff['s_5_staff'] = collect($rekapSasaranStaff[$key])->avg('proses_polapikir');
                    try {
                        $findIdKaryawan = RK::where('npp_karyawan', $val['npp_dinilai'])->first()->toArray();
                        $store = RNBS::updateOrCreate([
                            'npp_karyawan_id' => $findIdKaryawan['id'],
                        ],[
                            'pool_respon_id' => $val['id'],
                            'jabatan_dinilai' => $val['jabatan_dinilai'],
                            's_1_staff' => $summaryStaff['s_1_staff'] ?? 0,
                            's_2_staff' => $summaryStaff['s_2_staff'] ?? 0,
                            's_3_staff' => $summaryStaff['s_3_staff'] ?? 0,
                            's_4_staff' => $summaryStaff['s_4_staff'] ?? 0,
                            's_5_staff' => $summaryStaff['s_5_staff'] ?? 0,
                        ]
                        );
                        // dd($store);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        return response()->json($exception->getMessage());
                    } 
            }
        }
    }

}