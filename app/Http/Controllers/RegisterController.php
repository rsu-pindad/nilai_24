<?php

namespace App\Http\Controllers;

use App\Models\RelasiKaryawan;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Halaman Registrasi'];
        return View::make('register', $data);
    }

    public function create(RegisterRequest $request)
    {
        $npp = $request->session()->get('npp');
        $nama = $request->session()->get('nama');
        // $employee = Employee::where('npp', $npp)->first();
        $employee = RelasiKaryawan::where('npp_karyawan', $npp)->first();

        if (!$employee) {
            $request->session()->flush();
            return redirect()->back()->with('toast_error', 'NPP tidak ditemukan')->withInput($request->input());
        }

        $user = User::where('npp', $npp)->first();
        if ($user) {
            $request->session()->flush();
            return redirect()->back()->with('toast_error', 'NPP sudah terdaftar')->withInput($request->input());
        }

        $newUser = $request->all();

        $newUser['npp'] = $npp;
        $newUser['nama'] = $nama;


        $password = Str::random(10);

        $newUser['nama'] = $employee->nama;
        $newUser['password'] = Hash::make($password);

        $path = $request->file('foto')->store('foto');

        $newUser['foto'] = $path;

        User::create($newUser);

        // send message wa
        $text = "Silahkan login menggunakan

NPP : $npp
Password : $password

https://assessment.pindadmedika.com/
";

        $this->sendMessage($request->no_hp, $text);
        $request->session()->flush();
        return redirect()->route('login')->with('toast_success', 'Berhasil melakukan registrasi');
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
                'Authorization: 2qB#yoP6MKX2Z3_pDZfj' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function check(Request $request)
    {
        // $employee = Employee::where('npp', $request->npp)->first();
        $employee = RelasiKaryawan::where('npp_karyawan', $request->npp)->first();

        if (!$employee) {
            $request->session()->flush();
            return redirect()->back()->with('toast_error', 'NPP tidak ditemukan');
        }

        // session()->put(['npp' => $employee->npp, 'nama' => $employee->nama]);
        session()->put(['npp' => $employee->npp_karyawan, 'nama' => $employee->nama_karyawan]);
        
        return redirect()->route('register');
    }
}
