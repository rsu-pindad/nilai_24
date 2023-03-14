<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Registrasi'];
        return View::make('register', $data);
    }

    public function create(RegisterRequest $request)
    {
        // dd($request->all());
        $newUser = $request->all();
        $newUser['password'] = Hash::make($request->password);
        User::create($newUser);
        return redirect()->route('login')->with('success', 'Berhasil melakukan registrasi');
    }
}
