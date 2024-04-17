<?php

namespace App\Exports;

use App\Models\PoolRespon;
use Maatwebsite\Excel\Concerns\FromView;
use \Illuminate\Contracts\View\View;

class SkorAllExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        // dd($this->request);
        if($this->request == 'penilai'){
            return view('hc.skor.pool.export')->with([
                'pool_skor' => PoolRespon::orderBy('npp_penilai')->get()
            ]);
        }else{
            return view('hc.skor.pool.export')->with([
                'pool_skor' => PoolRespon::orderBy('npp_dinilai')->get()
            ]);
        }
    }
}
