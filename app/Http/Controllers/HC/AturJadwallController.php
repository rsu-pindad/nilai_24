<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AturJadwal;

class AturJadwallController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Jadwal Penilaian',
            'jadwalberjalan' => AturJadwal::get()->last(),
        ];
        return view('jadwal', $data);
    }

    public function store(Request $request, AturJadwal $jadwal)
    {
        // dd($request);
        $validated = $request->validate([
            'jadwal' => 'required',
        ]);
        $jadwal->truncate();
        $jadwal->create($validated);
        return redirect()->back()->withToastSuccess('jadwal diterapkan');
    }

}
