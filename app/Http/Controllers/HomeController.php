<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Self Assesment'];

        return View::make('home', $data);
    }
}
