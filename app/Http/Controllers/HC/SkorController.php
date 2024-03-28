<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\RelasiAtasan;
use App\Models\RelasiSelevel;
use App\Models\RelasiStaff;
use Illuminate\Http\Request;
use App\Models\ScoreJawaban as Skor;
use App\Models\Aspek;
use App\Models\GResponse;
use App\Models\PoolRespon;
use App\Models\RelasiKaryawan;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExt;
use Carbon\Carbon;
use App\Exports\SkorAllExport;

class SkorController extends Controller
{

    public function index()
    {
        $skor_data = Skor::with('aspek','indikator')->get(); 
        $aspek_data = Aspek::get(); 

        // $skor_data = Cache::remember('skor_data', now()->addMinutes(5), function(){
        //     return Skor::with('aspek','indikator')->get(); 
        // });
        // $aspek_data = Cache::remember('aspek_data', now()->addMinutes(5), function(){
        //     return Aspek::get(); 
        // });

        return view('hc.skor.index')->with([
            'data_skor' => $skor_data,
            'data_aspek' => $aspek_data,
        ]);
    }

    public function destroy($id)
    {
        try {
            $delete = Skor::find($id)->delete();
            if($delete){
                return redirect()->back()->withSuccess('berhasil menghapus data');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    
    public function reset()
    {
        try {
            $pool = PoolRespon::truncate();
            if($pool){
                return redirect()->back()->withSuccess('tabel di kosongkan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }

    }

    public function storeAjax(Request $request)
    {
        $tempData = [];
        try {
            $validated = $request->validate([
                'aspek_id' => 'required',
                'indikator_id' => 'required',
                'jawaban' => 'required',
                'skor' => 'required',
            ]);
            $store = Skor::updateOrCreate($validated);
            if($store == true){
                $tempData['data'] = [
                    'title' => "berhasil",
                    'html' => "berhasil menambahkan data <b></b>",
                    'icon' => "success",
                ];
                return response()->json($tempData);
            }else{
                $tempData['data'] = [
                    'title' => "gagal",
                    'html' => "gagal menambahkan data <b></b>",
                    'icon' => "error",
                ];
                return response()->json($tempData);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->getMessage());
        }   
    }
    public function updateAjax(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'aspek_id' => 'required',
                'indikator_id' => 'required',
                'jawaban' => 'required',
                'skor' => 'required',
            ]);
            if($validated){
                $store = Skor::find($id)->update($validated);
                if($store){
                    $tempData['data'] = [
                        'title' => "berhasil",
                        'html' => "berhasil edit data <b></b>",
                        'icon' => "success",
                    ];
                    return response()->json($tempData);
                }else{
                    $tempData['data'] = [
                        'title' => "gagal",
                        'html' => "gagal edit data <b></b>",
                        'icon' => "error",
                    ];
                    return response()->json($tempData);
                }
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->getMessage());
        }   
    }

    public function export()
    {
        $nows = Carbon::now()->toDateTimeString().'.xlsx';
        return Excel::download(new SkorAllExport, 'PoolRespon_'.$nows,ExcelExt::XLSX);
    }
    
    public function exportCsv()
    {
        $nows = Carbon::now()->toDateTimeString().'.csv';
        return Excel::download(new SkorAllExport, 'PoolRespon_'.$nows,ExcelExt::CSV);
    }

    public function index_pool_all()
    {
        $skor_pool_data = PoolRespon::with('karyawan')->orderBy('npp_dinilai')
        ->orderByDesc('sum_nilai')
        ->get();

        return view('hc.skor.pool.all')->with([
            'data_pool_skor' => $skor_pool_data
        ]);
    }

    public function index_pool_self()
    {
        $skor_pool_data = PoolRespon::with('karyawan')->where('relasi','self')->get(); 
        // $skor_pool_data = Cache::remember('skor_pool_data_self', now()->addMinutes(5), function(){
        //     return PoolRespon::with('karyawan')->where('relasi','self')->get(); 
        // });

        return view('hc.skor.pool.self')->with([
            'data_pool_skor' => $skor_pool_data,
        ]);
    }

    public function index_pool_atasan()
    {
        $skor_pool_data = PoolRespon::with('karyawan')->where('relasi','atasan')->get(); 

        // $skor_pool_data = Cache::remember('skor_pool_data_atasan', now()->addMinutes(5), function(){
        //     return PoolRespon::with('karyawan')->where('relasi','atasan')->get(); 
        // });

        return view('hc.skor.pool.atasan')->with([
            'data_pool_skor' => $skor_pool_data,
        ]);
    }

    public function index_pool_rekanan()
    {
        $skor_pool_data = PoolRespon::with('karyawan')->where('relasi','rekanan')->get(); 

        // $skor_pool_data = Cache::remember('skor_pool_data_rekanan', now()->addMinutes(5), function(){
        //     return PoolRespon::with('karyawan')->where('relasi','rekanan')->get(); 
        // });

        return view('hc.skor.pool.rekanan')->with([
            'data_pool_skor' => $skor_pool_data,
        ]);
    }

    public function index_pool_staff()
    {
        $skor_pool_data = PoolRespon::with('karyawan')->where('relasi','staff')->get();

        // $skor_pool_data = Cache::remember('skor_pool_data_staff', now()->addMinutes(5), function(){
        //     return PoolRespon::with('karyawan')->where('relasi','staff')->get();
        // });

        return view('hc.skor.pool.staff')->with([
            'data_pool_skor' => $skor_pool_data,
        ]);
    }

    public function find_karyawan($npp=null)
    {
        // $find_karyawan = Cache::remember('relasi_karyawan', now()->addMinutes(5), function() use($npp){
            return RelasiKaryawan::where('npp_karyawan', $npp)->get();
            // return RelasiKaryawan::get();
            // return RelasiKaryawan::where('npp_karyawan', $npp)->get();
        // });
        // return $find_karyawan;
    }

    public function find_karyawan_relasi($relasi = null, $npp_karyawan = null)
    {
        if($relasi == 'atasan')
        {
            // $find_relasi = Cache::remember('relasi_karyawan_atasan', now()->addMinutes(5), function() use($npp_karyawan){
                return RelasiAtasan::where('relasi_karyawan_id', $npp_karyawan)->first();
            // });
            // return $find_relasi;
        }
        elseif($relasi == 'rekanan')
        {
            // $find_relasi = Cache::remember('relasi_karyawan_rekanan', now()->addMinutes(5), function() use($npp_karyawan){
                return RelasiSelevel::where('relasi_karyawan_id', $npp_karyawan)->first();
            // });
            // return $find_relasi;
        }
        elseif($relasi == 'staff')
        {
            // $find_relasi = Cache::remember('relasi_karyawan_staff', now()->addMinutes(5), function() use($npp_karyawan){
                return RelasiStaff::where('relasi_karyawan_id', $npp_karyawan)->get();
            // });
            // return $find_relasi;
        }
    }

    public function pool_all(Request $request)
    {
        $this->pool_self($request);
        $this->pool_atasan($request);
        $this->pool_rekanan($request);
        $this->pool_staff($request);
    }

    public function pool_self(Request $request)
    {   
        // $params = $request->boolean('refresh');
        // dd($params);
        // if($params == true)
        // {
        //     Cache::forget('skor_jawaban_data');
        //     Cache::forget('google_form_respon');
        //     Cache::forget('npp_karyawan');
        //     Cache::forget('skor_pool_data_self');
        //     Cache::forget('relasi_karyawan_self');
        // }
        // $skor_jawaban_data = Cache::remember('skor_jawaban_data', now()->addMinutes(5), function(){
            // return Skor::get()->groupBy('aspek_id')->toArray();
        // });
        $skor_jawaban_data = Skor::get()->groupBy('aspek_id')->toArray();

        // $google_form = Cache::remember('google_form_respon', now()->addMinutes(5), function(){
        //     return GResponse::get()->toArray();
        // });

        $google_form = GResponse::get()->toArray();

        // dd($google_form);

        $temp = [];
        $self = [];
        $slugs_relasi = 'self';
        foreach($google_form as $key => $value)
        {
            if($google_form[$key]['npp_penilai'] == $google_form[$key]['npp_dinilai'])
            {
                // $temp = $google_form[$key]['npp_dinilai'];
                $temp = $google_form[$key];
                array_push($self,$temp);
            }
        }
        // Pembagian Segment
        $kepemimpinan = $skor_jawaban_data[1];
        $perilaku = $skor_jawaban_data[2];
        $sasaran = $skor_jawaban_data[3];
        $karyawan = [];
        $tempData = [];
        // $debug1 = [];

        // dd($self);
        // dd($skor_jawaban_data);
        $store = false;
        foreach($self as $key => $value)
        {
            $nilai_skor_1 = 0;$nilai_skor_2 = 0;$nilai_skor_3 = 0;$nilai_skor_4 = 0;
            $nilai_skor_5 = 0;$nilai_skor_6 = 0;

            $nilai_skor_7 = 0;$nilai_skor_8 = 0;$nilai_skor_9 = 0;$nilai_skor_10 = 0;
            $nilai_skor_11 = 0;
            
            $nilai_skor_12 = 0;$nilai_skor_13 = 0;$nilai_skor_14 = 0;$nilai_skor_15 = 0;
            $nilai_skor_16 = 0;

            $self_1 = '';$self_2 = '';$self_3 = '';$self_4 = '';$self_5 = '';$self_6 = '';
            $self_7 = '';$self_8 = '';$self_9 = '';$self_10 = '';$self_11 = '';$self_12 = '';
            $self_13 = '';$self_14 = '';$self_15 = '';$self_16 = '';

            foreach($kepemimpinan as $keys => $value)
            {
                  // Kepemimpinan
                $self_1 = str($self[$key]['strategi_perencanaan'])->squish();
                $self_2 = str($self[$key]['strategi_pengawasan'])->squish();
                $self_3 = str($self[$key]['strategi_inovasi'])->squish();
                $self_4 = str($self[$key]['kepemimpinan'])->squish();
                $self_5 = str($self[$key]['membimbing_membangun'])->squish();
                $self_6 = str($self[$key]['pengambilan_keputusan'])->squish();

                if($self_1 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_1 = $kepemimpinan[$keys]['skor'];}
                if($self_2 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_2 = $kepemimpinan[$keys]['skor'];}
                if($self_3 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_3 = $kepemimpinan[$keys]['skor'];}
                if($self_4 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_4 = $kepemimpinan[$keys]['skor'];}
                if($self_5 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_5 = $kepemimpinan[$keys]['skor'];}
                if($self_6 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_6 = $kepemimpinan[$keys]['skor'];}
            }
            
            foreach($sasaran as $keys => $value)
            {
                // $x = str($perilaku[6]['jawaban'])->squish();
                // Perilaku
                $self_7 = str($self[$key]['kerjasama'])->squish();
                $self_8 = str($self[$key]['komunikasi'])->squish();
                $self_9 = str($self[$key]['absensi'])->squish();
                $self_10 = str($self[$key]['integritas'])->squish();
                $self_11 = str($self[$key]['etika'])->squish();
                if($self_7 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_7 = $perilaku[$keys]['skor'];}
                if($self_8 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_8 = $perilaku[$keys]['skor'];}
                if($self_9 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_9 = $perilaku[$keys]['skor'];}
                if($self_10 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_10 = $perilaku[$keys]['skor'];}
                if($self_11 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_11 = $perilaku[$keys]['skor'];}

                // dd($self_8, $x);
            }
            
            foreach($perilaku as $keys => $value)
            {
                // Sasaran
                $self_12 = str($self[$key]['goal_kinerja'])->squish();
                $self_13 = str($self[$key]['error_kinerja'])->squish();
                $self_14 = str($self[$key]['proses_dokumen'])->squish();
                $self_15 = str($self[$key]['proses_inisiatif'])->squish();
                $self_16 = str($self[$key]['proses_polapikir'])->squish();
                if($self_12 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_12 = $sasaran[$keys]['skor'];}
                if($self_13 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_13 = $sasaran[$keys]['skor'];}
                if($self_14 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_14 = $sasaran[$keys]['skor'];}
                if($self_15 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_15 = $sasaran[$keys]['skor'];}
                if($self_16 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_16 = $sasaran[$keys]['skor'];}
            }

            // $temp_nilai[$self[$key]['npp_dinilai']] = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
            // array_push($summary_nilai, $temp_nilai);
            $temp_nilai = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
            // unset($karyawan);
            $karyawan = [];
            // $karyawan = $this->find_karyawan($self[$key]['npp_penilai'])->toArray();
            $karyawan = RelasiKaryawan::where('npp_karyawan', $self[$key]['npp_penilai'])->first() ?? '';
            // dd($temp_nilai);
            // $id_npp_sementara = '';
            // $id_npp_sementara = $karyawan[$key]['id'];
            // dd($id_npp_sementara);
            
            if($karyawan != ''){
                $karyawan->toArray();
                $tempData = [
                    'npp_penilai' => $karyawan['id'],
                    'npp_dinilai' => $self[$key]['npp_dinilai'],
                    'jabatan_dinilai' => $self[$key]['jabatan_dinilai'],

                    'strategi_perencanaan' => $nilai_skor_1,
                    'strategi_pengawasan' => $nilai_skor_2,
                    'strategi_inovasi' => $nilai_skor_3,
                    'kepemimpinan' => $nilai_skor_4,
                    'membimbing_membangun' => $nilai_skor_5,
                    'pengambilan_keputusan' => $nilai_skor_6,

                    'kerjasama' => $nilai_skor_7,
                    'komunikasi' => $nilai_skor_8,
                    'absensi' => $nilai_skor_9,
                    'integritas' => $nilai_skor_10,
                    'etika' => $nilai_skor_11,

                    'goal_kinerja' => $nilai_skor_12,
                    'error_kinerja' => $nilai_skor_13,
                    'proses_dokumen' => $nilai_skor_14,
                    'proses_inisiatif' => $nilai_skor_15,
                    'proses_polapikir' => $nilai_skor_16,

                    'sum_nilai' => $temp_nilai,
                    'relasi' => $slugs_relasi
                ];
                $store = PoolRespon::updateOrCreate($tempData);
                // dd($tempData);
            }
            $tempData = [];
        }
        if($store == true)
        {
            return response()->json([
                'title' => 'success!',
                'html' => 'berhasil pool data dari database',
                'icons' => 'success',
            ]);
        }
        else
        {
            return response()->json([ 
                'title' => 'error!',
                'html' => 'gagal pool data dari database',
                'icons' => 'warning',
            ]);
        }
    }

    // Harusnya menjadi relasi staff , karena staff menilai atasan
    // public function pool_atasan(Request $request)
    public function pool_staff(Request $request)
    {   
        $params = $request->boolean('refresh');
        if($params == true)
        {
            Cache::forget('skor_jawaban_data');
            Cache::forget('google_form_respon');
            Cache::forget('npp_karyawan');
            Cache::forget('skor_pool_data_atasan');
            Cache::forget('relasi_karyawan_atasan');
        }
        // $skor_jawaban_data = Cache::remember('skor_jawaban_data', now()->addMinutes(5), function(){
        //     return Skor::get()->groupBy('aspek_id')->toArray();
        // });

        // $google_form = Cache::remember('google_form_respon', now()->addMinutes(5), function(){
        //     return GResponse::get()->toArray();
        // });

        $skor_jawaban_data = Skor::get()->groupBy('aspek_id')->toArray();
        $google_form = GResponse::get()->toArray();

        $temp = [];
        $atasan = [];
        $findrelasi = [];
        $npp_karyawan = [];
        $slugs_relasi = 'atasan';
        foreach($google_form as $key => $value)
        {
            if($google_form[$key]['npp_penilai'] != $google_form[$key]['npp_dinilai'])
            {
                $idRelasiKaryawan = RelasiKaryawan::where('npp_karyawan', $google_form[$key]['npp_penilai'])->first();
                if($idRelasiKaryawan){
                    $idRelasiKaryawan->toArray();
                    // dd($idRelasiKaryawan['id']);
                    // $findrelasi = RelasiAtasan::where('relasi_karyawan_id',$idRelasiKaryawan['id'])->first()->toArray();
                    $findrelasi = $this->find_karyawan_relasi('atasan', $idRelasiKaryawan['id']);
                    // dd($findrelasi);
                    if($findrelasi)
                    {
                        $findrelasi->toArray();
                        if($findrelasi['npp_atasan'] != $google_form[$key]['npp_dinilai']){
                            continue;
                        }elseif($findrelasi['npp_atasan'] == $google_form[$key]['npp_dinilai']){
                            $npp_karyawan[] = $idRelasiKaryawan['id'];
                            $temp = $google_form[$key];
                            array_push($atasan,$temp);
                        }
                    }
                    
                    
                    // dd($temp);
                }
                
            }
        }
        // dd($atasan);
        // Pembagian Segment
        $kepemimpinan = $skor_jawaban_data[1];
        $perilaku = $skor_jawaban_data[2];
        $sasaran = $skor_jawaban_data[3];
        $tempData = [];

        foreach($atasan as $key => $value)
        {
            $nilai_skor_1 = 0;$nilai_skor_2 = 0;$nilai_skor_3 = 0;$nilai_skor_4 = 0;
            $nilai_skor_5 = 0;$nilai_skor_6 = 0;$nilai_skor_7 = 0;$nilai_skor_8 = 0;
            $nilai_skor_9 = 0;$nilai_skor_10 = 0;$nilai_skor_11 = 0;$nilai_skor_12 = 0;
            $nilai_skor_13 = 0;$nilai_skor_14 = 0;$nilai_skor_15 = 0; $nilai_skor_16 = 0;

            $point_1 = '';$point_2 = '';$point_3 = '';$point_4 = '';$point_5 = '';$point_6 = '';
            $point_7 = '';$point_8 = '';$point_9 = '';$point_10 = '';$point_11 = '';$point_12 = '';
            $point_13 = '';$point_14 = '';$point_15 = '';$point_16 = '';

            foreach($kepemimpinan as $keys => $value)
            {
                  // Kepemimpinan
                $point_1 = str($atasan[$key]['strategi_perencanaan'])->squish();
                $point_2 = str($atasan[$key]['strategi_pengawasan'])->squish();
                $point_3 = str($atasan[$key]['strategi_inovasi'])->squish();
                $point_4 = str($atasan[$key]['kepemimpinan'])->squish();
                $point_5 = str($atasan[$key]['membimbing_membangun'])->squish();
                $point_6 = str($atasan[$key]['pengambilan_keputusan'])->squish();

                if($point_1 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_1 = $kepemimpinan[$keys]['skor'];}
                if($point_2 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_2 = $kepemimpinan[$keys]['skor'];}
                if($point_3 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_3 = $kepemimpinan[$keys]['skor'];}
                if($point_4 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_4 = $kepemimpinan[$keys]['skor'];}
                if($point_5 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_5 = $kepemimpinan[$keys]['skor'];}
                if($point_6 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_6 = $kepemimpinan[$keys]['skor'];}
            }
            
            foreach($sasaran as $keys => $value)
            {
                // Perilaku
                $point_7 = str($atasan[$key]['kerjasama'])->squish();
                $point_8 = str($atasan[$key]['komunikasi'])->squish();
                $point_9 = str($atasan[$key]['absensi'])->squish();
                $point_10 = str($atasan[$key]['integritas'])->squish();
                $point_11 = str($atasan[$key]['etika'])->squish();
                if($point_7 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_7 = $perilaku[$keys]['skor'];}
                if($point_8 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_8 = $perilaku[$keys]['skor'];}
                if($point_9 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_9 = $perilaku[$keys]['skor'];}
                if($point_10 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_10 = $perilaku[$keys]['skor'];}
                if($point_11 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_11 = $perilaku[$keys]['skor'];}
            }
            
            foreach($perilaku as $keys => $value)
            {
                // Sasaran
                $point_12 = str($atasan[$key]['goal_kinerja'])->squish();
                $point_13 = str($atasan[$key]['error_kinerja'])->squish();
                $point_14 = str($atasan[$key]['proses_dokumen'])->squish();
                $point_15 = str($atasan[$key]['proses_inisiatif'])->squish();
                $point_16 = str($atasan[$key]['proses_polapikir'])->squish();
                if($point_12 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_12 = $sasaran[$keys]['skor'];}
                if($point_13 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_13 = $sasaran[$keys]['skor'];}
                if($point_14 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_14 = $sasaran[$keys]['skor'];}
                if($point_15 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_15 = $sasaran[$keys]['skor'];}
                if($point_16 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_16 = $sasaran[$keys]['skor'];}
            }
            $temp_nilai = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
            // dd($npp_karyawan);
            $tempData = [
                'npp_penilai' => $npp_karyawan[$key],
                'npp_dinilai' => $atasan[$key]['npp_dinilai'],
                'jabatan_dinilai' => $atasan[$key]['jabatan_dinilai'],
                'strategi_perencanaan' => $nilai_skor_1,
                'strategi_pengawasan' => $nilai_skor_2,
                'strategi_inovasi' => $nilai_skor_3,
                'kepemimpinan' => $nilai_skor_4,
                'membimbing_membangun' => $nilai_skor_5,
                'pengambilan_keputusan' => $nilai_skor_6,
                'kerjasama' => $nilai_skor_7,
                'komunikasi' => $nilai_skor_8,
                'absensi' => $nilai_skor_9,
                'integritas' => $nilai_skor_10,
                'etika' => $nilai_skor_11,
                'goal_kinerja' => $nilai_skor_12,
                'error_kinerja' => $nilai_skor_13,
                'proses_dokumen' => $nilai_skor_14,
                'proses_inisiatif' => $nilai_skor_15,
                'proses_polapikir' => $nilai_skor_16,
                'sum_nilai' => $temp_nilai,
                'relasi' => 'staff',
            ];
            $store = PoolRespon::updateOrCreate($tempData);
            $tempData = [];
        }
        if($store != true)
        {
            // abort(404);
            // exit;
            return response()->json([ 
                'title' => 'error!',
                'html' => 'gagal pool data dari database',
                'icons' => 'danger',
            ]);
        }
        else
        {
            return response()->json([
                'title' => 'success!',
                'html' => 'berhasil pool data dari database',
                'icons' => 'success',
            ]);
        }
    }
    
    public function pool_rekanan(Request $request)
    {   
        $params = $request->boolean('refresh');
        // dd($params);
        if($params == true)
        {
            Cache::forget('skor_jawaban_data');
            Cache::forget('google_form_respon');
            Cache::forget('npp_karyawan');
            Cache::forget('skor_pool_data_rekanan');
            Cache::forget('relasi_karyawan_rekanan');
        }
        // $skor_jawaban_data = Cache::remember('skor_jawaban_data', now()->addMinutes(5), function(){
        //     return Skor::get()->groupBy('aspek_id')->toArray();
        // });

        // $google_form = Cache::remember('google_form_respon', now()->addMinutes(5), function(){
        //     return GResponse::get()->toArray();
        // });

        $skor_jawaban_data = Skor::get()->groupBy('aspek_id')->toArray();
        $google_form = GResponse::get()->toArray();

        // dd($google_form);

        $temp = [];
        $rekanan = [];
        $npp_karyawan = [];
        $slugs_relasi = 'rekanan';
        
        $bool = false;
        foreach($google_form as $key => $value)
        {
            if($google_form[$key]['npp_penilai'] != $google_form[$key]['npp_dinilai'])
            {
                $findrelasi = [];
                $idRelasiKaryawan = [];
                $idRelasiKaryawan = RelasiKaryawan::where('npp_karyawan', $google_form[$key]['npp_penilai'])->first();

                if($idRelasiKaryawan){
                    $idRelasiKaryawan->toArray();
                    // $findrelasi = RelasiSelevel::where('relasi_karyawan_id',$idRelasiKaryawan['id'])->first()->toArray();
                    $findrelasi = $this->find_karyawan_relasi('rekanan', $idRelasiKaryawan['id']);
                    if($findrelasi != ''){
                        $findrelasi->toArray();
                        if($findrelasi['npp_selevel'] != $google_form[$key]['npp_dinilai']){
                            continue;
                        }elseif($findrelasi['npp_selevel'] == $google_form[$key]['npp_dinilai']){
                            $npp_karyawan[] = $idRelasiKaryawan['id'];
                            $temp = $google_form[$key];
                            array_push($rekanan,$temp);
                        }
                    }
                    // dd($findrelasi['npp_selevel']);
                    // dd($findrelasi['npp_selevel'], $google_form[$key]['npp_dinilai']);
                    
                }
                
            // dd($temp);
            }
        }
        // dd($rekanan);
        // Pembagian Segment
        $kepemimpinan = $skor_jawaban_data[1];
        $perilaku = $skor_jawaban_data[2];
        $sasaran = $skor_jawaban_data[3];
        $tempData = [];

        foreach($rekanan as $key => $value)
        {
            $nilai_skor_1 = 0;$nilai_skor_2 = 0;$nilai_skor_3 = 0;$nilai_skor_4 = 0;
            $nilai_skor_5 = 0;$nilai_skor_6 = 0;$nilai_skor_7 = 0;$nilai_skor_8 = 0;
            $nilai_skor_9 = 0;$nilai_skor_10 = 0;$nilai_skor_11 = 0;$nilai_skor_12 = 0;
            $nilai_skor_13 = 0;$nilai_skor_14 = 0;$nilai_skor_15 = 0; $nilai_skor_16 = 0;

            $point_1 = '';$point_2 = '';$point_3 = '';$point_4 = '';$point_5 = '';$point_6 = '';
            $point_7 = '';$point_8 = '';$point_9 = '';$point_10 = '';$point_11 = '';$point_12 = '';
            $point_13 = '';$point_14 = '';$point_15 = '';$point_16 = '';

            foreach($kepemimpinan as $keys => $value)
            {
                  // Kepemimpinan
                $point_1 = str($rekanan[$key]['strategi_perencanaan'])->squish();
                $point_2 = str($rekanan[$key]['strategi_pengawasan'])->squish();
                $point_3 = str($rekanan[$key]['strategi_inovasi'])->squish();
                $point_4 = str($rekanan[$key]['kepemimpinan'])->squish();
                $point_5 = str($rekanan[$key]['membimbing_membangun'])->squish();
                $point_6 = str($rekanan[$key]['pengambilan_keputusan'])->squish();

                if($point_1 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_1 = $kepemimpinan[$keys]['skor'];}
                if($point_2 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_2 = $kepemimpinan[$keys]['skor'];}
                if($point_3 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_3 = $kepemimpinan[$keys]['skor'];}
                if($point_4 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_4 = $kepemimpinan[$keys]['skor'];}
                if($point_5 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_5 = $kepemimpinan[$keys]['skor'];}
                if($point_6 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_6 = $kepemimpinan[$keys]['skor'];}
            }
            
            foreach($sasaran as $keys => $value)
            {
                // Perilaku
                $point_7 = str($rekanan[$key]['kerjasama'])->squish();
                $point_8 = str($rekanan[$key]['komunikasi'])->squish();
                $point_9 = str($rekanan[$key]['absensi'])->squish();
                $point_10 = str($rekanan[$key]['integritas'])->squish();
                $point_11 = str($rekanan[$key]['etika'])->squish();
                if($point_7 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_7 = $perilaku[$keys]['skor'];}
                if($point_8 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_8 = $perilaku[$keys]['skor'];}
                if($point_9 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_9 = $perilaku[$keys]['skor'];}
                if($point_10 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_10 = $perilaku[$keys]['skor'];}
                if($point_11 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_11 = $perilaku[$keys]['skor'];}
            }
            
            foreach($perilaku as $keys => $value)
            {
                // Sasaran
                $point_12 = str($rekanan[$key]['goal_kinerja'])->squish();
                $point_13 = str($rekanan[$key]['error_kinerja'])->squish();
                $point_14 = str($rekanan[$key]['proses_dokumen'])->squish();
                $point_15 = str($rekanan[$key]['proses_inisiatif'])->squish();
                $point_16 = str($rekanan[$key]['proses_polapikir'])->squish();
                if($point_12 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_12 = $sasaran[$keys]['skor'];}
                if($point_13 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_13 = $sasaran[$keys]['skor'];}
                if($point_14 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_14 = $sasaran[$keys]['skor'];}
                if($point_15 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_15 = $sasaran[$keys]['skor'];}
                if($point_16 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_16 = $sasaran[$keys]['skor'];}
            }
            $temp_nilai = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
            // dd($npp_karyawan);
            $tempData = [
                'npp_penilai' => $npp_karyawan[$key],
                'npp_dinilai' => $rekanan[$key]['npp_dinilai'],
                'jabatan_dinilai' => $rekanan[$key]['jabatan_dinilai'],
                'strategi_perencanaan' => $nilai_skor_1,
                'strategi_pengawasan' => $nilai_skor_2,
                'strategi_inovasi' => $nilai_skor_3,
                'kepemimpinan' => $nilai_skor_4,
                'membimbing_membangun' => $nilai_skor_5,
                'pengambilan_keputusan' => $nilai_skor_6,
                'kerjasama' => $nilai_skor_7,
                'komunikasi' => $nilai_skor_8,
                'absensi' => $nilai_skor_9,
                'integritas' => $nilai_skor_10,
                'etika' => $nilai_skor_11,
                'goal_kinerja' => $nilai_skor_12,
                'error_kinerja' => $nilai_skor_13,
                'proses_dokumen' => $nilai_skor_14,
                'proses_inisiatif' => $nilai_skor_15,
                'proses_polapikir' => $nilai_skor_16,
                'sum_nilai' => $temp_nilai,
                'relasi' => $slugs_relasi,
            ];
            // dd($tempData);
            $store = PoolRespon::updateOrCreate($tempData);
            $tempData = [];
            
        }
        // dd($tempData);
        if($store != true)
        {
            // abort(404);
            // exit;
            return response()->json([ 
                'title' => 'error!',
                'html' => 'gagal pool data dari database',
                'icons' => 'danger',
            ]);
        }
        else
        {
            return response()->json([
                'title' => 'success!',
                'html' => 'berhasil pool data dari database',
                'icons' => 'success',
            ]);
        }
    }

    // Harusnya menjadi relasi Atasan , karena atasan menilai bawahan
    // public function pool_staff(Request $request)
    public function pool_atasan(Request $request)
    {   
        $params = $request->boolean('refresh');
        if($params == true)
        {
            Cache::forget('skor_jawaban_data');
            Cache::forget('google_form_respon');
            Cache::forget('npp_karyawan');
            Cache::forget('skor_pool_data_staff');
            Cache::forget('relasi_karyawan_staff');
        }
        // $skor_jawaban_data = Cache::remember('skor_jawaban_data', now()->addMinutes(5), function(){
        //     return Skor::get()->groupBy('aspek_id')->toArray();
        // });

        // $google_form = Cache::remember('google_form_respon', now()->addMinutes(5), function(){
        //     return GResponse::get()->toArray();
        // });

        $skor_jawaban_data = Skor::get()->groupBy('aspek_id')->toArray();
        $google_form = GResponse::get()->toArray();

        $temp = [];
        $staff = [];
        $npp_karyawan = [];
        $slugs_relasi = 'staff';
        // dd($google_form);
        
            foreach($google_form as $key => $value)
            {
                // dd($google_form);
                if($google_form[$key]['npp_penilai'] != $google_form[$key]['npp_dinilai'])
                {
                    $findrelasi = [];
                    $idRelasiKaryawan = [];
                    $idRelasiKaryawan = RelasiKaryawan::where('npp_karyawan', $google_form[$key]['npp_penilai'])->first();
                    if ($idRelasiKaryawan) {
                        $idRelasiKaryawan = $idRelasiKaryawan->toArray();
                        $findrelasi = RelasiStaff::where('relasi_karyawan_id',$idRelasiKaryawan['id'])
                        ->where('npp_staff',$google_form[$key]['npp_dinilai'])
                        ->first() ?? '';
                        if(!empty($findrelasi)){
                            $findrelasi->toArray();
                            // dd($findrelasi);
                            if($findrelasi['npp_staff'] != $google_form[$key]['npp_dinilai']){
                                continue;
                            }elseif($findrelasi['npp_staff'] == $google_form[$key]['npp_dinilai']){
                                $npp_karyawan[] = $idRelasiKaryawan['id'];
                                $temp = $google_form[$key];
                                array_push($staff,$temp);
                            }
                        }
                    }
                    
                    // $findrelasi = $this->find_karyawan_relasi('staff', $idRelasiKaryawan['id'])->toArray();
                    // dd($findrelasi['npp_staff'],$google_form[$key]['npp_dinilai']);
                }
            }
            // dd($npp_karyawan);
        
        // Pembagian Segment
        $kepemimpinan = $skor_jawaban_data[1];
        $perilaku = $skor_jawaban_data[2];
        $sasaran = $skor_jawaban_data[3];
        $tempData = [];

        foreach($staff as $key => $value)
        {
            $nilai_skor_1 = 0;$nilai_skor_2 = 0;$nilai_skor_3 = 0;$nilai_skor_4 = 0;
            $nilai_skor_5 = 0;$nilai_skor_6 = 0;$nilai_skor_7 = 0;$nilai_skor_8 = 0;
            $nilai_skor_9 = 0;$nilai_skor_10 = 0;$nilai_skor_11 = 0;$nilai_skor_12 = 0;
            $nilai_skor_13 = 0;$nilai_skor_14 = 0;$nilai_skor_15 = 0; $nilai_skor_16 = 0;

            $point_1 = '';$point_2 = '';$point_3 = '';$point_4 = '';$point_5 = '';$point_6 = '';
            $point_7 = '';$point_8 = '';$point_9 = '';$point_10 = '';$point_11 = '';$point_12 = '';
            $point_13 = '';$point_14 = '';$point_15 = '';$point_16 = '';

            foreach($kepemimpinan as $keys => $value)
            {
                  // Kepemimpinan
                $point_1 = str($staff[$key]['strategi_perencanaan'])->squish();
                $point_2 = str($staff[$key]['strategi_pengawasan'])->squish();
                $point_3 = str($staff[$key]['strategi_inovasi'])->squish();
                $point_4 = str($staff[$key]['kepemimpinan'])->squish();
                $point_5 = str($staff[$key]['membimbing_membangun'])->squish();
                $point_6 = str($staff[$key]['pengambilan_keputusan'])->squish();

                if($point_1 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_1 = $kepemimpinan[$keys]['skor'];}
                if($point_2 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_2 = $kepemimpinan[$keys]['skor'];}
                if($point_3 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_3 = $kepemimpinan[$keys]['skor'];}
                if($point_4 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_4 = $kepemimpinan[$keys]['skor'];}
                if($point_5 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_5 = $kepemimpinan[$keys]['skor'];}
                if($point_6 == str($kepemimpinan[$keys]['jawaban'])->squish()){$nilai_skor_6 = $kepemimpinan[$keys]['skor'];}
            }
            
            foreach($sasaran as $keys => $value)
            {
                // Perilaku
                $point_7 = str($staff[$key]['kerjasama'])->squish();
                $point_8 = str($staff[$key]['komunikasi'])->squish();
                $point_9 = str($staff[$key]['absensi'])->squish();
                $point_10 = str($staff[$key]['integritas'])->squish();
                $point_11 = str($staff[$key]['etika'])->squish();
                if($point_7 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_7 = $perilaku[$keys]['skor'];}
                if($point_8 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_8 = $perilaku[$keys]['skor'];}
                if($point_9 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_9 = $perilaku[$keys]['skor'];}
                if($point_10 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_10 = $perilaku[$keys]['skor'];}
                if($point_11 == str($perilaku[$keys]['jawaban'])->squish()){$nilai_skor_11 = $perilaku[$keys]['skor'];}
            }
            
            foreach($perilaku as $keys => $value)
            {
                // Sasaran
                $point_12 = str($staff[$key]['goal_kinerja'])->squish();
                $point_13 = str($staff[$key]['error_kinerja'])->squish();
                $point_14 = str($staff[$key]['proses_dokumen'])->squish();
                $point_15 = str($staff[$key]['proses_inisiatif'])->squish();
                $point_16 = str($staff[$key]['proses_polapikir'])->squish();
                if($point_12 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_12 = $sasaran[$keys]['skor'];}
                if($point_13 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_13 = $sasaran[$keys]['skor'];}
                if($point_14 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_14 = $sasaran[$keys]['skor'];}
                if($point_15 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_15 = $sasaran[$keys]['skor'];}
                if($point_16 == str($sasaran[$keys]['jawaban'])->squish()){$nilai_skor_16 = $sasaran[$keys]['skor'];}
            }
            $temp_nilai = $nilai_skor_1 + $nilai_skor_2 + $nilai_skor_3 + $nilai_skor_4 + $nilai_skor_5 + $nilai_skor_6 + $nilai_skor_7 + $nilai_skor_8 + $nilai_skor_9 + $nilai_skor_10 + $nilai_skor_11 + $nilai_skor_12 + $nilai_skor_13 + $nilai_skor_14 + $nilai_skor_15 + $nilai_skor_16;
            // dd($npp_karyawan);
            // dd($npp_karyawan[$key]);
            $tempData = [
                'npp_penilai' => $npp_karyawan[$key],
                'npp_dinilai' => $staff[$key]['npp_dinilai'],
                'jabatan_dinilai' => $staff[$key]['jabatan_dinilai'],
                'strategi_perencanaan' => $nilai_skor_1,
                'strategi_pengawasan' => $nilai_skor_2,
                'strategi_inovasi' => $nilai_skor_3,
                'kepemimpinan' => $nilai_skor_4,
                'membimbing_membangun' => $nilai_skor_5,
                'pengambilan_keputusan' => $nilai_skor_6,
                'kerjasama' => $nilai_skor_7,
                'komunikasi' => $nilai_skor_8,
                'absensi' => $nilai_skor_9,
                'integritas' => $nilai_skor_10,
                'etika' => $nilai_skor_11,
                'goal_kinerja' => $nilai_skor_12,
                'error_kinerja' => $nilai_skor_13,
                'proses_dokumen' => $nilai_skor_14,
                'proses_inisiatif' => $nilai_skor_15,
                'proses_polapikir' => $nilai_skor_16,
                'sum_nilai' => $temp_nilai,
                'relasi' => 'atasan',
            ];
            $store = PoolRespon::updateOrCreate($tempData);
            $tempData = [];
            
        }
        if($store)
        {
            return response()->json([ 
                'title' => 'error!',
                'html' => 'gagal pool data dari database',
                'icons' => 'danger',
            ]);
        }
        else
        {
            return response()->json([
                'title' => 'success!',
                'html' => 'berhasil pool data dari database',
                'icons' => 'success',
            ]);
        }
    }
}
