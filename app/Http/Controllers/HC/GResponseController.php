<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Models\GResponse;
use Carbon\Carbon;

class GResponseController extends Controller
{

    public function index()
    {
        $form_data = Cache::remember('pull_data', now()->addMinutes(5), function(){
            return GResponse::get();
        });

        return view('hc.gform.index')->with([
            'grespon_data' => $form_data,
        ]);
    }

    public function pull()
    {
        // $user = Auth::user();
        // all() returns array
        $sheetId = env('GOOGLE_SHEET_ID', '');
        // $values = Sheets::spreadsheet('1ukxirWfh5iWXmXi5Lg2tJt6IeUja-F_Ld93i_i0LbZk')->sheet('Form Responses 3')->get();
        $values = Sheets::spreadsheet($sheetId)->sheet('Form Responses 1')->get();
        // $values = Cache::remember('form_response', now()->addMinutes(2), function(){
        //     return Sheets::spreadsheet('1ukxirWfh5iWXmXi5Lg2tJt6IeUja-F_Ld93i_i0LbZk')->sheet('Form Responses 3')->get();
        // });
        // $values = Sheets::spreadsheet('1wU3BmjMVB-SLA9XaIQst6gDse17ZoP0vN63Ld2VcPV8')->sheet('Form Responses 1')->get();
        unset($values[0]);
        $message = [];
        $sameData = 0;
        $newData = 0;
        $message = 
            [
                'info' => 'poll pulled',
                'same_data' => $sameData,
                'new_pulled' => $newData,
                'failure' => '',
            ];
        try {
            $store = false;
            foreach($values as $key => $val){
                // unset($values[$val]);
                $timesValue = Carbon::createFromFormat('d/m/Y H:i:s', $val[0])->format('Y-m-d H:i:s');
                $findTime = GResponse::where('timestamp', $timesValue)->get() ?? '';
                // $findTime->toArray();
                // dd($findTime[0]->timestamp);
                if(isset($findTime[0]->timestamp) == $timesValue){
                        // echo 'same';
                        unset($values[$key]);
                        $sameData += 1;
                        $message['same_data'] = $sameData;
                }else{
                    $store = GResponse::updateOrCreate(
                        [
                        'timestamp' => Carbon::createFromFormat('d/m/Y H:i:s',$val[0])->format('Y-m-d H:i:s'),
                        'npp_penilai' => $val[1],
                        'nama_penilai' => $val[2],
                        'npp_dinilai' => $val[3],
                        'nama_dinilai' => $val[4],
                        'jabatan_dinilai' => $val[5],
                        'strategi_perencanaan' => $val[6],
                        'strategi_pengawasan' => $val[7],
                        'strategi_inovasi' => $val[8],
                        'kepemimpinan' => $val[9],
                        'membimbing_membangun' => $val[10],
                        'pengambilan_keputusan' => $val[11],
                        'kerjasama' => $val[12],
                        'komunikasi' => $val[13],
                        'absensi' => $val[14],
                        'integritas' => $val[15],
                        'etika' => $val[16],
                        'goal_kinerja' => $val[17],
                        'error_kinerja' => $val[18],
                        'proses_dokumen' => $val[19],
                        'proses_inisiatif' => $val[20],
                        'proses_polapikir' => $val[21],
                        ]
                    );
                    if($store == true)
                    {
                        $newData += 1;
                        // return response()->json('pool pulled');
                        $message['new_pulled'] = $newData;
                    }else{
                        // return response()->json('terjadi kesalahan');
                        $message['failure'] = 'terjadi kesalah';
                    }
                }  
            }
            return response()->json($message);
            // return response()->json([
            //     'message' => 'pool inserted',
            //     'same data' => $sameData,
            //     'new pool' => $newData
            // ]);

        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage(),
                ]
            );
        }
    }
}
