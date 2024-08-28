<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\GResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Revolution\Google\Sheets\Facades\Sheets;

class GResponseController extends Controller
{
    public function index()
    {
        $form_data = Cache::remember('pull_data', now()->addMinutes(60), function () {
            return GResponse::with(['relasi_penilai', 'relasi_dinilai'])
                       ->select('id', 'npp_penilai', 'nama_penilai', 'npp_dinilai', 'nama_dinilai', 'jabatan_dinilai', 'timestamp')
                       ->orderBy('created_at', 'DESC')
                       ->get();
        });

        return view('hc.gform.index')->with([
            'grespon_data' => $form_data,
        ]);
    }

    public function destroy($id)
    {
        $response = GResponse::find($id);
        $response->delete();

        if ($response) {
            return redirect()->back()->withSuccess('berhasil menghapus data');
        }
    }

    public function getDetailAjax(Request $request)
    {
        $data = GResponse::where('id', $request->id)->first();

        return response()->json(['data' => $data]);
    }

    public function pull()
    {
        try {
            $sheetId   = config('google.config.sheet_response_id', '');
            $sheetName = config('google.config.sheet_response_name', '');
            $values    = Sheets::spreadsheet($sheetId)->sheet($sheetName)->get();  // YANG BARU
            $values    = array_filter($values->toArray());
            unset($values[0]);
            $message               = [];
            $sameData              = 0;
            $newData               = 0;
            $failureData           = 0;
            $message['info']       = 'penarikan data';
            $message['data_sama']  = $sameData;
            $message['data_baru']  = $newData;
            $mesaage['data_gagal'] = $failureData;

            foreach ($values as $key => $val) {
                $timesValue = Carbon::createFromFormat('d/m/Y H:i:s', $val[0])->format('Y-m-d H:i:s');
                $findTime   = GResponse::where('timestamp', $timesValue)->first();
                if ($findTime) {
                    if (isset($findTime->timestamp) == $timesValue) {
                        $sameData            += 1;
                        $message['data_sama'] = $sameData;
                    }
                } else {
                    try {
                        $store = GResponse::updateOrCreate(
                            [
                                'timestamp' => $timesValue,
                            ],
                            [
                                // 'timestamp' => Carbon::createFromFormat('d/m/Y H:i:s',$val[0])->format('Y-m-d H:i:s'),
                                // 'timestamp' => $timesValue,
                                'npp_penilai'           => $val[1],
                                'nama_penilai'          => $val[2],
                                'npp_dinilai'           => $val[3],
                                'nama_dinilai'          => $val[4],
                                'jabatan_dinilai'       => $val[5],
                                'strategi_perencanaan'  => $val[6],
                                'strategi_pengawasan'   => $val[7],
                                'strategi_inovasi'      => $val[8],
                                'kepemimpinan'          => $val[9],
                                'membimbing_membangun'  => $val[10],
                                'pengambilan_keputusan' => $val[11],
                                'kerjasama'             => $val[12],
                                'komunikasi'            => $val[13],
                                'absensi'               => $val[14],
                                'integritas'            => $val[15],
                                'etika'                 => $val[16],
                                'goal_kinerja'          => $val[17],
                                'error_kinerja'         => $val[18],
                                'proses_dokumen'        => $val[19],
                                'proses_inisiatif'      => $val[20],
                                'proses_polapikir'      => $val[21],
                            ]
                        );
                        if ($store) {
                            $newData             += 1;
                            $message['data_baru'] = $newData;
                        }
                    } catch (\Throwable $th) {
                        // throw $th;
                        $failureData          += 1;
                        $message['data_gagal'] = $th->getMessage();
                        continue;
                    }
                }
            }
            // return response()->json($message, 200);
        } catch (\Illuminate\Database\QueryException $exception) {
            $message['info'] = $exception->getMessage();

            return response()->json($message, 501);
        }
        Cache::forget('pull_data');

        return response()->json($message, 200);
    }
}
