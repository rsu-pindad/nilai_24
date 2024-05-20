<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\AturJadwal;
use Illuminate\Http\Request;

class AturJadwallController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Jadwal Penilaian',
            'jadwalberjalan' => AturJadwal::get()->last(),
        ];
        // dd($data);
        return view('jadwal', $data);
    }

    public function store(Request $request, AturJadwal $jadwal)
    {
        // dd($request->input());
        $validated = $request->validate([
            'jadwal' => 'required',
        ]);
        if($request->input('dokumenCheck') == true){
            // return 'true';
            $dokumen = true;
        }
        if($request->input('nilaiCheck') == true){
            // return 'true';
            $skor = true;
        }
        $jadwal->truncate();
        $jadwal->create(
            [
                'jadwal' => $request->input('jadwal'),
                'lihat_dokumen' => $dokumen ?? false,
                'lihat_skor' => $skor ?? false,
            ]
        );
        return redirect()->back()->withToastSuccess('jadwal diterapkan');
    }
}
