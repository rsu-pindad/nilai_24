<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspek;

class AspekController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aspek' => 'required',
        ]);
        $store = Aspek::create($validated);

        if($store){
            return redirect()->back()->withToastSuccess('Berhasil menambahkan aspek');
        }else{
            return redirect()->back()->withToastError('Terjadi Kesalahan');
        }
    }
}
