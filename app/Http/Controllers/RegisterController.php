<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Employee;
use App\Models\RelasiKaryawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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

        $newUser['nama'] = $employee->nama_karyawan;
        $newUser['penempatan'] = $employee->unit_jabatan ?? '';
        $newUser['jabatan'] = $employee->level_jabatan ?? '';
        $newUser['password'] = Hash::make($password);

        $path = '';

        if ($request->file('foto')) {
            $path = $request->file('foto')->store('foto');
        }

        $newUser['foto'] = $path;

        // User::create($newUser);

        // send message wa
        $text = "Silahkan login menggunakan
        
        NPP : $npp
        Password : $password
        
        https://assessment.pindadmedika.com/2024";

        $wa = $this->sendMessage($request->no_hp, $text);
        // dd($wa->getData()->status);
        // if($wa->getData()->status == true){
        if ($wa) {
            User::create($newUser);
            $request->session()->flush();
            return redirect()->route('login')->with('toast_success', 'Berhasil melakukan registrasi');
        }
    }

    private function sendMessage($phone, $text)
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
                'countryCode' => '62',  // optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . env('FONNTE_TOKEN', '')  // change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        $res = json_decode($response);
        return response()->json($res, 200);
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
