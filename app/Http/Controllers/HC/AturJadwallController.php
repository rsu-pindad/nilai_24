<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\AturJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class AturJadwallController extends Controller
{
    public function index()
    {
        $data = [
            'title'          => 'Pengaturan Jadwal Penilaian',
            'jadwalberjalan' => AturJadwal::get()->last(),
        ];

        return view('jadwal', $data);
    }

    public function store(Request $request, AturJadwal $jadwal)
    {
        $validated = Validator::make($request->all(), [
            'start'        => ['required', 'date'],
            'end'          => ['required', 'date'],
            'dokumenCheck' => ['nullable'],
            'nilaiCheck'   => ['nullable'],
        ]);

        if ($validated->fails()) {
            return redirect()
                       ->back()
                       ->withErrors($validated)
                       ->withInput();
        }

        if ($validated->safe()->start > $validated->safe()->end) {
            return redirect()->back()->with('status_fails', 'jadwal mulai tidak sesuai dengan jadwal selesai!');
        }
        $dokumen = false;
        $nilai   = false;
        if ($validated->safe()->dokumenCheck == 'on') {
            $dokumen = true;
        }
        if ($validated->safe()->nilaiCheck == 'on') {
            $nilai = true;
        }

        $start = Carbon::createFromFormat('m/d/Y', $validated->safe()->start)->format('Y-m-d');
        $end   = Carbon::createFromFormat('m/d/Y', $validated->safe()->end)->format('Y-m-d');

        $jadwal->truncate();
        $jadwal->jadwal        = $start;
        $jadwal->akhir_jadwal  = $end;
        $jadwal->lihat_dokumen = $dokumen;
        $jadwal->lihat_skor    = $nilai;
        $jadwal->save();

        return redirect()->back()->with('status', 'Jadwal ditetapkan!');
    }
}
