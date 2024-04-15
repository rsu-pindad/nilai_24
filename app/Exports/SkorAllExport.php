<?php

namespace App\Exports;

use App\Models\PoolRespon;
use Maatwebsite\Excel\Concerns\FromView;
use \Illuminate\Contracts\View\View;

class SkorAllExport implements FromView
{
    public function view(): View
    {
        return view('hc.skor.pool.export')->with([
            'pool_skor' => PoolRespon::all()
        ]);
    }
}
