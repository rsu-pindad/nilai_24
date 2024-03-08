<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScoreJawaban;

class ScoreJawabanController extends Controller
{
    public function storeAjax(Request $request)
    {
        $tempData = [];
        // $tempData['data'] = Indikator::orderBy('nama_indikator', 'asc')
        // ->select('id','aspek_id','nama_indikator')
        // ->where('aspek_id', $idAspek)
        // ->get();

        try {
            $validated = $request->validate([
                'aspek_id' => 'required',
                'indikator_id' => 'required',
                'jawaban' => 'required',
                'skor' => 'required',
            ]);
            $store = ScoreJawaban::updateOrCreate($validated);
            if($store == true){
                $tempData['data'] = [
                    'title' => 'sucess!',
                    'html' => 'berhasil menambahkan data',
                    'icon' => 'success',
                ];
                return response()->json($tempData);
            }else{
                $tempData['data'] = [
                    'title' => 'error!',
                    'html' => 'gagal menambahkan data',
                    'info' => 'error',
                ];
                return response()->json($tempData);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->getMessage());
        }

        
        
    }
}
