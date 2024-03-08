<?php

namespace App\Http\Controllers\HC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ScoresDataTable;

class ScoresController extends Controller
{
    public function index(ScoresDataTable $dataTable)
    {
        return $dataTable->render('hc.score.index');
    }
}
