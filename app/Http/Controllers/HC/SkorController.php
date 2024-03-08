<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score as Skor;

class SkorController extends Controller
{
    //

    public function table()
    {
        return view('hc.skor.table-skor')->with([
            'data_skor' => Skor::get(),
        ]);
    }
}
