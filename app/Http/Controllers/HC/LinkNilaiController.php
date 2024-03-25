<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkNilai;
class LinkNilaiController extends Controller
{
    public function index()
    {
        $getNilai = LinkNilai::get();
        return view('hc.form.index')->with([
            'data_nilai' => $getNilai,
        ]);
    }

    public function storeAjax(Request $request)
    {
        if($request->active != ''){
            $active = 1;
        }
        try {
            $validated = $request->validate([
                'form_start' => 'required',
                'segment1' => 'required',
            ]);
            if($validated){
                $store = LinkNilai::updateOrCreate(
                    [
                        'form_start' => $request->form_start,
                        'form_1' => $request->segment1,
                        'form_2' => $request->segment2,
                        'form_3' => $request->segment3,
                        'form_4' => $request->segment4,
                        'form_5' => $request->segment5,
                        'active' => $active,
                    ]
                );
                if($store){
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
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
