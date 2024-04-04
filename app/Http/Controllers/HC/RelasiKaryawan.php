<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Models\RelasiKaryawan as RK;
use App\Models\RelasiStaff as RS;
use App\Models\RelasiSelevel as RL;
use App\Models\RelasiAtasan as RA;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RelasiKaryawan extends Controller
{

    public function index()
    {
        // $rk_cache = Cache::remember('rk_data',now()->addMinutes(5), function () {
            // return RK::select('id','npp_karyawan','level_jabatan','unit_jabatan','nama_karyawan')->with([
            $rk_cache = RK::select('id','npp_karyawan','level_jabatan','unit_jabatan','nama_karyawan')->with([
                'karyawan_atasan:id,relasi_karyawan_id,npp_atasan',
                'karyawan_selevel:id,relasi_karyawan_id,npp_selevel',
                'karyawan_staff:id,relasi_karyawan_id,npp_staff'
                ])->get();
        // });
        return view('hc.gform.relasi.index')->with([
            'karyawan_data' => $rk_cache,
        ]);
    }

    public function resetPasswordUser(Request $request)
    {
        $password = Str::random(10);
        // $password = 123456;
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $users = $user->toArray();
            $user->update(['password' => Hash::make($password)]);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $users['no_hp'],
                    'message' => "Password baru : $password

                    https://assessment.pindadmedika.com/2024",
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: '.env('FONNTE_TOKEN', '') //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            return redirect()->route('relasi-user')->withSuccess('password berhasil di reset!');
        }else{
            return redirect()->route('relasi-user')->withErrors('terjadi kesalahan!');
        }
    }

    public function resetPasswordUserCustom(Request $request)
    {
        $tempData = [];
        // $password = Str::random(10);
        $password = $request->password;
        // dd($password);
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $users = $user->toArray();
            $user->update(['password' => Hash::make($password)]);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $users['no_hp'],
                    'message' => "Password anda telah diubah oleh SDM, Password baru : $password

                    https://assessment.pindadmedika.com/2024",
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: '.env('FONNTE_TOKEN', '') //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;

            $tempData['data'] = [
                'title' => "success",
                'html' => "berhasil reset password <b></b>",
                'icon' => "success",
            ];
        }else{
            $tempData['data'] = [
                'title' => "gagal",
                'html' => "gagal edit data <b></b>",
                'icon' => "error",
            ];
        }
        return response()->json($tempData);
    }

    public function index_user()
    {
        $karyawan = User::get();

        return view('hc.gform.relasi.index-user')->with([
            'user_data' => $karyawan
        ]);
    }

    public function updateUser(Request $request, User $user, $id)
    {
        try {
            $validated = $request->validate([
                'npp' => 'required',
                'nama' => 'required',
                'email' => 'required',
                'no_hp' => 'required',
            ]);

            if($validated){
                $data = [
                    'npp' => $request->npp,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp
                ];
                // dd($data);
                $store = User::find($id)->update($data);
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
            $tempData['data'] = [
                'title' => "gagal",
                'html' => $exception->getMessage()." <b></b>",
                'icon' => "error",
            ];
            return response()->json($tempData);
        }
    }

    public function pull()
    {
        // $values = Sheets::spreadsheet('1CX4q_BqkCgHr1TEe0_tlRHO9ZcSXqKv46Q-v7H1OykM')->sheet('DP3 2023')->range('F$5:I')->all();
        $sheetId = env('GOOGLE_SHEET_DP_2023_ID', '');
        $sheetName = env('GOOGLE_SHEET_DP_2023_NAME', '');
        $values = Sheets::spreadsheet($sheetId)->sheet($sheetName)->range('F$5:I')->all();
        // unset($values[0]);
        // dd($values);
        $message = [];
        try {
            $lastNppKaryawan = '';
            $rkid = '';
            $findIdRk = '';
            foreach($values as $key => $val){
                if($val[0] != '' && $val[0] != '-')
                {
                    // $val[0] = $lastNppKaryawan;
                    $checkTable = RK::where('npp_karyawan',$val[0])->first() ?? '';
                    if($checkTable == ''){
                        $storeRk = RK::updateOrCreate(
                            [
                            'npp_karyawan' => $val[0],
                            ]
                        ); // Insert
                        $rkid = $storeRk->id;
                    }else{
                        $findIdRk = RK::where('npp_karyawan', $val[0])->first(); // dapatkan id rk
                        $rkid = $findIdRk->id;
                        // Dapatkan Id
                    }
                    $lastNppKaryawan = $val[0];
                }
                else
                {
                    $val[0] = $lastNppKaryawan;
                    $checkTable = RK::where('npp_karyawan',$val[0])->first() ?? '';
                    if($checkTable == ''){
                        $storeRk = RK::create(
                            [
                            'npp_karyawan' => $val[0],
                            ]
                        ); // Insert
                        $rkid = $storeRk->id;
                    }else{
                        $findIdRk = RK::where('npp_karyawan', $val[0])->first(); // dapatkan id rk
                        $rkid = $findIdRk->id;
                        // Dapatkan Id
                    }
                }
                // Dapatkan Id
                // Insert ke tabel relasi staff
                if(!empty($val[3])){
                    $staff = preg_replace("/[^a-zA-Z 0-9]+/", "", $val[3]);
                    if($staff != ''){
                        RS::updateOrCreate([
                            'relasi_karyawan_id' => $rkid,
                            'npp_staff' => $staff,
                            ]
                        );
                    }
                }
                // Insert ke tabel relasi selevel
                if(!empty($val[2])){
                    if($val[2] != ''){
                        RL::updateOrCreate([
                            'relasi_karyawan_id' => $rkid,
                            'npp_selevel' => $val[2],
                            ]
                        );
                    }
                }
                // Insert ke tabel atasan
                if(!empty($val[1])){
                    if($val[3] != ''){
                        RA::updateOrCreate([
                            'relasi_karyawan_id' => $rkid,
                            'npp_atasan' => $val[1],
                            ]
                        );
                    }
                }
            }
            unset($values);
            return response()->json(['message' => 'Poll inserted']);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage(),
                ]
            );
        }
    }

    public function pull_level()
    {
        // $values = Sheets::spreadsheet('1CX4q_BqkCgHr1TEe0_tlRHO9ZcSXqKv46Q-v7H1OykM')->sheet('DP3 2023')->range('C$5:I')->all();
        // $rows = Sheets::spreadsheet('1ukxirWfh5iWXmXi5Lg2tJt6IeUja-F_Ld93i_i0LbZk')->sheet('DP3 2022')->range('A$2:G')->get();
        // $rows = Sheets::spreadsheet('1ukxirWfh5iWXmXi5Lg2tJt6IeUja-F_Ld93i_i0LbZk')->sheet('DP3 2023')->range('C$5:I')->get();

        try {
            $sheetId = env('GOOGLE_SHEET_DP_2023_ID', '');
            $sheetName = env('GOOGLE_SHEET_DP_2023_NAME', '');
            $rows = Sheets::spreadsheet($sheetId)->sheet($sheetName)->range('C$3:I')->get();
            // $rows = Sheets::spreadsheet('1ukxirWfh5iWXmXi5Lg2tJt6IeUja-F_Ld93i_i0LbZk')->sheet('DP3 2023')->range('C$5:I')->get();
            $values = $rows->filter();

            // dd($values);

            $lastNppKaryawan = '';
            $rkid = '';
            $findIdRk = '';
            foreach($values as $key => $val){
                if($val[3] != '' && $val[3] != '-')
                {
                    $checkTable = RK::where('npp_karyawan',$val[3])->first() ?? '';
                    if($checkTable == ''){
                        $storeRk = RK::updateOrCreate(
                            [
                                'npp_karyawan' => $val[3],
                            ],
                            [
                                'level_jabatan' => $val[1],
                                'unit_jabatan' => $val[2],
                                'nama_karyawan' => $val[0],
                            ]
                        ); 
                        // Insert
                        $rkid = $storeRk->id;
                    }else{
                        $findIdRk = RK::where('npp_karyawan', $val[3])->first(); // dapatkan id rk
                        $rkid = $findIdRk->id;
                        // Dapatkan Id
                    }
                    $lastNppKaryawan = $val[3];
                }
                else
                {
                    $val[3] = $lastNppKaryawan;
                    $checkTable = RK::where('npp_karyawan',$val[3])->first() ?? '';
                    if($checkTable == ''){
                        $storeRk = RK::create(
                            [
                                'npp_karyawan' => $val[3],
                                'level_jabatan' => $val[1],
                                'unit_jabatan' => $val[2],
                                'nama_karyawan' => $val[0],
                            ]
                        ); // Insert
                        $rkid = $storeRk->id;
                    }else{
                        $findIdRk = RK::where('npp_karyawan', $val[3])->first(); // dapatkan id rk
                        $rkid = $findIdRk->id;
                        // Dapatkan Id
                    }
                }
                // Dapatkan Id
                // Insert ke tabel relasi staff
                if(!empty($val[6]))
                {
                    $staff = preg_replace("/[^a-zA-Z 0-9]+/", "", $val[6]);
                    if($staff != ''){
                        RS::updateOrCreate(
                            [
                                'relasi_karyawan_id' => $rkid,
                                'npp_staff' => $staff,
                            ]
                        );
                    }
                }
                // Insert ke tabel relasi selevel
                if(!empty($val[5]))
                {
                    if($val[5] != ''){
                        RL::updateOrCreate(
                            [
                                'relasi_karyawan_id' => $rkid,
                            ],
                            [
                                'npp_selevel' => $val[5],
                            ]
                        );
                    }
                }
                // Insert ke tabel atasan
                if(!empty($val[4]))
                {
                    if($val[4] != ''){
                        RA::updateOrCreate(
                            [
                                'relasi_karyawan_id' => $rkid,
                            ],
                            [
                                'npp_atasan' => $val[4],
                            ]
                        );
                    }
                }
            }
            unset($values);
            return response()->json([
                'status' => true,
                'title' => 'berhasil',
                'text' => 'data karyawan telah di simpan'
            ],200);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json([
                'status' => false,
                'title' => 'gagal',
                'text' => $exception->getMessage()
            ],501);
        }
    }
}
