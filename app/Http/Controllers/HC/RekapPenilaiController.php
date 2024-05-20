<?php

namespace App\Http\Controllers\HC;

use App\Exports\RekapPenilaiExport;
use App\Exports\RekapPenilaiPersonalCompleteExport;
use App\Exports\RekapPenilaiPersonalExport;
use App\Exports\RekapPenilaiPersonalRawExport;
use App\Exports\RekapPenilaiRawExport;
use App\Http\Controllers\Controller;
use App\Models\FinalDp3;
use App\Models\PoolRespon;
use App\Models\RekapPenilai;
use App\Models\RelasiKaryawan;
use App\Models\RelasiSelevel;
use App\Models\RelasiStaff;
use App\Models\User;
use App\Models\AturJadwal;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExt;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Support\Collection;

class RekapPenilaiController extends Controller
{
    public function index()
    {
        $dinilai = RekapPenilai::with([
            'identitas_dinilai',
        ])
            ->select()
            ->selectRaw('AVG(sum_nilai_k_bobot_aspek) as sum_k1')
            ->selectRaw('AVG(sum_nilai_s_bobot_aspek) as sum_k2')
            ->selectRaw('AVG(sum_nilai_p_bobot_aspek) as sum_k3')
            ->groupBy('npp_dinilai')
            ->get();
        return view('hc.rekap.penilai.index')->with([
            'data_dinilai' => $dinilai,
        ]);
    }

    public function checkStatus(Request $request)
    {
        // dd($request->npp_dinilai);
        $dinilai = $request->npp_dinilai;
        $penilai = Auth::user()->npp;
        $sheet_id = env('GOOGLE_SHEET_RESPONSE_ID', '');

        $sheet_data = Sheets::spreadsheet($sheet_id)->sheet('Form Responses 1')->range('B:D')->get() ?? [];
        $header = $sheet_data->pull(0);
        $values = Sheets::collection(header: $header, rows: $sheet_data);
        $arr = $values->toArray();
        $sheet_filter = array_filter($arr, function ($var) use ($penilai, $dinilai) {
            if ($var['NPP Penilai'] == $penilai && $var['NPP yang dinilai'] == $dinilai) {
                return ($var['NPP yang dinilai']);
            } else {
                unset($arr);
            }
        });
        return response()->json([
            'status' => count($sheet_filter)
        ]);
    }

