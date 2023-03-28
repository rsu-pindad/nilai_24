<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Http\Requests\RegisterRequest;

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
        $employee = Employee::where('npp', $request->npp)->firstOrFail();

        // dd($employee);

        $newUser = $request->all();

        $password = Str::random(10);

        $newUser['nama'] = $employee->nama;
        $newUser['password'] = Hash::make($password);

        $path = $request->file('foto')->store('foto');

        $newUser['foto'] = $path;


        User::create($newUser);

        // send message wa
        $text = "Silahkan login menggunakan
        
NPP : $request->npp
Password : $password";

        $this->sendMessage($request->no_hp, $text);

        return redirect()->route('login')->with('success', 'Berhasil melakukan registrasi');
    }

    public function sendMessage($phone, $text)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $text,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: oXPbC39fCnkM3qXXHXWk' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
