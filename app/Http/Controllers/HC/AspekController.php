<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use App\Models\Aspek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AspekController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aspek' => 'required',
        ]);
        $store = Aspek::create($validated);

        if ($store) {
            return redirect()->back()->withToastSuccess('Berhasil menambahkan aspek');
        } else {
            return redirect()->back()->withToastError('Terjadi Kesalahan');
        }
    }

    public function getAjax($id)
    {
        $tempData = [];
        $tempData['data'] = Cache::remember('aspek_data', now()->addMinutes(5), function () use ($id) {
            return Aspek::select('id', 'nama_aspek')
                ->whereNot('id', $id)
                ->get();
        });
        return response()->json($tempData);
    }
}
