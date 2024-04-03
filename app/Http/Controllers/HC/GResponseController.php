<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Models\GResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class GResponseController extends Controller
{

    public function index()
    {
        // $form_data = Cache::remember('pull_data', now()->addMinutes(5), function(){
            // return GResponse::get();
        // });

        $form_data = GResponse::with(['relasi_penilai', 'relasi_dinilai'])
                    ->select('id','npp_penilai','nama_penilai','npp_dinilai','nama_dinilai','timestamp')
                    // ->orderBy('npp_penilai', 'ASC')
                    ->orderBy('created_at', 'ASC')
                    ->get();

        return view('hc.gform.index')->with([
            'grespon_data' => $form_data,
        ]);
    }

    public function destroy($id)
    {
        $response = GResponse::find($id);
        $response->delete();

        if($response){
            return redirect()->back()->withSuccess('berhasil menghapus data');
        }
    }

    public function getDetailAjax(Request $request)
    {
        $data = GResponse::where('id',$request->id)->first();

        return response()->json(['data' => $data]);
    }

    public function pull()
    {
        // $user = Auth::user();
        // all() returns array
        // $url = env('GOOGLE_SHEET_ID_SCRIPT_PULL_RESPONSE', '');
        // $sheetId = env('GOOGLE_SHEET_ID','');
        // $values = Sheets::spreadsheet($sheetId)->sheet('Form Responses 3')->get(); // YANG LAMA
        // $values = Sheets::spreadsheet('1ukxirWfh5iWXmXi5Lg2tJt6IeUja-F_Ld93i_i0LbZk')->sheet('Copy of Form Responses 1')->get();
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects response
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // curl_close($ch);
        // $values = json_encode($result);
        // $response = Http::get('https://script.googleusercontent.com/macros/echo?user_content_key=ddWekXAK_1eWvd_C0PZCzNNpSuh9edj6Y5_AoeDs5fAj01hbl5Whz4kWvIz6I4GdVn5mMM4n7fx9P5esMgRjk-4HLjQAVVKzm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnGAM6T6KYphyOtjh3TX_FP32CRM0-pGjelBH_Z5GdBCDWq1m2ln8nKjNOx85_ZBdxfG7FhgBVoIo0_zMgn6gqJa3k5AHqkHbXQ&lib=M_YuvaZGjGFOzAFGla-Eh8LFkxVl_vIbd');
        // $values = json_decode($response, true);
        // dd($values);
        try {
            $sheetId = env('GOOGLE_SHEET_RESPONSE_ID', '');
            $sheetName = env('GOOGLE_SHEET_RESPONSE_NAME', '');
            $values = Sheets::spreadsheet($sheetId)->sheet($sheetName)->get(); // YANG BARU
            $values = array_filter($values->toArray());
            unset($values[0]);
            $message = [];
            $sameData = 0;
            $newData = 0;
            $failureData = 0;
            $message['info'] = 'penarikan data';
            $message['data_sama'] = $sameData;
            $message['data_baru'] = $newData;
            $mesaage['data_gagal'] = $failureData;

            foreach($values as $key => $val){
                $timesValue = Carbon::createFromFormat('d/m/Y H:i:s', $val[0])->format('Y-m-d H:i:s');
                $findTime = GResponse::where('timestamp', $timesValue)->first();
                if($findTime)
                {
                    if(isset($findTime->timestamp) == $timesValue){
                        $sameData += 1;
                        $message['data_sama'] = $sameData;
                    }
                }
                else
                {
                    $store = GResponse::updateOrCreate(
                        [
                            // 'timestamp' => Carbon::createFromFormat('d/m/Y H:i:s',$val[0])->format('Y-m-d H:i:s'),
                            'timestamp' => $timesValue,
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
                    if($store){
                        $newData += 1;
                        $message['data_baru'] = $newData;
                    }else{
                        $failureData += 1;
                        $message['data_gagal'] = $failureData;
                    }
                }
            }
            return response()->json($message,200);
        } catch (\Illuminate\Database\QueryException $exception) {
            $message['info'] = $exception->getMessage();
            return response()->json($message,501);
        }
        // return response()->json($message,200);
    }
}
