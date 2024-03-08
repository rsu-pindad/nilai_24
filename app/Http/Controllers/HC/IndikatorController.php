<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indikator;
use Illuminate\Support\Facades\Cache;

class IndikatorController extends Controller
{

    public function setSlugs($id)
    {
        return $id;
    }
    public function getAjax($idAspek)
    {
        $tempData = [];
        $tempData['data'] = Cache::remember('indikator_data', now()->addMinutes(5), function() use ($idAspek) {
            return Indikator::orderBy('nama_indikator', 'asc')
            ->select('id','aspek_id','nama_indikator')
            ->where('aspek_id', $idAspek)
            ->get();
        });
        return response()->json($tempData);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'aspek_id' => 'required',
            'nama_indikator' => 'required',
        ]);
        $store = Indikator::create($validated);

        if($store == true){
            return redirect()->back()->withToastSuccess('Berhasil menambahkan indikator');
        }else{
            return redirect()->back()->withToastError('Terjadi Kesalahan');
        }
    }
}