    private function sendWhatsapp($npp_dinilai, $npp_penilai, $phone)
    {
        $nama_penilai = $npp_penilai['nama_karyawan'];
        $nama_dinilai = $npp_dinilai['nama_karyawan'];

        // dd($phone);
        $pesan =
            "Yth $nama_penilai
        mohon untuk melakukan penilaian sdr
        $nama_dinilai
        Terimakasih";

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
                'target' => $phone,  // No telepon penilai
                'message' => $pesan,
                'countryCode' => '62',  // optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . env('FONNTE_TOKEN', '')  // change TOKEN to your actual token
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

    public function exportPersonalRawXlsx()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiPersonalRawExport, 'FinalSkorDp3Raw-' . $nows, ExcelExt::XLSX);
    }

    public function exportPersonalRawCsv()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiPersonalRawExport, 'FinalSkorDp3Raw-' . $nows, ExcelExt::CSV);
    }

    public function exportPersonalXlsx()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiPersonalExport, 'FinalSkorDp3-' . $nows, ExcelExt::XLSX);
    }

    public function exportPersonalCsv()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiPersonalExport, 'FinalSkorDp3-' . $nows, ExcelExt::CSV);
    }

    public function exportRawXlsx()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiRawExport, 'Dp3Raw-' . $nows, ExcelExt::XLSX);
    }

    public function exportRawCsv()
    {
        $nows = Carbon::now()->toDateTimeString() . '.csv';
        return Excel::download(new RekapPenilaiRawExport, 'Dp3Raw-' . $nows, ExcelExt::CSV);
    }

    public function exportXlsx()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiExport, 'Dp3Group' . $nows, ExcelExt::XLSX);
    }

    public function exportCsv()
    {
        $nows = Carbon::now()->toDateTimeString() . '.csv';
        return Excel::download(new RekapPenilaiExport, 'Dp3Group' . $nows, ExcelExt::CSV);
    }

    public function index_self()
    {
        $penilai = RekapPenilai::where('relasi', 'self')->get();
        return view('hc.rekap.penilai.index-self')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_atasan()
    {
        $penilai = RekapPenilai::where('relasi', 'atasan')->get();
        return view('hc.rekap.penilai.index-atasan')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_rekanan()
    {
        $penilai = RekapPenilai::where('relasi', 'rekanan')->get();
        return view('hc.rekap.penilai.index-rekanan')->with([
            'data_penilai' => $penilai,
        ]);
    }

    public function index_staff()
    {
        $penilai = RekapPenilai::where('relasi', 'staff')->get();
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
            'identitas_dinilai',
        ])
            ->where('npp_dinilai', $request->dinilai)
            ->where('relasi', $request->relasi)
            ->first();

        // dd($penilai->toArray());
        if ($penilai) {
            return view('hc.rekap.penilai.index-detail')->with([
                'data_penilai' => $penilai
            ]);
        } else {
            $phone = '';
            // return abort(404);
            $penilai = $request->penilai;
            $dinilai = $request->dinilai;
            $karyawan_penilai = RelasiKaryawan::where('id', $penilai)->first();
            $karyawan_dinilai = RelasiKaryawan::where('npp_karyawan', $dinilai)->first();
            if ($karyawan_penilai) {
                $kp = $karyawan_penilai->toArray();
                $users = User::where('npp', $kp['npp_karyawan'])->first();
                if ($users) {
                    $user = $users->toArray();
                    $phone = $user['no_hp'];
                }
            }
            if ($karyawan_dinilai) {
                $kd = $karyawan_dinilai->toArray();
            }

            if ($karyawan_dinilai && $karyawan_penilai) {
                $this->sendWhatsapp($kd, $kp, $phone);
                return redirect()->back()->withInfo($request->relasi . ' belum melakukan penilaian, follow up dilakukan');
            } else {
                return redirect()->back()->withInfo($penilai . ' belum mendaftar, follow up tidak dilakukan');
            }
            // dd($kd['nama_karyawan']);
        }
    }

    public function showStaff(Request $request)
    {
        $karyawanDinilai = RelasiKaryawan::where('npp_karyawan', $request->dinilai)->first();
        $data = [];
        try {
            if ($karyawanDinilai) {
                $staff = RelasiStaff::with(['parent_staff', 'identitas_staff'])
                    ->where('relasi_karyawan_id', $karyawanDinilai->id)
                    ->get();
                if ($staff) {
                    $data = [
                        'data' => $staff
                    ];
                }
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function showStaffDetailPenilai(Request $request)
    {
        try {
            $penilais = collect([]);
            $penilai = RekapPenilai::with([
                'relasi_karyawan',
                'relasi_respon'
            ])
                ->where('npp_penilai', $request->penilai)
                ->where('npp_dinilai', $request->dinilai)
                ->where('relasi', 'staff')
                ->first();

            $raw_penilai = RekapPenilai::with([
                'relasi_karyawan',
                'relasi_respon',
            ])
                ->where('npp_dinilai', $request->dinilai)
                ->where('relasi', 'staff')
                ->get();
            $avg = $raw_penilai->groupBy('relasi');
            $avg->values()->all();

            $jabatan = $avg['staff']->unique('jabatan_dinilai')->pluck('jabatan_dinilai')->toArray()[0];
            $penilais['jabatan_dinilai'] = $jabatan;
            $penilais['strategi_perencanaan_bobot_aspek'] = $avg['staff']->avg('strategi_perencanaan_bobot_aspek');
            $penilais['strategi_pengawasan_bobot_aspek'] = $avg['staff']->avg('strategi_pengawasan_bobot_aspek');
            $penilais['strategi_inovasi_bobot_aspek'] = $avg['staff']->avg('strategi_inovasi_bobot_aspek');
            $penilais['kepemimpinan_bobot_aspek'] = $avg['staff']->avg('kepemimpinan_bobot_aspek');
            $penilais['membimbing_membangun_bobot_aspek'] = $avg['staff']->avg('membimbing_membangun_bobot_aspek');
            $penilais['kerjasama_bobot_aspek'] = $avg['staff']->avg('kerjasama_bobot_aspek');
            $penilais['komunikasi_bobot_aspek'] = $avg['staff']->avg('komunikasi_bobot_aspek');
            $penilais['absensi_bobot_aspek'] = $avg['staff']->avg('absensi_bobot_aspek');
            $penilais['integritas_bobot_aspek'] = $avg['staff']->avg('integritas_bobot_aspek');
            $penilais['etika_bobot_aspek'] = $avg['staff']->avg('etika_bobot_aspek');
            $penilais['goal_kinerja_bobot_aspek'] = $avg['staff']->avg('goal_kinerja_bobot_aspek');
            $penilais['error_kinerja_bobot_aspek'] = $avg['staff']->avg('error_kinerja_bobot_aspek');
            $penilais['proses_dokumen_bobot_aspek'] = $avg['staff']->avg('proses_dokumen_bobot_aspek');
            $penilais['proses_inisiatif_bobot_aspek'] = $avg['staff']->avg('proses_inisiatif_bobot_aspek');
            $penilais['proses_polapikir_bobot_aspek'] = $avg['staff']->avg('proses_polapikir_bobot_aspek');
            $penilais['sum_nilai_k_bobot_aspek'] = $avg['staff']->avg('sum_nilai_k_bobot_aspek');
            $penilais['sum_nilai_s_bobot_aspek'] = $avg['staff']->avg('sum_nilai_s_bobot_aspek');
            $penilais['sum_nilai_p_bobot_aspek'] = $avg['staff']->avg('sum_nilai_p_bobot_aspek');
            $penilais['sum_nilai_dp3'] = $avg['staff']->avg('sum_nilai_dp3');
            $penilais['relasi'] = 'staff';

            if ($penilai) {
                return view('hc.rekap.penilai.index-detail')->with([
                    'data_penilai' => $penilai,
                    'avg_penilai' => $penilais
                ]);
            } else {
                // return abort(404);
                // echo 'null';
                $phone = '';
                $penilai = $request->penilai;
                $dinilai = $request->dinilai;
                $karyawan_penilai = RelasiKaryawan::where('id', $penilai)->first();
                $karyawan_dinilai = RelasiKaryawan::where('npp_karyawan', $dinilai)->first();
                if ($karyawan_penilai) {
                    $kp = $karyawan_penilai->toArray();
                    $users = User::where('npp', $kp['npp_karyawan'])->first();
                    if ($users) {
                        $user = $users->toArray();
                        $phone = $user['no_hp'];
                    }
                }
                if ($karyawan_dinilai) {
                    $kd = $karyawan_dinilai->toArray();
                }

                if ($karyawan_dinilai && $karyawan_penilai) {
                    $this->sendWhatsapp($kd, $kp, $phone);
                    return redirect()->back()->withInfo($request->relasi . ' belum melakukan penilaian, follow up dilakukan');
                } else {
                    return redirect()->back()->withInfo($penilai . ' belum mendaftar, follow up tidak dilakukan');
                }
            }
        } catch (\Throwable $th) {
            return abort(404);
            // return $th->getMessage();
        }
    }

    public function showRekanan(Request $request)
    {
        $karyawanDinilai = RelasiKaryawan::where('npp_karyawan', $request->dinilai)->first();
        $data = [];
        try {
            if ($karyawanDinilai) {
                $rekanan = RelasiSelevel::with(['parent_selevel', 'identitas_selevel'])
                    ->where('npp_selevel', $karyawanDinilai->npp_karyawan)
                    ->get();
                if ($rekanan) {
                    $data = [
                        'data' => $rekanan
                    ];
                }
            }
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function showRekananDetailPenilai(Request $request)
    {
        // dd($request->penilai);
        try {
            $penilais = collect([]);
            $penilai = RekapPenilai::with([
                'relasi_karyawan',
                'relasi_respon'
            ])
                ->where('npp_penilai', $request->penilai)
                ->where('npp_dinilai', $request->dinilai)
                ->where('relasi', 'rekanan')
                ->first();

            $raw_penilai = RekapPenilai::with([
                'relasi_karyawan',
                'relasi_respon',
            ])
                ->where('npp_dinilai', $request->dinilai)
                ->where('relasi', 'rekanan')
                ->get();
            $avg = $raw_penilai->groupBy('relasi');
            $avg->values()->all();

            $jabatan = $avg['rekanan']->unique('jabatan_dinilai')->pluck('jabatan_dinilai')->toArray()[0];
            $penilais['jabatan_dinilai'] = $jabatan;
            $penilais['strategi_perencanaan_bobot_aspek'] = $avg['rekanan']->avg('strategi_perencanaan_bobot_aspek');
            $penilais['strategi_pengawasan_bobot_aspek'] = $avg['rekanan']->avg('strategi_pengawasan_bobot_aspek');
            $penilais['strategi_inovasi_bobot_aspek'] = $avg['rekanan']->avg('strategi_inovasi_bobot_aspek');
            $penilais['kepemimpinan_bobot_aspek'] = $avg['rekanan']->avg('kepemimpinan_bobot_aspek');
            $penilais['membimbing_membangun_bobot_aspek'] = $avg['rekanan']->avg('membimbing_membangun_bobot_aspek');
            $penilais['kerjasama_bobot_aspek'] = $avg['rekanan']->avg('kerjasama_bobot_aspek');
            $penilais['komunikasi_bobot_aspek'] = $avg['rekanan']->avg('komunikasi_bobot_aspek');
            $penilais['absensi_bobot_aspek'] = $avg['rekanan']->avg('absensi_bobot_aspek');
            $penilais['integritas_bobot_aspek'] = $avg['rekanan']->avg('integritas_bobot_aspek');
            $penilais['etika_bobot_aspek'] = $avg['rekanan']->avg('etika_bobot_aspek');
            $penilais['goal_kinerja_bobot_aspek'] = $avg['rekanan']->avg('goal_kinerja_bobot_aspek');
            $penilais['error_kinerja_bobot_aspek'] = $avg['rekanan']->avg('error_kinerja_bobot_aspek');
            $penilais['proses_dokumen_bobot_aspek'] = $avg['rekanan']->avg('proses_dokumen_bobot_aspek');
            $penilais['proses_inisiatif_bobot_aspek'] = $avg['rekanan']->avg('proses_inisiatif_bobot_aspek');
            $penilais['proses_polapikir_bobot_aspek'] = $avg['rekanan']->avg('proses_polapikir_bobot_aspek');
            $penilais['sum_nilai_k_bobot_aspek'] = $avg['rekanan']->avg('sum_nilai_k_bobot_aspek');
            $penilais['sum_nilai_s_bobot_aspek'] = $avg['rekanan']->avg('sum_nilai_s_bobot_aspek');
            $penilais['sum_nilai_p_bobot_aspek'] = $avg['rekanan']->avg('sum_nilai_p_bobot_aspek');
            $penilais['sum_nilai_dp3'] = $avg['rekanan']->avg('sum_nilai_dp3');
            $penilais['relasi'] = 'rekanan';

            if ($penilai) {
                return view('hc.rekap.penilai.index-detail')->with([
                    'data_penilai' => $penilai,
                    'avg_penilai' => $penilais
                ]);
            } else {
                // return abort(404);
                // echo 'null';
                $phone = '';
                $penilai = $request->penilai;
                $dinilai = $request->dinilai;
                $karyawan_penilai = RelasiKaryawan::where('id', $penilai)->first();
                $karyawan_dinilai = RelasiKaryawan::where('npp_karyawan', $dinilai)->first();
                if ($karyawan_penilai) {
                    $kp = $karyawan_penilai->toArray();
                    $users = User::where('npp', $kp['npp_karyawan'])->first();
                    if ($users) {
                        $user = $users->toArray();
                        $phone = $user['no_hp'];
                    }
                }
                if ($karyawan_dinilai) {
                    $kd = $karyawan_dinilai->toArray();
                }

                if ($karyawan_dinilai && $karyawan_penilai) {
                    $this->sendWhatsapp($kd, $kp, $phone);
                    return redirect()->back()->withInfo($request->relasi . ' belum melakukan penilaian, follow up dilakukan');
                } else {
                    return redirect()->back()->withInfo($penilai . ' belum mendaftar, follow up tidak dilakukan');
                }
            }
        } catch (\Throwable $th) {
            return abort(404);
            // return $th->getMessage();
        }
    }

    public function index_personal()
    {
        // New
        $check = FinalDp3::get();
        // dd($check);
        if(count($check) < 1){
            return view('hc.rekap.penilai.index-personal')->with([
                'personal' => $check,
            ]);
        }
        $karyawans = RelasiKaryawan::select('id','npp_karyawan')->get();
        $finalData = collect([]);
        $npp = '';
        $nama = '';
        $level = '';
        $totalMentah = '';
        foreach ($karyawans as $keyKaryawans => $row) {
            // dd($value->npp_karyawan);
            $personal = RekapPenilai::select(
                'npp_penilai',
                'strategi_perencanaan_bobot_aspek',
                'strategi_pengawasan_bobot_aspek',
                'strategi_inovasi_bobot_aspek',
                'kepemimpinan_bobot_aspek',
                'membimbing_membangun_bobot_aspek',
                'pengambilan_keputusan_bobot_aspek',
                'kerjasama_bobot_aspek',
                'komunikasi_bobot_aspek',
                'absensi_bobot_aspek',
                'integritas_bobot_aspek',
                'etika_bobot_aspek',
                'goal_kinerja_bobot_aspek',
                'error_kinerja_bobot_aspek',
                'proses_dokumen_bobot_aspek',
                'proses_inisiatif_bobot_aspek',
                'proses_polapikir_bobot_aspek',
                'sum_nilai_k_bobot_aspek',
                'sum_nilai_s_bobot_aspek',
                'sum_nilai_p_bobot_aspek',
                'sum_nilai_dp3',
                'relasi',
                'npp_penilai_dinilai'
            )
            ->where('npp_dinilai', $row->npp_karyawan)
            ->get();
            // dd($personal);
    
            $dp3 = FinalDp3::with(['relasi_karyawan'])
                ->select('npp_dinilai_id')
                // ->select()
                ->selectRaw('sum(avg_dp3) as total')
                ->where('npp_dinilai_id', $row->id)
                ->groupBy('npp_dinilai_id')
                ->get();
    
            // dd($row->id);
            // dd($dp3->toArray());
    
            $collectionDp3 = $dp3->sortBy('relasi');
            $collectionDp3->values()->all();
    
            $collectionPersonal = $personal->sortBy('relasi');;
            $collectionPersonal->values()->all();
    
            // dd(collect($collectionPersonal)->unique('npp_penilai_id'));
    
            $data_karyawan = collect($collectionDp3)->unique('npp_dinilai_id');
            // dd(count($data_karyawan));
            $total_raspek = 0;
            if(count($data_karyawan) > 0 ){
                // dd($data_karyawan->toArray());
                $data_karyawan = Arr::flatten($data_karyawan->toArray());
                // dd(count($data_karyawan));
                // dd($data_karyawan);
        
                $nama = $data_karyawan[6] ?? 'blm ada nama';
                $unit = $data_karyawan[5] ?? 'blm ada unit';
                $level = $data_karyawan[4] ?? 'blm ada level';
                $npp = $data_karyawan[3] ?? 'blm ada npp';
                $totalMentah = $data_karyawan[1];
        
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
        
                $ambang_batas_k = [];
                $ambang_batas_s = [];
                $ambang_batas_p = [];
        
                $relasiExist = ['staff', 'self', 'rekanan', 'atasan'];
        
                // dd($collectionPersonal['relasi']);
                foreach ($collectionPersonal as $keyRelasi => $itemRelasi) {
                    if (in_array($itemRelasi['relasi'], $relasiExist)) {
                        unset($relasiExist[array_search($itemRelasi['relasi'], $relasiExist)]);
                    }
                }
        
                $total_missing_relasi = 0;
        
                // dd($relasiExist);
        
                $missingItem = '';
        
                foreach ($relasiExist as $missingKey => $missingItem) {
                    // dd($level);
                    if (
                        Str::remove(' ', $level) == 'DIREKSI' ||
                        Str::remove(' ', $level) == 'IA' ||
                        Str::remove(' ', $level) == 'IB' ||
                        Str::remove(' ', $level) == 'IC' ||
                        Str::remove(' ', $level) == 'IANS'
                    ) {
                        // Bobot Dinilai Level
                        $dinilai_atasan = 0.6;
                        $dinilai_rekan = 0.2;
                        $dinilai_staff = 0.15;
                        $dinilai_self = 0.05;
                        // Bobot End Level
                        // Bobot Aspek Level
                        $kali_k = 1 * 0.4;  // Kepemimpinan
                        $kali_p = 1 * 0.25;  // Perilaku
                        $kali_s = 1 * 0.35;  // Sasaran
                        // End Bobot Aspek Level
                        if ($missingItem == 'atasan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                        } elseif ($missingItem == 'rekanan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                        } elseif ($missingItem == 'staff') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                        } elseif($missingItem == 'self'){
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                        }
                    } elseif (
                        Str::remove(' ', $level) == 'II' ||
                        Str::remove(' ', $level) == 'IINS'
                    ) {
                        // Bobot Dinilai Level
                        $dinilai_atasan = 0.6;
                        $dinilai_rekan = 0.2;
                        $dinilai_staff = 0.15;
                        $dinilai_self = 0.05;
                        // Bobot End Level
                        $kali_k = 1 * 0.35;
                        $kali_p = 1 * 0.25;
                        $kali_s = 1 * 0.4;
                        if ($missingItem == 'atasan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                        } elseif ($missingItem == 'rekanan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                        } elseif ($missingItem == 'staff') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                        } elseif($missingItem == 'self'){
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                        }
                    } elseif (
                        Str::remove(' ', $level) == 'III' ||
                        Str::remove(' ', $level) == 'IIINS' ||
                        Str::remove(' ', $level) == 'IIII'
                    ) {
                        // Bobot Dinilai Level
                        $dinilai_atasan = 0.6;
                        $dinilai_rekan = 0.2;
                        $dinilai_staff = 0.15;
                        $dinilai_self = 0.05;
                        // Bobot End Level
                        $kali_k = 1 * 0.3;
                        $kali_p = 1 * 0.25;
                        $kali_s = 1 * 0.45;
                        if ($missingItem == 'atasan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                        } elseif ($missingItem == 'rekanan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                        } elseif ($missingItem == 'staff') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                        } elseif($missingItem == 'self'){
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                        }
                    } elseif (
                        Str::remove(' ', $level) == 'IV' ||
                        Str::remove(' ', $level) == 'IVA(III)' ||
                        Str::remove(' ', $level) == 'IVA(IIINS)' ||
                        Str::remove(' ', $level) == 'IVA'
                    ) {
                        // Bobot Dinilai Level
                        $dinilai_atasan = 0.6;
                        $dinilai_rekan = 0.2;
                        $dinilai_staff = 0.15;
                        $dinilai_self = 0.05;
                        // Bobot End Level
                        $kali_k = 1 * 0.1;
                        $kali_p = 1 * 0.3;
                        $kali_s = 1 * 0.6;
                        if ($missingItem == 'atasan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                        } elseif ($missingItem == 'rekanan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                        } elseif ($missingItem == 'staff') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                        } elseif($missingItem == 'self'){
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                        }
                    } else {
                        // Bobot Dinilai Level
                        $dinilai_atasan = 0.65;
                        $dinilai_rekan = 0.25;
                        $dinilai_staff = 0;
                        $dinilai_self = 0.1;
                        // Bobot End Level
                        $kali_k = 1 * 0;
                        $kali_p = 1 * 0.35;
                        $kali_s = 1 * 0.65;
                        if ($missingItem == 'atasan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                        } elseif ($missingItem == 'rekanan') {
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                        } elseif($missingItem == 'self'){
                            $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                        }
                    }
                }
        
                foreach ($collectionPersonal as $keys => $item) {
                    if ($item['relasi'] == 'staff' || $item['relasi'] == 'rekanan') {
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
        
                        $raspek_k_staff[$keys]['raspek_k'] = round(
                            $item['strategi_perencanaan_bobot_aspek']
                                + $item['strategi_pengawasan_bobot_aspek']
                                + $item['strategi_inovasi_bobot_aspek']
                                + $item['kepemimpinan_bobot_aspek']
                                + $item['membimbing_membangun_bobot_aspek']
                                + $item['pengambilan_keputusan_bobot_aspek'],
                            2
                        );
                        $raspek_s_staff[$keys]['raspek_s'] = round(
                            $item['kerjasama_bobot_aspek']
                                + $item['komunikasi_bobot_aspek']
                                + $item['absensi_bobot_aspek']
                                + $item['integritas_bobot_aspek']
                                + $item['etika_bobot_aspek'],
                            2
                        );
                        $raspek_p_staff[$keys]['raspek_p'] = round(
                            $item['goal_kinerja_bobot_aspek']
                                + $item['error_kinerja_bobot_aspek']
                                + $item['proses_dokumen_bobot_aspek']
                                + $item['proses_inisiatif_bobot_aspek']
                                + $item['proses_polapikir_bobot_aspek'],
                            2
                        );
                    } else {
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
        
                        $raspek_k_non[$keys]['raspek_k'] = round(
                            $item['strategi_perencanaan_bobot_aspek']
                                + $item['strategi_pengawasan_bobot_aspek']
                                + $item['strategi_inovasi_bobot_aspek']
                                + $item['kepemimpinan_bobot_aspek']
                                + $item['membimbing_membangun_bobot_aspek']
                                + $item['pengambilan_keputusan_bobot_aspek'],
                            2
                        );
                        $raspek_s_non[$keys]['raspek_s'] = round(
                            $item['kerjasama_bobot_aspek']
                                + $item['komunikasi_bobot_aspek']
                                + $item['absensi_bobot_aspek']
                                + $item['integritas_bobot_aspek']
                                + $item['etika_bobot_aspek'],
                            2
                        );
                        $raspek_p_non[$keys]['raspek_p'] = round(
                            $item['goal_kinerja_bobot_aspek']
                                + $item['error_kinerja_bobot_aspek']
                                + $item['proses_dokumen_bobot_aspek']
                                + $item['proses_inisiatif_bobot_aspek']
                                + $item['proses_polapikir_bobot_aspek'],
                            2
                        );
                        $divider++;
                    }
                }
        
                $bil1 = collect($avg_dp3_staff)->avg('sum_nilai_dp3');
                $bil2 = collect($avg_dp3_non_staff)->sum('sum_nilai_dp3');
                $total_raspek = round(($data_karyawan[1]) + ($total_missing_relasi * 100),2);
        
                $k1_mentah = round(collect($k1_staff)->avg('k1') + collect($k1_non)->sum('k1'),2);
                $k2_mentah = round(collect($k2_staff)->avg('k2') + collect($k2_non)->sum('k2'),2);
                $k3_mentah = round(collect($k3_staff)->avg('k3') + collect($k3_non)->sum('k3'),2);
                $k4_mentah = round(collect($k4_staff)->avg('k4') + collect($k4_non)->sum('k4'),2);
                $k5_mentah = round(collect($k5_staff)->avg('k5') + collect($k5_non)->sum('k5'),2);
                $k6_mentah = round(collect($k6_staff)->avg('k6') + collect($k6_non)->sum('k6'),2);
        
                $p1_mentah = round(collect($p1_staff)->avg('p1') + collect($p1_non)->sum('p1'),2);
                $p2_mentah = round(collect($p2_staff)->avg('p2') + collect($p2_non)->sum('p2'),2);
                $p3_mentah = round(collect($p3_staff)->avg('p3') + collect($p3_non)->sum('p3'),2);
                $p4_mentah = round(collect($p4_staff)->avg('p4') + collect($p4_non)->sum('p4'),2);
                $p5_mentah = round(collect($p5_staff)->avg('p5') + collect($p5_non)->sum('p5'),2);
        
                $s1_mentah = round(collect($s1_staff)->avg('s1') + collect($s1_non)->sum('s1'),2);
                $s2_mentah = round(collect($s2_staff)->avg('s2') + collect($s2_non)->sum('s2'),2);
                $s3_mentah = round(collect($s3_staff)->avg('s3') + collect($s3_non)->sum('s3'),2);
                $s4_mentah = round(collect($s4_staff)->avg('s4') + collect($s4_non)->sum('s4'),2);
                $s5_mentah = round(collect($s5_staff)->avg('s5') + collect($s5_non)->sum('s5'),2);
        
                $raspek_k_mentah = round(collect($raspek_k_staff)->avg('raspek_k') + collect($raspek_k_non)->sum('raspek_k'),2);
                $raspek_s_mentah = round(collect($raspek_s_staff)->avg('raspek_s') + collect($raspek_s_non)->sum('raspek_s'),2);
                $raspek_p_mentah = round(collect($raspek_p_staff)->avg('raspek_p') + collect($raspek_p_non)->sum('raspek_p'),2);
        
                $k1 = round($k1_mentah / ($divider + 1), 2);
                $k2 = round($k2_mentah / ($divider + 1), 2);
                $k3 = round($k3_mentah / ($divider + 1), 2);
                $k4 = round($k4_mentah / ($divider + 1), 2);
                $k5 = round($k5_mentah / ($divider + 1), 2);
                $k6 = round($k6_mentah / ($divider + 1), 2);

                $p1 = round($p1_mentah / ($divider + 1), 2);
                $p2 = round($p2_mentah / ($divider + 1), 2);
                $p3 = round($p3_mentah / ($divider + 1), 2);
                $p4 = round($p4_mentah / ($divider + 1), 2);
                $p5 = round($p5_mentah / ($divider + 1), 2);

                $s1 = round($s1_mentah / ($divider + 1), 2);
                $s2 = round($s2_mentah / ($divider + 1), 2);
                $s3 = round($s3_mentah / ($divider + 1), 2);
                $s4 = round($s4_mentah / ($divider + 1), 2);
                $s5 = round($s5_mentah / ($divider + 1), 2);
        
                $raspek_k = round($k1 + $k2 + $k3 + $k4 + $k5 + $k6, 2);
                $raspek_s = round($s1 + $s2 + $s3 + $s4 + $s5, 2);
                $raspek_p = round($p1 + $p2 + $p3 + $p4 + $p5, 2);
        
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
                    $point_dp3 = 0;
                }
            }

            $finalData[$keyKaryawans] = [
                'npp_dinilai_id' => $row->id,
                'npp_karyawan' => $npp,
                'nama_karyawan' => $nama,
                'level_jabatan' => $level,
                'total' => $totalMentah,
                'total_raspek' => round($total_raspek,2) ?? 'null',
                'point_dp3' => $point_dp3 ?? 'null',
                'kriteria_dp3' => $kriteria_dp3 ?? 'null',
            ];
            
        }
        // dd($finalData)->unique('npp_dinilai_id');
        // npp_dinilai_id
        // $finalData->unique()
        $finalDataEnd = collect($finalData)->unique('npp_dinilai_id');
        // dd($finalDataEnd);
        return view('hc.rekap.penilai.index-personal')->with([
            'personal' => $finalDataEnd,
        ]);
        // EndNew

        // Old
        // $personalEnd = FinalDp3::with([
        //     'relasi_karyawan'
        // ])
        // $personalEnd = FinalDp3::select('id', 'npp_dinilai_id')
        //     ->selectRaw('SUM(avg_dp3) as total')
        //     ->groupBy('npp_dinilai_id')
        //     ->limit(1)
        //     ->get();

        // $arrayPersonal = collect($personalEnd->toArray());

        // $finalDataEnd = new Collection();

        // $arrayPersonal->merge($finalData)
        //     ->groupBy('npp_dinilai_id')
        //     ->map(function($items) use($finalDataEnd){
        //         // return Arr::collapse($items);
        //         // $endOfData = Arr::collapse($items);
        //         $finalDataEnd->push((object)Arr::collapse($items));
        //     });

        // // dd($arrayPersonal->all());
        // dd($finalDataEnd);

        // // return $personal->toArray();
        // $testdata = (object)$finalDataEnd;

        // return view('hc.rekap.penilai.index-personal')->with([
        //     // 'personal' => $arrayPersonal->get(),
        //     'personal' => $finalDataEnd,
        // ]);
    }

    public function report(Request $request)
    {
        $personal = RekapPenilai::select(
            'npp_penilai',
            'strategi_perencanaan_bobot_aspek',
            'strategi_pengawasan_bobot_aspek',
            'strategi_inovasi_bobot_aspek',
            'kepemimpinan_bobot_aspek',
            'membimbing_membangun_bobot_aspek',
            'pengambilan_keputusan_bobot_aspek',
            'kerjasama_bobot_aspek',
            'komunikasi_bobot_aspek',
            'absensi_bobot_aspek',
            'integritas_bobot_aspek',
            'etika_bobot_aspek',
            'goal_kinerja_bobot_aspek',
            'error_kinerja_bobot_aspek',
            'proses_dokumen_bobot_aspek',
            'proses_inisiatif_bobot_aspek',
            'proses_polapikir_bobot_aspek',
            'sum_nilai_k_bobot_aspek',
            'sum_nilai_s_bobot_aspek',
            'sum_nilai_p_bobot_aspek',
            'sum_nilai_dp3',
            'relasi',
            'npp_penilai_dinilai'
        )
            // ->selectRaw('avg(strategi_perencanaan_bobot_aspek) as p1')
            // ->selectRaw('avg(strategi_pengawasan_bobot_aspek) as p2')
            // ->selectRaw('avg(strategi_inovasi_bobot_aspek) as p3')
            // ->selectRaw('avg(kepemimpinan_bobot_aspek) as p4')
            // ->selectRaw('avg(membimbing_membangun_bobot_aspek) as p5')
            // ->selectRaw('avg(pengambilan_keputusan_bobot_aspek) as p6')
            // ->selectRaw('sum(sum_nilai_dp3) as dp333')
            ->where('npp_dinilai', $request->npp)
            // ->orderBy('npp_dinilai')
            // ->groupBy('relasi')
            ->get();
        // ->unique('npp_penilai_dinilai');

        // dd($personal->toArray());

        $dp3 = FinalDp3::with(['relasi_karyawan'])
            ->select('npp_dinilai_id')
            ->selectRaw('sum(avg_dp3) as total')
            ->where('npp_dinilai_id', $request->id)
            ->groupBy('npp_dinilai_id')
            ->get();

        // dd($request->npp, $request->id);
        // dd($dp3->toArray());

        $collectionDp3 = $dp3->sortBy('relasi');
        $collectionDp3->values()->all();

        // dd($collectionDp3);

        $collectionPersonal = $personal->sortBy('relasi');
        $collectionPersonal->values()->all();

        // dd(collect($collectionPersonal)->unique('npp_penilai_id'));

        $data_karyawan = collect($collectionDp3)->unique('npp_dinilai_id');
        $data_karyawan = Arr::flatten($data_karyawan->toArray());
        // dd($collectionPersonal->toArray());
        $nama = $data_karyawan[6];
        $unit = $data_karyawan[5];
        $level = $data_karyawan[4];
        $npp = $data_karyawan[3];

        // dd($data_karyawan);

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

        // dd($collectionPersonal->toArray());
        $ambang_batas_k = [];
        $ambang_batas_s = [];
        $ambang_batas_p = [];

        $relasiExist = ['staff', 'self', 'rekanan', 'atasan'];

        // dd($personal->toArray());

        foreach ($collectionPersonal as $keyRelasi => $itemRelasi) {
            if (in_array($itemRelasi['relasi'], $relasiExist)) {
                unset($relasiExist[array_search($itemRelasi['relasi'], $relasiExist)]);
            }
        }

        $total_missing_relasi = 0;

        foreach ($relasiExist as $missingKey => $missingItem) {
            // dd($level);
            if (
                Str::remove(' ', $level) == 'DIREKSI' ||
                Str::remove(' ', $level) == 'IA' ||
                Str::remove(' ', $level) == 'IB' ||
                Str::remove(' ', $level) == 'IC' ||
                Str::remove(' ', $level) == 'IANS'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                // Bobot Aspek Level
                $kali_k = 1 * 0.4;  // Kepemimpinan
                $kali_p = 1 * 0.25;  // Perilaku
                $kali_s = 1 * 0.35;  // Sasaran
                // End Bobot Aspek Level
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } elseif (
                Str::remove(' ', $level) == 'II' ||
                Str::remove(' ', $level) == 'IINS'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 1 * 0.35;
                $kali_p = 1 * 0.25;
                $kali_s = 1 * 0.4;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } elseif (
                Str::remove(' ', $level) == 'III' ||
                Str::remove(' ', $level) == 'IIINS' ||
                Str::remove(' ', $level) == 'IIII'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 1 * 0.3;
                $kali_p = 1 * 0.25;
                $kali_s = 1 * 0.45;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } elseif (
                Str::remove(' ', $level) == 'IV' ||
                Str::remove(' ', $level) == 'IVA(III)' ||
                Str::remove(' ', $level) == 'IVA(IIINS)' ||
                Str::remove(' ', $level) == 'IVA'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_staff = 0.05;
                // Bobot End Level
                $kali_k = 1 * 0.1;
                $kali_p = 1 * 0.3;
                $kali_s = 1 * 0.6;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } else {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.65;
                $dinilai_rekan = 0.25;
                $dinilai_staff = 0;
                $dinilai_self = 0.1;
                // Bobot End Level
                $kali_k = 1 * 0;
                $kali_p = 1 * 0.35;
                $kali_s = 1 * 0.65;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            }
        }

        // dd($total_missing_relasi * 100);
        // dd($relasiExist);

        foreach ($collectionPersonal as $keys => $item) {
            if ($item['relasi'] == 'staff' || $item['relasi'] == 'rekanan') {
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

                $raspek_k_staff[$keys]['raspek_k'] = round(
                    $item['strategi_perencanaan_bobot_aspek']
                        + $item['strategi_pengawasan_bobot_aspek']
                        + $item['strategi_inovasi_bobot_aspek']
                        + $item['kepemimpinan_bobot_aspek']
                        + $item['membimbing_membangun_bobot_aspek']
                        + $item['pengambilan_keputusan_bobot_aspek'],
                    2
                );
                $raspek_s_staff[$keys]['raspek_s'] = round(
                    $item['kerjasama_bobot_aspek']
                        + $item['komunikasi_bobot_aspek']
                        + $item['absensi_bobot_aspek']
                        + $item['integritas_bobot_aspek']
                        + $item['etika_bobot_aspek'],
                    2
                );
                $raspek_p_staff[$keys]['raspek_p'] = round(
                    $item['goal_kinerja_bobot_aspek']
                        + $item['error_kinerja_bobot_aspek']
                        + $item['proses_dokumen_bobot_aspek']
                        + $item['proses_inisiatif_bobot_aspek']
                        + $item['proses_polapikir_bobot_aspek'],
                    2
                );
            } else {
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

                $raspek_k_non[$keys]['raspek_k'] = round(
                    $item['strategi_perencanaan_bobot_aspek']
                        + $item['strategi_pengawasan_bobot_aspek']
                        + $item['strategi_inovasi_bobot_aspek']
                        + $item['kepemimpinan_bobot_aspek']
                        + $item['membimbing_membangun_bobot_aspek']
                        + $item['pengambilan_keputusan_bobot_aspek'],
                    2
                );
                $raspek_s_non[$keys]['raspek_s'] = round(
                    $item['kerjasama_bobot_aspek']
                        + $item['komunikasi_bobot_aspek']
                        + $item['absensi_bobot_aspek']
                        + $item['integritas_bobot_aspek']
                        + $item['etika_bobot_aspek'],
                    2
                );
                $raspek_p_non[$keys]['raspek_p'] = round(
                    $item['goal_kinerja_bobot_aspek']
                        + $item['error_kinerja_bobot_aspek']
                        + $item['proses_dokumen_bobot_aspek']
                        + $item['proses_inisiatif_bobot_aspek']
                        + $item['proses_polapikir_bobot_aspek'],
                    2
                );
                $divider++;
            }
        }
        $bil1 = collect($avg_dp3_staff)->avg('sum_nilai_dp3');
        $bil2 = collect($avg_dp3_non_staff)->sum('sum_nilai_dp3');
        // $total_raspek = round(($bil1 + $bil2) * 100, 2);
        $total_raspek = round(($data_karyawan[1]) + ($total_missing_relasi * 100), 2);
        // dd($total_raspek);

        $k1_mentah = round(collect($k1_staff)->avg('k1') + collect($k1_non)->sum('k1'), 2);
        $k2_mentah = round(collect($k2_staff)->avg('k2') + collect($k2_non)->sum('k2'), 2);
        $k3_mentah = round(collect($k3_staff)->avg('k3') + collect($k3_non)->sum('k3'), 2);
        $k4_mentah = round(collect($k4_staff)->avg('k4') + collect($k4_non)->sum('k4'), 2);
        $k5_mentah = round(collect($k5_staff)->avg('k5') + collect($k5_non)->sum('k5'), 2);
        $k6_mentah = round(collect($k6_staff)->avg('k6') + collect($k6_non)->sum('k6'), 2);

        $p1_mentah = round(collect($p1_staff)->avg('p1') + collect($p1_non)->sum('p1'), 2);
        $p2_mentah = round(collect($p2_staff)->avg('p2') + collect($p2_non)->sum('p2'), 2);
        $p3_mentah = round(collect($p3_staff)->avg('p3') + collect($p3_non)->sum('p3'), 2);
        $p4_mentah = round(collect($p4_staff)->avg('p4') + collect($p4_non)->sum('p4'), 2);
        $p5_mentah = round(collect($p5_staff)->avg('p5') + collect($p5_non)->sum('p5'), 2);

        $s1_mentah = round(collect($s1_staff)->avg('s1') + collect($s1_non)->sum('s1'), 2);
        $s2_mentah = round(collect($s2_staff)->avg('s2') + collect($s2_non)->sum('s2'), 2);
        $s3_mentah = round(collect($s3_staff)->avg('s3') + collect($s3_non)->sum('s3'), 2);
        $s4_mentah = round(collect($s4_staff)->avg('s4') + collect($s4_non)->sum('s4'), 2);
        $s5_mentah = round(collect($s5_staff)->avg('s5') + collect($s5_non)->sum('s5'), 2);

        $raspek_k_mentah = round(collect($raspek_k_staff)->avg('raspek_k') + collect($raspek_k_non)->sum('raspek_k'), 2);
        $raspek_s_mentah = round(collect($raspek_s_staff)->avg('raspek_s') + collect($raspek_s_non)->sum('raspek_s'), 2);
        $raspek_p_mentah = round(collect($raspek_p_staff)->avg('raspek_p') + collect($raspek_p_non)->sum('raspek_p'), 2);

        // dd($k1_mentah);
        $k1 = round($k1_mentah / ($divider + 1), 2);
        $k2 = round($k2_mentah / ($divider + 1), 2);
        $k3 = round($k3_mentah / ($divider + 1), 2);
        $k4 = round($k4_mentah / ($divider + 1), 2);
        $k5 = round($k5_mentah / ($divider + 1), 2);
        $k6 = round($k6_mentah / ($divider + 1), 2);

        $p1 = round($p1_mentah / ($divider + 1), 2);
        $p2 = round($p2_mentah / ($divider + 1), 2);
        $p3 = round($p3_mentah / ($divider + 1), 2);
        $p4 = round($p4_mentah / ($divider + 1), 2);
        $p5 = round($p5_mentah / ($divider + 1), 2);

        $s1 = round($s1_mentah / ($divider + 1), 2);
        $s2 = round($s2_mentah / ($divider + 1), 2);
        $s3 = round($s3_mentah / ($divider + 1), 2);
        $s4 = round($s4_mentah / ($divider + 1), 2);
        $s5 = round($s5_mentah / ($divider + 1), 2);

        // $raspek_k = $raspek_k_mentah / ($divider + 1);
        // $raspek_s = $raspek_s_mentah / ($divider + 1);
        // $raspek_p = $raspek_p_mentah / ($divider + 1);
        $raspek_k = round($k1 + $k2 + $k3 + $k4 + $k5 + $k6, 2);
        $raspek_s = round($s1 + $s2 + $s3 + $s4 + $s5, 2);
        $raspek_p = round($p1 + $p2 + $p3 + $p4 + $p5, 2);
        // dd($raspek_k,$raspek_s, $raspek_p);

        // $total_aspek = round($raspek_k + $raspek_s + $raspek_p, 2);

        // dd($divider);
        // dd($total_missing_relasi);

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
            $point_dp3 = 0;
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

        $user_akun = Auth::user();
        if ($user_akun) {
            if ($user_akun->level != 1) {
                $password = '123';
                $users = User::where('npp', $request->npp)->first();
                if ($users) {
                    $user = $users->toArray();
                    $password = $user['no_hp'];
                }
                $pdf
                    ->getCanvas()
                    ->get_cpdf()
                    ->setEncryption($password, $password, ['print', 'modify', 'copy', 'add']);
            }
        }

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
        // $nilai = FinalDp3::with([
        //     'relasi_karyawan'
        // ])
        //     ->select('id', 'npp_dinilai_id')
        //     ->selectRaw('SUM(avg_dp3) as total')
        //     ->where('npp_dinilai_id', $karyawan['id'])
        //     ->groupBy('npp_dinilai_id')
        //     ->get();

        // Baru
        $personal = RekapPenilai::select(
            'npp_penilai',
            'strategi_perencanaan_bobot_aspek',
            'strategi_pengawasan_bobot_aspek',
            'strategi_inovasi_bobot_aspek',
            'kepemimpinan_bobot_aspek',
            'membimbing_membangun_bobot_aspek',
            'pengambilan_keputusan_bobot_aspek',
            'kerjasama_bobot_aspek',
            'komunikasi_bobot_aspek',
            'absensi_bobot_aspek',
            'integritas_bobot_aspek',
            'etika_bobot_aspek',
            'goal_kinerja_bobot_aspek',
            'error_kinerja_bobot_aspek',
            'proses_dokumen_bobot_aspek',
            'proses_inisiatif_bobot_aspek',
            'proses_polapikir_bobot_aspek',
            'sum_nilai_k_bobot_aspek',
            'sum_nilai_s_bobot_aspek',
            'sum_nilai_p_bobot_aspek',
            'sum_nilai_dp3',
            'relasi',
            'npp_penilai_dinilai'
        )
            ->where('npp_dinilai', $karyawan['npp_karyawan'])
            ->get();
        $dp3 = FinalDp3::with(['relasi_karyawan'])
            ->select('npp_dinilai_id')
            ->selectRaw('sum(avg_dp3) as total')
            ->where('npp_dinilai_id', $karyawan['id'])
            ->groupBy('npp_dinilai_id')
            ->get();

        $collectionDp3 = $dp3->sortBy('relasi');
        $collectionDp3->values()->all();
        $collectionPersonal = $personal->sortBy('relasi');
        $collectionPersonal->values()->all();
        $data_karyawan = collect($collectionDp3)->unique('npp_dinilai_id');
        $data_karyawan = Arr::flatten($data_karyawan->toArray());
        $nama = $data_karyawan[6];
        $unit = $data_karyawan[5];
        $level = $data_karyawan[4];
        $npp = $data_karyawan[3];
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

        $ambang_batas_k = [];
        $ambang_batas_s = [];
        $ambang_batas_p = [];

        $relasiExist = ['staff', 'self', 'rekanan', 'atasan'];

        foreach ($collectionPersonal as $keyRelasi => $itemRelasi) {
            if (in_array($itemRelasi['relasi'], $relasiExist)) {
                unset($relasiExist[array_search($itemRelasi['relasi'], $relasiExist)]);
            }
        }

        $total_missing_relasi = 0;

        foreach ($relasiExist as $missingKey => $missingItem) {
            if (
                Str::remove(' ', $level) == 'DIREKSI' ||
                Str::remove(' ', $level) == 'IA' ||
                Str::remove(' ', $level) == 'IB' ||
                Str::remove(' ', $level) == 'IC' ||
                Str::remove(' ', $level) == 'IANS'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                // Bobot Aspek Level
                $kali_k = 1 * 0.4;  // Kepemimpinan
                $kali_p = 1 * 0.25;  // Perilaku
                $kali_s = 1 * 0.35;  // Sasaran
                // End Bobot Aspek Level
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } elseif (
                Str::remove(' ', $level) == 'II' ||
                Str::remove(' ', $level) == 'IINS'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 1 * 0.35;
                $kali_p = 1 * 0.25;
                $kali_s = 1 * 0.4;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } elseif (
                Str::remove(' ', $level) == 'III' ||
                Str::remove(' ', $level) == 'IIINS' ||
                Str::remove(' ', $level) == 'IIII'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_self = 0.05;
                // Bobot End Level
                $kali_k = 1 * 0.3;
                $kali_p = 1 * 0.25;
                $kali_s = 1 * 0.45;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } elseif (
                Str::remove(' ', $level) == 'IV' ||
                Str::remove(' ', $level) == 'IVA(III)' ||
                Str::remove(' ', $level) == 'IVA(IIINS)' ||
                Str::remove(' ', $level) == 'IVA'
            ) {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.6;
                $dinilai_rekan = 0.2;
                $dinilai_staff = 0.15;
                $dinilai_staff = 0.05;
                // Bobot End Level
                $kali_k = 1 * 0.1;
                $kali_p = 1 * 0.3;
                $kali_s = 1 * 0.6;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'staff') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_staff, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            } else {
                // Bobot Dinilai Level
                $dinilai_atasan = 0.65;
                $dinilai_rekan = 0.25;
                $dinilai_staff = 0;
                $dinilai_self = 0.1;
                // Bobot End Level
                $kali_k = 1 * 0;
                $kali_p = 1 * 0.35;
                $kali_s = 1 * 0.65;
                if ($missingItem == 'atasan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_atasan, 2);
                } elseif ($missingItem == 'rekanan') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_rekan, 2);
                } elseif ($missingItem == 'self') {
                    $total_missing_relasi += round(round($kali_k + $kali_p + $kali_s, 2) * $dinilai_self, 2);
                }
            }
        }

        foreach ($collectionPersonal as $keys => $item) {
            if ($item['relasi'] == 'staff' || $item['relasi'] == 'rekanan') {
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

                $raspek_k_staff[$keys]['raspek_k'] = round(
                    $item['strategi_perencanaan_bobot_aspek']
                        + $item['strategi_pengawasan_bobot_aspek']
                        + $item['strategi_inovasi_bobot_aspek']
                        + $item['kepemimpinan_bobot_aspek']
                        + $item['membimbing_membangun_bobot_aspek']
                        + $item['pengambilan_keputusan_bobot_aspek'],
                    2
                );
                $raspek_s_staff[$keys]['raspek_s'] = round(
                    $item['kerjasama_bobot_aspek']
                        + $item['komunikasi_bobot_aspek']
                        + $item['absensi_bobot_aspek']
                        + $item['integritas_bobot_aspek']
                        + $item['etika_bobot_aspek'],
                    2
                );
                $raspek_p_staff[$keys]['raspek_p'] = round(
                    $item['goal_kinerja_bobot_aspek']
                        + $item['error_kinerja_bobot_aspek']
                        + $item['proses_dokumen_bobot_aspek']
                        + $item['proses_inisiatif_bobot_aspek']
                        + $item['proses_polapikir_bobot_aspek'],
                    2
                );
            } else {
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

                $raspek_k_non[$keys]['raspek_k'] = round(
                    $item['strategi_perencanaan_bobot_aspek']
                        + $item['strategi_pengawasan_bobot_aspek']
                        + $item['strategi_inovasi_bobot_aspek']
                        + $item['kepemimpinan_bobot_aspek']
                        + $item['membimbing_membangun_bobot_aspek']
                        + $item['pengambilan_keputusan_bobot_aspek'],
                    2
                );
                $raspek_s_non[$keys]['raspek_s'] = round(
                    $item['kerjasama_bobot_aspek']
                        + $item['komunikasi_bobot_aspek']
                        + $item['absensi_bobot_aspek']
                        + $item['integritas_bobot_aspek']
                        + $item['etika_bobot_aspek'],
                    2
                );
                $raspek_p_non[$keys]['raspek_p'] = round(
                    $item['goal_kinerja_bobot_aspek']
                        + $item['error_kinerja_bobot_aspek']
                        + $item['proses_dokumen_bobot_aspek']
                        + $item['proses_inisiatif_bobot_aspek']
                        + $item['proses_polapikir_bobot_aspek'],
                    2
                );
                $divider++;
            }
        }
        $bil1 = collect($avg_dp3_staff)->avg('sum_nilai_dp3');
        $bil2 = collect($avg_dp3_non_staff)->sum('sum_nilai_dp3');
        $total_raspek = round(($data_karyawan[1]) + ($total_missing_relasi * 100), 2);
        $k1_mentah = round(collect($k1_staff)->avg('k1') + collect($k1_non)->sum('k1'), 2);
        $k2_mentah = round(collect($k2_staff)->avg('k2') + collect($k2_non)->sum('k2'), 2);
        $k3_mentah = round(collect($k3_staff)->avg('k3') + collect($k3_non)->sum('k3'), 2);
        $k4_mentah = round(collect($k4_staff)->avg('k4') + collect($k4_non)->sum('k4'), 2);
        $k5_mentah = round(collect($k5_staff)->avg('k5') + collect($k5_non)->sum('k5'), 2);
        $k6_mentah = round(collect($k6_staff)->avg('k6') + collect($k6_non)->sum('k6'), 2);

        $p1_mentah = round(collect($p1_staff)->avg('p1') + collect($p1_non)->sum('p1'), 2);
        $p2_mentah = round(collect($p2_staff)->avg('p2') + collect($p2_non)->sum('p2'), 2);
        $p3_mentah = round(collect($p3_staff)->avg('p3') + collect($p3_non)->sum('p3'), 2);
        $p4_mentah = round(collect($p4_staff)->avg('p4') + collect($p4_non)->sum('p4'), 2);
        $p5_mentah = round(collect($p5_staff)->avg('p5') + collect($p5_non)->sum('p5'), 2);

        $s1_mentah = round(collect($s1_staff)->avg('s1') + collect($s1_non)->sum('s1'), 2);
        $s2_mentah = round(collect($s2_staff)->avg('s2') + collect($s2_non)->sum('s2'), 2);
        $s3_mentah = round(collect($s3_staff)->avg('s3') + collect($s3_non)->sum('s3'), 2);
        $s4_mentah = round(collect($s4_staff)->avg('s4') + collect($s4_non)->sum('s4'), 2);
        $s5_mentah = round(collect($s5_staff)->avg('s5') + collect($s5_non)->sum('s5'), 2);

        $raspek_k_mentah = round(collect($raspek_k_staff)->avg('raspek_k') + collect($raspek_k_non)->sum('raspek_k'), 2);
        $raspek_s_mentah = round(collect($raspek_s_staff)->avg('raspek_s') + collect($raspek_s_non)->sum('raspek_s'), 2);
        $raspek_p_mentah = round(collect($raspek_p_staff)->avg('raspek_p') + collect($raspek_p_non)->sum('raspek_p'), 2);

        // dd($k1_mentah);
        $k1 = round($k1_mentah / ($divider + 1), 2);
        $k2 = round($k2_mentah / ($divider + 1), 2);
        $k3 = round($k3_mentah / ($divider + 1), 2);
        $k4 = round($k4_mentah / ($divider + 1), 2);
        $k5 = round($k5_mentah / ($divider + 1), 2);
        $k6 = round($k6_mentah / ($divider + 1), 2);

        $p1 = round($p1_mentah / ($divider + 1), 2);
        $p2 = round($p2_mentah / ($divider + 1), 2);
        $p3 = round($p3_mentah / ($divider + 1), 2);
        $p4 = round($p4_mentah / ($divider + 1), 2);
        $p5 = round($p5_mentah / ($divider + 1), 2);

        $s1 = round($s1_mentah / ($divider + 1), 2);
        $s2 = round($s2_mentah / ($divider + 1), 2);
        $s3 = round($s3_mentah / ($divider + 1), 2);
        $s4 = round($s4_mentah / ($divider + 1), 2);
        $s5 = round($s5_mentah / ($divider + 1), 2);

        // $raspek_k = $raspek_k_mentah / ($divider + 1);
        // $raspek_s = $raspek_s_mentah / ($divider + 1);
        // $raspek_p = $raspek_p_mentah / ($divider + 1);
        $raspek_k = round($k1 + $k2 + $k3 + $k4 + $k5 + $k6, 2);
        $raspek_s = round($s1 + $s2 + $s3 + $s4 + $s5, 2);
        $raspek_p = round($p1 + $p2 + $p3 + $p4 + $p5, 2);
        // End Baru

        $string = sprintf("%.2f", $total_raspek); // $string = "0.123";
        $nilai = [];
        $nilai = $string;
        // $nilai = collect([$total_raspek]);
        // dd($nilai);
        // dd($total_raspek);
        $lihatDokumen = AturJadwal::select('lihat_dokumen')->get()->last();
        $lihatSkor = AturJadwal::select('lihat_skor')->get()->last();
        return view('rekap-nilai')->with([
            'nilai' => $nilai,
            'id' => $karyawan['id'],
            'npp_karyawan' => $karyawan['npp_karyawan'],
            'lihatDokumen' => $lihatDokumen,
            'lihatSkor' => $lihatSkor,
            // 'nilai_self' => $self,
            // 'nilai_atasan' => $atasan,
            // 'nilai_rekanan' => $rekanan,
            // 'nilai_staff' => $staff,
        ]);
    }

    private function hitungRelasi($relasi)
    {
        $getPoolRespon = [];
        if ($relasi == 'self') {
            $getPoolRespon = PoolRespon::where('relasi', 'self')->orderby('npp_dinilai')->whereNull('deleted_at')->get()->unique('npp_penilai_dinilai');
        } elseif ($relasi == 'atasan') {
            $getPoolRespon = PoolRespon::where('relasi', 'atasan')->orderby('npp_dinilai')->whereNull('deleted_at')->get()->unique('npp_penilai_dinilai');
        } elseif ($relasi == 'rekanan') {
            $getPoolRespon = PoolRespon::where('relasi', 'rekanan')->orderby('npp_dinilai')->whereNull('deleted_at')->get()->unique('npp_penilai_dinilai');
        } elseif ($relasi == 'all') {
            $getPoolRespon = PoolRespon::orderby('npp_dinilai')->whereNull('deleted_at')->get()->unique('npp_penilai_dinilai');
        }
        // dd($getPoolRespon->toArray());
        $bobot_penilai = 0;
        $collection = [];
        $aspek_k = 0;  // 3
        $aspek_p = 0;  // 1
        $aspek_s = 0;  // 2

        $penilai_atasan = 0;
        $penilai_rekanan = 0;
        $penilai_staff = 0;
        $penilai_self = 0;

        $finalData = collect();
        $tempData = array();
        foreach ($getPoolRespon as $key => $items) {
            // Cari data penilai karyawan
            $penilaiKaryawan = RelasiKaryawan::where('id', $items['npp_penilai'])->first();
            if ($penilaiKaryawan) {
                $penilaiKaryawan->toArray();
                $dinilaiKaryawan = RelasiKaryawan::where('npp_karyawan', $items['npp_dinilai'])->first();
                if ($dinilaiKaryawan) {
                    $dinilaiKaryawan->toArray();
                    // Untuk Pengkalian Bobot setelah skor di dapat
                    if (
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'DIREKSI' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IA' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IB' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IC' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IANS'
                    ) {
                        $aspek_k = 0.4;  // 3
                        $aspek_p = 0.25;  // 1
                        $aspek_s = 0.35;  // 2

                        $penilai_atasan = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff = 0.15;
                        $penilai_self = 0.05;
                    } elseif (
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'II' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IINS'
                    ) {
                        $aspek_k = 0.35;
                        $aspek_p = 0.25;
                        $aspek_s = 0.4;

                        $penilai_atasan = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff = 0.15;
                        $penilai_self = 0.05;
                    } elseif (
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'III' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IIINS' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IIII'
                    ) {
                        $aspek_k = 0.3;
                        $aspek_p = 0.25;
                        $aspek_s = 0.45;

                        $penilai_atasan = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff = 0.15;
                        $penilai_self = 0.05;
                    } elseif (
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IV' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IVA(III)' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IVA(IIINS)' ||
                        Str::remove(' ', $dinilaiKaryawan['level_jabatan']) == 'IVA'
                    ) {
                        $aspek_k = 0.1;
                        $aspek_p = 0.3;
                        $aspek_s = 0.6;

                        $penilai_atasan = 0.6;
                        $penilai_rekanan = 0.2;
                        $penilai_staff = 0.15;
                        $penilai_self = 0.05;
                    } else {
                        $aspek_k = 0;
                        $aspek_p = 0.35;
                        $aspek_s = 0.65;

                        $penilai_atasan = 0.65;
                        $penilai_rekanan = 0.25;
                        $penilai_staff = 0;
                        $penilai_self = 0.1;
                    }

                    if ($items['relasi'] == 'self') {
                        $bobot_penilai = $penilai_self;
                    } elseif ($items['relasi'] == 'atasan') {
                        $bobot_penilai = $penilai_atasan;
                    } elseif ($items['relasi'] == 'rekanan') {
                        $bobot_penilai = $penilai_rekanan;
                    } elseif ($items['relasi'] == 'staff') {
                        $bobot_penilai = $penilai_staff;
                    }

                    // Kepemimpinan
                    $collection['strategi_perencanaan_bobot_aspek'] = round(round($items['strategi_perencanaan'] / 30, 2) * $aspek_k, 2);
                    $collection['strategi_pengawasan_bobot_aspek'] = round(round($items['strategi_pengawasan'] / 30, 2) * $aspek_k, 2);
                    $collection['strategi_inovasi_bobot_aspek'] = round(round($items['strategi_inovasi'] / 30, 2) * $aspek_k, 2);
                    $collection['kepemimpinan_bobot_aspek'] = round(round($items['kepemimpinan'] / 30, 2) * $aspek_k, 2);
                    $collection['membimbing_membangun_bobot_aspek'] = round(round($items['membimbing_membangun'] / 30, 2) * $aspek_k, 2);
                    $collection['pengambilan_keputusan_bobot_aspek'] = round(round($items['pengambilan_keputusan'] / 30, 2) * $aspek_k, 2);

                    $collection['sum_nilai_k_bobot_aspek'] =
                        $collection['strategi_perencanaan_bobot_aspek']
                        + $collection['strategi_pengawasan_bobot_aspek']
                        + $collection['strategi_inovasi_bobot_aspek']
                        + $collection['kepemimpinan_bobot_aspek']
                        + $collection['membimbing_membangun_bobot_aspek']
                        + $collection['pengambilan_keputusan_bobot_aspek'];

                    // Perilaku
                    $collection['kerjasama_bobot_aspek'] = round(round($items['kerjasama'] / 25, 2) * $aspek_p, 2);
                    $collection['komunikasi_bobot_aspek'] = round(round($items['komunikasi'] / 25, 2) * $aspek_p, 2);
                    $collection['absensi_bobot_aspek'] = round(round($items['absensi'] / 25, 2) * $aspek_p, 2);
                    $collection['integritas_bobot_aspek'] = round(round($items['integritas'] / 25, 2) * $aspek_p, 2);
                    $collection['etika_bobot_aspek'] = round(round($items['etika'] / 25, 2) * $aspek_p, 2);

                    $collection['sum_nilai_p_bobot_aspek'] =
                        $collection['kerjasama_bobot_aspek']
                        + $collection['komunikasi_bobot_aspek']
                        + $collection['absensi_bobot_aspek']
                        + $collection['integritas_bobot_aspek']
                        + $collection['etika_bobot_aspek'];

                    // Sasaran
                    $collection['goal_kinerja_bobot_aspek'] = round(round($items['goal_kinerja'] / 25, 2) * $aspek_s, 2);
                    $collection['error_kinerja_bobot_aspek'] = round(round($items['error_kinerja'] / 25, 2) * $aspek_s, 2);
                    $collection['proses_dokumen_bobot_aspek'] = round(round($items['proses_dokumen'] / 25, 2) * $aspek_s, 2);
                    $collection['proses_inisiatif_bobot_aspek'] = round(round($items['proses_inisiatif'] / 25, 2) * $aspek_s, 2);
                    $collection['proses_polapikir_bobot_aspek'] = round(round($items['proses_polapikir'] / 25, 2) * $aspek_s, 2);

                    $collection['sum_nilai_s_bobot_aspek'] =
                        $collection['goal_kinerja_bobot_aspek']
                        + $collection['error_kinerja_bobot_aspek']
                        + $collection['proses_dokumen_bobot_aspek']
                        + $collection['proses_inisiatif_bobot_aspek']
                        + $collection['proses_polapikir_bobot_aspek'];

                    $collection['sum_nilai_dp3'] = round((
                        $collection['sum_nilai_k_bobot_aspek']
                        + $collection['sum_nilai_s_bobot_aspek']
                        + $collection['sum_nilai_p_bobot_aspek']
                    ) * $bobot_penilai, 4);
                }
            }

            $tmpData = [
                [
                    'pool_respon_id' => $items['id'],
                ],
                [
                    'npp_penilai' => $penilaiKaryawan['id'],
                    'npp_dinilai' => $items['npp_dinilai'],
                    'jabatan_penilai' => $penilaiKaryawan['level_jabatan'],
                    'jabatan_dinilai' => $dinilaiKaryawan['level_jabatan'],
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
                    'npp_penilai_dinilai' => $items['npp_penilai_dinilai'],
                ],
            ];
            $tempData[] = $tmpData;
        }
        $finalData = collect($tempData);
        $counter = [];
        $counterSucess = 0;
        $counterError = 0;
        $finalData->unique()->values()->all();
        // $finalData->values()->all();
        // dd($finalData);
        foreach ($finalData as $key => $data) {
            try {
                $store = RekapPenilai::updateOrCreate($data[0], $data[1]);
                if ($store) {
                    $counterSucess += 1;
                }
            } catch (\Illuminate\Database\QueryException $e) {
                // $error = $e->getMessage();
                $counterError += 1;
                continue;
            }
        }

        $counter = [
            'success' => $counterSucess,
            'error' => $counterError,
        ];

        return response()->json([
            'title' => 'info',
            'text' => $counter,
            'icon' => 'info',
        ], 200);
    }

    public function calculateNew(Request $request)
    {
        return $this->hitungRelasi('all');
        // $hitung = $this->hitungRelasi('all');
        // dd($hitung['success']);
        // return response()->json([
        //     'title' => 'rekap dilakukan',
        //     'success' => $hitung['success'],
        //     'error' => $hitung['error'],
        //     'icon' => 'info'
        // ]);
    }

    public function calculate(Request $request)
    {
        $getPoolRespon = [];
        if ($request->relasi != 'all') {
            $getPoolRespon = PoolRespon::where('relasi', $request->relasi)->orderBy('npp_dinilai')->get();
        } else {
            $getPoolRespon = PoolRespon::orderby('created_at')->get()->unique('npp_penilai_dinilai');
            // $getPoolRespon = PoolRespon::orderby('npp_dinilai')->get();
        }

        // dd(count($getPoolRespon->toArray()));
        $bobot_penilai = 0;
        $collection = [];
        $aspek_k = 0;  // 3
        $aspek_p = 0;  // 1
        $aspek_s = 0;  // 2

        $penilai_atasan = 0;
        $penilai_rekanan = 0;
        $penilai_staff = 0;
        $penilai_self = 0;

        $finalData = collect();
        $tempData = array();
        foreach ($getPoolRespon as $key => $items) {
            // Cari data penilai karyawan
            $penilaiKaryawan = RelasiKaryawan::where('id', $items['npp_penilai'])->first();
            // $penilaiKaryawan = RelasiKaryawan::where('id', '329')->first();
            // dd($penilaiKaryawan->toArray());
            if ($penilaiKaryawan) {
                $penilaiKaryawan->toArray();
                // Untuk Pengkalian Bobot setelah skor di dapat
                if (
                    Str::remove(' ', $items['jabatan_dinilai']) == 'DIREKSI' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IA' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IB' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IC' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IANS'
                ) {
                    $aspek_k = 0.4;  // 3
                    $aspek_p = 0.25;  // 1
                    $aspek_s = 0.35;  // 2

                    $penilai_atasan = 0.6;
                    $penilai_rekanan = 0.2;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                } elseif (
                    Str::remove(' ', $items['jabatan_dinilai']) == 'II' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IINS'
                ) {
                    $aspek_k = 0.35;
                    $aspek_p = 0.25;
                    $aspek_s = 0.4;

                    $penilai_atasan = 0.6;
                    $penilai_rekanan = 0.2;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                } elseif (
                    Str::remove(' ', $items['jabatan_dinilai']) == 'III' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IIINS' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IIII'
                ) {
                    $aspek_k = 0.3;
                    $aspek_p = 0.25;
                    $aspek_s = 0.45;

                    $penilai_atasan = 0.6;
                    $penilai_rekanan = 0.2;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                } elseif (
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IV' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IVA(III)' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IVA(IIINS)' ||
                    Str::remove(' ', $items['jabatan_dinilai']) == 'IVA'
                ) {
                    $aspek_k = 0.1;
                    $aspek_p = 0.3;
                    $aspek_s = 0.6;

                    $penilai_atasan = 0.6;
                    $penilai_rekanan = 0.2;
                    $penilai_staff = 0.15;
                    $penilai_self = 0.05;
                } else {
                    $aspek_k = 0;
                    $aspek_p = 0.35;
                    $aspek_s = 0.65;

                    $penilai_atasan = 0.65;
                    $penilai_rekanan = 0.25;
                    $penilai_staff = 0;
                    $penilai_self = 0.1;
                }

                if ($items['relasi'] == 'self') {
                    $bobot_penilai = $penilai_self;
                } elseif ($items['relasi'] == 'atasan') {
                    $bobot_penilai = $penilai_atasan;
                } elseif ($items['relasi'] == 'rekanan') {
                    $bobot_penilai = $penilai_rekanan;
                } elseif ($items['relasi'] == 'staff') {
                    $bobot_penilai = $penilai_staff;
                }

                // $collection['pool_respon_id'] = $items['id'];
                // Kepemimpinan
                $collection['strategi_perencanaan_bobot_aspek'] = round(round($items['strategi_perencanaan'] / 30, 2) * $aspek_k, 2);
                $collection['strategi_pengawasan_bobot_aspek'] = round(round($items['strategi_pengawasan'] / 30, 2) * $aspek_k, 2);
                $collection['strategi_inovasi_bobot_aspek'] = round(round($items['strategi_inovasi'] / 30, 2) * $aspek_k, 2);
                $collection['kepemimpinan_bobot_aspek'] = round(round($items['kepemimpinan'] / 30, 2) * $aspek_k, 2);
                $collection['membimbing_membangun_bobot_aspek'] = round(round($items['membimbing_membangun'] / 30, 2) * $aspek_k, 2);
                $collection['pengambilan_keputusan_bobot_aspek'] = round(round($items['pengambilan_keputusan'] / 30, 2) * $aspek_k, 2);

                // $collection['strategi_perencanaan_bobot_penilai'] = round($collection['strategi_perencanaan_bobot_aspek'] * $bobot_penilai,4);
                // $collection['strategi_pengawasan_bobot_penilai'] = round($collection['strategi_pengawasan_bobot_aspek'] * $bobot_penilai,4);
                // $collection['strategi_inovasi_bobot_penilai'] = round($collection['strategi_inovasi_bobot_aspek'] * $bobot_penilai,4);
                // $collection['kepemimpinan_bobot_penilai'] = round($collection['kepemimpinan_bobot_aspek'] * $bobot_penilai,4);
                // $collection['membimbing_membangun_bobot_penilai'] = round($collection['membimbing_membangun_bobot_aspek'] * $bobot_penilai,4);
                // $collection['pengambilan_keputusan_bobot_penilai'] = round($collection['pengambilan_keputusan_bobot_aspek'] * $bobot_penilai,4);

                $collection['sum_nilai_k_bobot_aspek'] =
                    $collection['strategi_perencanaan_bobot_aspek']
                    + $collection['strategi_pengawasan_bobot_aspek']
                    + $collection['strategi_inovasi_bobot_aspek']
                    + $collection['kepemimpinan_bobot_aspek']
                    + $collection['membimbing_membangun_bobot_aspek']
                    + $collection['pengambilan_keputusan_bobot_aspek'];

                // Perilaku
                $collection['kerjasama_bobot_aspek'] = round(round($items['kerjasama'] / 25, 2) * $aspek_p, 2);
                $collection['komunikasi_bobot_aspek'] = round(round($items['komunikasi'] / 25, 2) * $aspek_p, 2);
                $collection['absensi_bobot_aspek'] = round(round($items['absensi'] / 25, 2) * $aspek_p, 2);
                $collection['integritas_bobot_aspek'] = round(round($items['integritas'] / 25, 2) * $aspek_p, 2);
                $collection['etika_bobot_aspek'] = round(round($items['etika'] / 25, 2) * $aspek_p, 2);

                // $collection['kerjasama_bobot_penilai'] = round($collection['kerjasama_bobot_aspek'] * $bobot_penilai,4);
                // $collection['komunikasi_bobot_penilai'] = round($collection['komunikasi_bobot_aspek'] * $bobot_penilai,4);
                // $collection['absensi_bobot_penilai'] = round($collection['absensi_bobot_aspek'] * $bobot_penilai,4);
                // $collection['integritas_bobot_penilai'] = round($collection['integritas_bobot_aspek'] * $bobot_penilai,4);
                // $collection['etika_bobot_penilai'] = round($collection['etika_bobot_aspek'] * $bobot_penilai,4);

                $collection['sum_nilai_p_bobot_aspek'] =
                    $collection['kerjasama_bobot_aspek']
                    + $collection['komunikasi_bobot_aspek']
                    + $collection['absensi_bobot_aspek']
                    + $collection['integritas_bobot_aspek']
                    + $collection['etika_bobot_aspek'];

                // Sasaran
                $collection['goal_kinerja_bobot_aspek'] = round(round($items['goal_kinerja'] / 25, 2) * $aspek_s, 2);
                $collection['error_kinerja_bobot_aspek'] = round(round($items['error_kinerja'] / 25, 2) * $aspek_s, 2);
                $collection['proses_dokumen_bobot_aspek'] = round(round($items['proses_dokumen'] / 25, 2) * $aspek_s, 2);
                $collection['proses_inisiatif_bobot_aspek'] = round(round($items['proses_inisiatif'] / 25, 2) * $aspek_s, 2);
                $collection['proses_polapikir_bobot_aspek'] = round(round($items['proses_polapikir'] / 25, 2) * $aspek_s, 2);

                // $collection['goal_kinerja_bobot_penilai'] = round($collection['goal_kinerja_bobot_aspek'] * $bobot_penilai,4);
                // $collection['error_kinerja_bobot_penilai'] = round($collection['error_kinerja_bobot_aspek'] * $bobot_penilai,4);
                // $collection['proses_dokumen_bobot_penilai'] = round($collection['proses_dokumen_bobot_aspek'] * $bobot_penilai,4);
                // $collection['proses_inisiatif_bobot_penilai'] = round($collection['proses_inisiatif_bobot_aspek'] * $bobot_penilai,4);
                // $collection['proses_polapikir_bobot_penilai'] = round($collection['proses_polapikir_bobot_aspek'] * $bobot_penilai,4);

                $collection['sum_nilai_s_bobot_aspek'] =
                    $collection['goal_kinerja_bobot_aspek']
                    + $collection['error_kinerja_bobot_aspek']
                    + $collection['proses_dokumen_bobot_aspek']
                    + $collection['proses_inisiatif_bobot_aspek']
                    + $collection['proses_polapikir_bobot_aspek'];

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
                    $collection['sum_nilai_k_bobot_aspek']
                    + $collection['sum_nilai_s_bobot_aspek']
                    + $collection['sum_nilai_p_bobot_aspek']
                ) * $bobot_penilai, 4);
                // try {
                //     $store = RekapPenilai::updateOrCreate(
                //         [
                //             'pool_respon_id' => $items['id'],
                //         ],
                //         [
                //             'npp_penilai' => $penilaiKaryawan['id'],
                //             'npp_dinilai' => $items['npp_dinilai'],
                //             'jabatan_penilai' => $penilaiKaryawan['level_jabatan'],
                //             'jabatan_dinilai' => $items['jabatan_dinilai'],
                //             'strategi_perencanaan_bobot_aspek' => $collection['strategi_perencanaan_bobot_aspek'],
                //             // 'strategi_perencanaan_bobot_penilai' => $collection['strategi_perencanaan_bobot_penilai'],
                //             'strategi_pengawasan_bobot_aspek' => $collection['strategi_pengawasan_bobot_aspek'],
                //             // 'strategi_pengawasan_bobot_penilai' => $collection['strategi_pengawasan_bobot_penilai'],
                //             'strategi_inovasi_bobot_aspek' => $collection['strategi_inovasi_bobot_aspek'],
                //             // 'strategi_inovasi_bobot_penilai' => $collection['strategi_inovasi_bobot_penilai'],
                //             'kepemimpinan_bobot_aspek' => $collection['kepemimpinan_bobot_aspek'],
                //             // 'kepemimpinan_bobot_penilai' => $collection['kepemimpinan_bobot_penilai'],
                //             'membimbing_membangun_bobot_aspek' => $collection['membimbing_membangun_bobot_aspek'],
                //             // 'membimbing_membangun_bobot_penilai' => $collection['membimbing_membangun_bobot_penilai'],
                //             'pengambilan_keputusan_bobot_aspek' => $collection['pengambilan_keputusan_bobot_aspek'],
                //             // 'pengambilan_keputusan_bobot_penilai' => $collection['pengambilan_keputusan_bobot_penilai'],

                //             'kerjasama_bobot_aspek' => $collection['kerjasama_bobot_aspek'],
                //             // 'kerjasama_bobot_penilai' => $collection['kerjasama_bobot_penilai'],
                //             'komunikasi_bobot_aspek' => $collection['komunikasi_bobot_aspek'],
                //             // 'komunikasi_bobot_penilai' => $collection['komunikasi_bobot_penilai'],
                //             'absensi_bobot_aspek' => $collection['absensi_bobot_aspek'],
                //             // 'absensi_bobot_penilai' => $collection['absensi_bobot_penilai'],
                //             'integritas_bobot_aspek' => $collection['integritas_bobot_aspek'],
                //             // 'integritas_bobot_penilai' => $collection['integritas_bobot_penilai'],
                //             'etika_bobot_aspek' => $collection['etika_bobot_aspek'],
                //             // 'etika_bobot_penilai' => $collection['etika_bobot_penilai'],

                //             'goal_kinerja_bobot_aspek' => $collection['goal_kinerja_bobot_aspek'],
                //             // 'goal_kinerja_bobot_penilai' => $collection['goal_kinerja_bobot_penilai'],
                //             'error_kinerja_bobot_aspek' => $collection['error_kinerja_bobot_aspek'],
                //             // 'error_kinerja_bobot_penilai' => $collection['error_kinerja_bobot_penilai'],
                //             'proses_dokumen_bobot_aspek' => $collection['proses_dokumen_bobot_aspek'],
                //             // 'proses_dokumen_bobot_penilai' => $collection['proses_dokumen_bobot_penilai'],
                //             'proses_inisiatif_bobot_aspek' => $collection['proses_inisiatif_bobot_aspek'],
                //             // 'proses_inisiatif_bobot_penilai' => $collection['proses_inisiatif_bobot_penilai'],
                //             'proses_polapikir_bobot_aspek' => $collection['proses_polapikir_bobot_aspek'],
                //             // 'proses_polapikir_bobot_penilai' => $collection['proses_polapikir_bobot_penilai'],

                //             'sum_nilai_k_bobot_aspek' => $collection['sum_nilai_k_bobot_aspek'],
                //             // 'sum_nilai_k_bobot_penilai' => $collection['sum_nilai_k_bobot_penilai'],
                //             'sum_nilai_s_bobot_aspek' => $collection['sum_nilai_s_bobot_aspek'],
                //             // 'sum_nilai_s_bobot_penilai' => $collection['sum_nilai_s_bobot_penilai'],
                //             'sum_nilai_p_bobot_aspek' => $collection['sum_nilai_p_bobot_aspek'],
                //             // 'sum_nilai_p_bobot_penilai' => $collection['sum_nilai_p_bobot_penilai'],
                //             'sum_nilai_dp3' => $collection['sum_nilai_dp3'],

                //             'relasi' => $items['relasi'],
                //         ]
                //     );
                //     if($store){
                //         $message['message'][$key] = $key.' data berhasil di hitung';
                //     }else{
                //         $message['message'][$key] = $key.' data gagal di hitung';
                //     }
                // } catch (\Throwable $th) {
                //     // return response()->json($th);
                //     $message['message'] = response()->json($th);
                //     continue;
                // }
            }

            $tmpData = [
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
                ],
            ];
            $tempData[] = $tmpData;
        }
        $finalData = collect($tempData);
        // $finalData->chunk(500);
        $counter = [];
        $counterSucess = 0;
        $counterError = 0;
        $finalData->unique()->values()->all();
        foreach ($finalData as $key => $data) {
            try {
                $store = RekapPenilai::updateOrCreate($data[0], $data[1]);
                if ($store) {
                    $counterSucess += 1;
                }
            } catch (\Illuminate\Database\QueryException $e) {
                // $error = $e->getMessage();
                $counterError += 1;
                continue;
            }
        }

        $counter = [
            'success' => $counterSucess,
            'error' => $counterError,
        ];

        return response()->json([
            'title' => 'info',
            'text' => $counter,
            'icon' => 'info',
        ], 200);
    }

    public function final_calculate()
    {
        $message = [];
        $personal = RekapPenilai::select('id', 'relasi', 'npp_dinilai', 'npp_penilai', 'npp_penilai_dinilai')
            ->selectRaw('AVG(sum_nilai_dp3) as avg_dp3')
            ->groupBy('npp_dinilai', 'relasi')
            ->get()
            ->unique('npp_penilai_dinilai');
        // ->unique(['npp_penilai','relasi']);
        // $personal->unique(['npp_penilai']);
        // dd($personal->toArray());

        $personals = $personal->toArray();
        // if($personal > 0){
        //     FinalDp3::truncate();
        // }
        foreach ($personals as $key => $items) {
            $idKaryawan = RelasiKaryawan::where('npp_karyawan', $items['npp_dinilai'])->first();
            if ($idKaryawan) {
                $idKaryawan->toArray();
                // FinalDp3::truncate();
                try {
                    $store = FinalDp3::updateOrCreate([
                        'npp_dinilai_id' => $idKaryawan['id'],
                        'avg_dp3' => round(($items['avg_dp3'] * 100), 4),
                        'relasi' => $items['relasi'],
                    ]);
                    // if($store){
                    //     logger($items->id);
                    // }
                    if ($store) {
                        $message['message'][$key] = $key . ' data berhasil di hitung';
                    }
                } catch (\Throwable $th) {
                    // return response()->json($th);
                    // logger($items->id);
                    $message['message'][$key] = $key . ' data gagal di hitung';
                    continue;
                }
            }
        }

        return response()->json([
            'title' => 'skor akhir',
            'text' => $message['message'],
            'icon' => 'info',
        ], 200);
    }

    public function exportPersonalCompleteXlsx()
    {
        $nows = Carbon::now()->toDateTimeString() . '.xlsx';
        return Excel::download(new RekapPenilaiPersonalCompleteExport, 'FinalSkorDp3-Complete' . $nows, ExcelExt::XLSX);
    }
}
