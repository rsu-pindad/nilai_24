<?php

namespace App\Http\Controllers;

use App\Imports\DP3Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Revolution\Google\Sheets\Facades\Sheets;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ResultController extends Controller
{
    public function index()
    {

        Excel::import(new DP3Import, 'form_respon_DP3.xlsx');
    }
}
