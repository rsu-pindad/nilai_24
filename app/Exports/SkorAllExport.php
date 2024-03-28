<?php

namespace App\Exports;

use App\Models\PoolRespon;
use \Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SkorAllExport implements FromView   
{
    public function view(): View
    {
        return view('hc.skor.pool.export')->with([
            'pool_skor' => PoolRespon::all()
        ]);
    }
}
