<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Profil'];

        return View::make('profile', $data);
    }
}
